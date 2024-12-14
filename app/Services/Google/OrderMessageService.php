<?php

namespace App\Services\Google;

use App\Models\Country;
// use App\Models\Coupon;
use App\Models\Order;
use App\Models\User;
use App\TokenStore\TokenCache;
use App\Traits\Api\ApiResponseTrait;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Microsoft\Graph\Graph;
use Illuminate\Support\Facades\Mail;
// use App\Mail\OrderCouponMail;
use App\Mail\OrderCouponMail;
use App\Models\Currency;
use App\Models\PartnerPrice;

class OrderMessageService
{
    use ApiResponseTrait;

    public function getAll(
        $isPaginateOrGet = false,
        $onlyPaid = null,
        $bindUserId = null
    ) {
        $query = Order::query()->latest("id")->orderFilters();


        // User ID Binding
        !is_null($bindUserId) && $query->where('partner_id', $bindUserId);

        // Is Paid
        !is_null($onlyPaid) && $query->where('is_paid', $onlyPaid);

        info("SQL : " . $query->toSql());

        return $isPaginateOrGet ? $query->paginate(maxPaginateNo()) : $query->get();
    }

    public function store(array $data)
    {
        dd($data);
    }

    public function update(array $data)
    {
        Order::query()->update($data);
    }

    public function storeOrder(array $payloads)
    {
        $geoDetails = geoip(request()->ip());
        $country_id = $state_id = $partner_id = null;
        $countryName = $geoDetails->country;
        $cityName = $geoDetails->city;
        $countryCode = $geoDetails->iso_code;

        // Fetch country based on the name from geoip
        $country = Country::query()->where('code', $countryCode)->first();

        if ($country) {
            $country_id = $country->id;

            // Fetch city from the country cities
            $state = $country->states()->where('name', $cityName)->first();
            $state_id = $state?->id ?: null;

            // Retrieve the partner user with the corresponding country_id and user_type
            $partner = User::where('country_id', $country_id)
                ->first();
            $partner_id = $partner?->id ?: null;
        }
        $partnerPrice = PartnerPrice::where('country_code', $countryCode)->first();
        if ($partnerPrice) {
            $currencyId = $partnerPrice->currency_id;
            $payableAmount = $partnerPrice->price;
        } else {
            $currencyId = 1;
            $payableAmount = 9.90;
        }

        $payloads["state_id"] = $state_id;

        return Order::query()->create([

            'platform_type'             => $payloads["platform_type"],
            'user_id'                   => null,
            'partner_id'                => $partner_id,
            'country_id'                => $country_id ?? null,
            'state_id'                  => $state_id ?? null,
            'payable_amount'            => $payableAmount,
            'paid_amount'               => $payableAmount,
            'status'                    => 'Generating',
            'from_email'                => $payloads['your_email'],
            'recipient_email'           => $payloads['email_from'],
            'keyword'                   => $payloads['inc_keywords'],
            'exclude_keyword'           => $payloads['exc_keywords'],
            'start_date'                => !empty($payloads['start_date']) ? date('Y-m-d', strtotime($payloads['start_date'])) : null,
            'end_date'                  => !empty($payloads['end_date']) ? date('Y-m-d', strtotime($payloads['end_date'])) : null,
            'search_attachments_list'   => isset($payloads['search_attachments_list']) ? $payloads['search_attachments_list'] : 0,
            'language' => $payloads['language'],
            'timezone'                  => isset($payloads['timezone']) ? $payloads['timezone'] : config('app.timezone'),
            'request'                   => json_encode($payloads),
            'currency_id'               => $currencyId,

        ]);
    }

    public function storeOrderMessage(array $payloads)
    {
        if (!isLaravelGmailLoggedIn()) {
            // dd(123);
        }
        $email_address = $payloads['email_from'];
        $query = '(from:' . $email_address . ' OR to:' . $email_address . ')';

        $inc_query = "";
        $exc_query = "";

        if ($payloads['inc_keywords']) {
            $inc_array = stringSplit($payloads['inc_keywords']);
            $inc_query = createRawIncludeQuery($inc_array);
        }

        if ($payloads['exc_keywords']) {
            $exc_array = stringSplit($payloads['exc_keywords']);
            $exc_query = createRawIncludeQuery($exc_array);
        }

        if ($payloads['start_date']) {
            $aft_query = 'after:' . $payloads['start_date'];
        }
        if ($payloads['end_date']) {
            $bef_query = 'before:' . $payloads['end_date'];
        }

        $messages = LaravelGmail::message()
            ->raw($query)
            ->raw($inc_query)
            ->raw($exc_query)
            ->raw($payloads['start_date'])
            ->raw($payloads['end_date'])
            ->preload()
            ->all();

        return count($messages);
    }

    public function updateOrderMessages(object $order, int $totalMessagesAmount)
    {
        return $this->updateOrder($order, [
            "total_messages" => $order->total_messages + $totalMessagesAmount
        ]);
    }

    public function updateOrder(object $order, array $payloads)
    {
        $order->update($payloads);

        return $order;
    }

    public function messageBodyDecode($eData)
    {
        $message = $eData->getHtmlBody();
        $decoded_message = html_entity_decode($message);
        $decoded_message = preg_replace('/<br\s*\/?>/', '\n', $decoded_message);
        $decoded_message = preg_replace('/<style\b[^>]*>.*?<\/style>/s', '\n', $decoded_message);
        $decoded_message = preg_replace('/<script\b[^>]*>.*?<\/script>/s', '\n', $decoded_message);
        $decoded_message = strip_tags($decoded_message);

        return $decoded_message;
    }

    public function getMessages(object $order, $useDepricatedMethod = true, $token = null)
    {
        $url = $this->getGoogleApiUrl($order);

        info("URL : " . $url);

        if ($useDepricatedMethod) {

            return $this->depricatedSearchMessages($url, $token);
        }

        return $this->searchMessages($url, $token);
    }

    public function getGoogleApiUrl(object $order)
    {

        $request = json_decode($order->request, true);

        $fromEmail = $request["email_from"];

        // $queryMake = "(from: {$fromEmail} OR to:{$fromEmail}) ";

        $date_after = $request["start_date"] ?? null;
        $date_before = $request["end_date"] ?? null;
        $inc_query = "";
        $exc_query = "";

        $inc_keywords = $request["inc_keywords"] ?? null;
        $exc_keywords = $request["exc_keywords"] ?? null;
        $searchKeyWordList = $request["search_keyword_list"];

        $searchQuery = $this->buildSearchQuery($fromEmail, $inc_keywords, $exc_keywords, $date_after, $date_before, $fromEmail,$searchKeyWordList);
        info("New Raw Query : " . $searchQuery);
        return 'https://www.googleapis.com/gmail/v1/users/me/messages?q=' . urlencode($searchQuery);
    }

    private function buildSearchQuery(
        $query,
        $includeWords,
        $excludeWords,
        $afterDate,
        $beforeDate,
        $fromEmail = null,
        $searchKeyWordList
    ) {
        info("After Date : " . $afterDate);
        info("Before Date : " . $beforeDate);

        $searchKeywords = "(from:{$query} to:me) OR (from:me to:{$query})";
        info("Start Query : " . $searchKeywords);

        // if ($includeWords) {
        //     $includeWordsArray = explode(',', $includeWords);
        //     foreach ($includeWordsArray as $word) {
        //         $searchKeywords .= $word . ' ';
        //     }
        // }

        /* raj panu */
        if($searchKeyWordList){
        if ($includeWords) {
            $includeWordsArray = explode(',', $includeWords);

            // Wrap words with quotes if they contain spaces
            foreach ($includeWordsArray as &$word) {
                $word = (strpos($word, ' ') !== false) ? '"' . trim($word) . '"' : trim($word);
            }

            // Join the words with OR to match any of them
            $includeQuery = implode(' OR ', $includeWordsArray);
            $searchKeywords .= " ({$includeQuery}) "; // Enclose OR conditions in parentheses
        }
     }
        /* End */

        // if ($excludeWords) {
        //     $excludeWordsArray = explode(',', $excludeWords);
        //     foreach ($excludeWordsArray as $word) {
        //         $searchKeywords .= '-' . $word . ' ';
        //     }
        // }

        // if (!empty($afterDate)) {
        //     $start = Carbon::parse($afterDate)->format('Y/m/d');
        //     $searchKeywords .= " after:{$start} ";
        // }
        // if ($beforeDate) {
        //     $end = Carbon::parse($beforeDate)->format('Y/m/d');
        //     $searchKeywords .= " before:{$end} ";
        // }

        if (!empty($afterDate)) {
            $start = Carbon::parse($afterDate)->format('Y/m/d');
            $searchKeywords .= " after:{$start} ";
        }

        if (!empty($beforeDate)) {
            $end = Carbon::parse($beforeDate)->format('Y/m/d');
            $searchKeywords .= " before:{$end} ";
        }

        info("Final Query : " . $searchKeywords);

        return $searchKeywords;
    }

    public function depricatedSearchMessages($url, $token = null)
    {
        $response = $this->makeApiRequest($url, $token);

        $messages = json_decode($response, true);

        if (isset($messages['error'])) {
            throw new \Exception('Error: ' . $messages['error']['message']);
        }

        return $messages;
    }

    private function makeApiRequest($url, $token = null)
    {

        $accessToken = $token ? $token : (LaravelGmail::getToken()['access_token'] ?? null);

        info("Calling from makeApiRequest Method = " . $url . " & Token is : {$accessToken}");
        set_time_limit(0);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0); // No timeout
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); // No connection timeout

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function searchMessages($url, $token = null)
    {
        $allMessages = [];
        $allThreads = [];
        $pageToken = null;
        $maxResults = 100; // Fetch 100 messages per request
        $i = 0;
        do {
            //            if($i==2) break;
            $i++;
            $responseUrl = $url;
            if ($pageToken) {
                $responseUrl .= '&pageToken=' . $pageToken;
            }

            $response = $this->makeApiRequest($responseUrl, $token);
            $messages = json_decode($response, true);

            if (isset($messages['messages'])) {
                foreach ($messages['messages'] as $message) {
                    $threadId = $message['threadId'];
                    if (!in_array($threadId, array_column($allThreads, 'threadId'))) {
                        $allThreads[] = $message;
                    }
                }

                $allMessages = array_merge($allMessages, $messages['messages']);
            }

            $pageToken = $messages['nextPageToken'] ?? null;
            info("Page Token: " . json_encode($pageToken));

            // Stop fetching if there are no more pages
            if (!$pageToken) {
                break;
            }
        } while ($pageToken);

        return $allThreads;
    }

    public function fetchSingleMessage($messageId, $accessToken)
    {
        $messageUrl = 'https://www.googleapis.com/gmail/v1/users/me/messages/' . $messageId;
        set_time_limit(0);
        $ch = curl_init($messageUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken
        ]);

        curl_setopt($ch, CURLOPT_TIMEOUT, 0); // No timeout
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); // No connection timeout

        $messageResponse = curl_exec($ch);
        curl_close($ch);

        return json_decode($messageResponse, true);
    }

    public function fetchThreadMessage($threadId, $accessToken)
    {
        $messageUrl = 'https://www.googleapis.com/gmail/v1/users/me/threads/' . $threadId;
        set_time_limit(0);
        $ch = curl_init($messageUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken
        ]);

        curl_setopt($ch, CURLOPT_TIMEOUT, 0); // No timeout
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); // No connection timeout

        $messageResponse = curl_exec($ch);
        curl_close($ch);

        return json_decode($messageResponse, true);
    }

    function parseMessage($messageDetails)
    {
        $parsedMessage = [];

        // Get headers
        $headers = $messageDetails['payload']['headers'];
        foreach ($headers as $header) {
            if ($header['name'] == 'Subject') {
                $parsedMessage['subject'] = $header['value'];
            } elseif ($header['name'] == 'From') {
                $parsedMessage['from'] = $header['value'];
            } elseif ($header['name'] == 'To') {
                $parsedMessage['to'] = $header['value'];
            } elseif ($header['name'] == 'Cc') {
                $parsedMessage['cc'] = $header['value'];
            } elseif ($header['name'] == 'Bcc') {
                $parsedMessage['bcc'] = $header['value'];
            }
        }

        // Get body
        $body = getBody($messageDetails['payload']);
        $parsedMessage['body'] = $body;

        return $parsedMessage;
    }


    public function outlookSessionParams()
    {
        $emailAddress = session("outlook_email_from");
        $inc_keywords = session("outlook_inc_keywords");
        $language = session("outlook_language");
        $dateRangeStart = session("outlook_start_date");
        $dateRangeEnd = session("outlook_end_date");

        $inboxMessages = $this->getInbox($emailAddress, $inc_keywords)->getPage();
        $sentMessages = $this->getSentItems($emailAddress, $inc_keywords)->getPage();
        $totalMessages = array_merge($inboxMessages['value'], $sentMessages['value']);

        $filteredDates = [];

        if ($dateRangeStart != Null && $dateRangeEnd != Null) {
            $filteredDates = collect($totalMessages)->filter(function ($date) use ($dateRangeStart, $dateRangeEnd) {
                $emailDate = date('Y-m-d', strtotime($date['receivedDateTime']));
                return $emailDate >= $dateRangeStart && $emailDate <= $dateRangeEnd;
            });
        } else {
            $filteredDates = $totalMessages;
        }

        return $filteredDates;
    }

    public function getInbox($emailAddress, $inc_keywords = Null)
    {
        try {
            $tokenCache = new TokenCache();

            $accessToken = $tokenCache->getAccessToken();
            $graph = new Graph();
            $graph->setAccessToken($accessToken);

            // Only request specific properties
            $select = '$select=from,toRecipients,isRead,receivedDateTime,subject,body';

            // Filter by recipient email address
            $from = "from:" . $emailAddress;
            $include_words = "subject:" . $inc_keywords;
            // $date = "sent:>=2023-04-01 OR sent:<=2023-04-30";

            if ($inc_keywords) {
                $requestUrl = '/me/messages?$search="' . $from . ' AND ' . $include_words . '"&' . $select;
            } else {
                $requestUrl = '/me/messages?$search="' . $from . '"&' . $select;
            }


            return $graph->createCollectionRequest('GET', $requestUrl);
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }
    }

    public function getSentItems($emailAddress, $inc_keywords = Null)
    {
        try {
            $tokenCache = new TokenCache();
            $accessToken = $tokenCache->getAccessToken();
            $graph = new Graph();
            $graph->setAccessToken($accessToken);

            // Only request specific properties
            $select = '$select=from,toRecipients,isRead,receivedDateTime,subject,body';
            // Filter by recipient email address
            $recipients = "recipients:" . $emailAddress;
            $include_words = "subject:" . $inc_keywords;
            // $date = "sent:>=2023-04-01 OR sent:<=2023-04-30";
            // Sort by received time, newest first
            // $orderBy = '$orderBy=receivedDateTime DESC';

            if ($inc_keywords) {
                $requestUrl = '/me/messages?$search="' . $recipients . ' AND ' . $include_words . '"&' . $select;
            } else {
                $requestUrl = '/me/messages?$search="' . $recipients . '"&' . $select;
            }

            return $graph->createCollectionRequest('GET', $requestUrl);
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return response(['catch' => "Sorry, there was a problem"], 500);
        }
    }

    public function getOrderById($orderId)
    {
        return Order::query()->findOrFail($orderId);
    }
}
