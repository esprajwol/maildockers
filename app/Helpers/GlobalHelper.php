<?php

use App\Models\Country;
use Carbon\Carbon;
use App\Utils\AppCache;
use App\Utils\AppStatic;
use App\Utils\SessionLab;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Illuminate\Support\Str;
use App\Services\Log\LogService;
use App\Services\File\FileService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;

if (!function_exists("user")) {
    function user()
    {
        return auth()->user();
    }
}

if (!function_exists("isActiveUser")) {
    function isActiveUser()
    {

        return user()->is_active == 1 || user()->is_active == true;
    }
}

if (!function_exists("customSessionForgot")) {
    function customSessionForgot()
    {
        session()->forget('outlook_your_email');
        session()->forget('outlook_email_from');
        session()->forget('outlook_inc_keywords');
        session()->forget('outlook_exc_keywords');
        session()->forget('outlook_start_date');
        session()->forget('outlook_end_date');
        session()->forget('outlook_language');
        session()->forget('total_message');
        session()->forget('file');
        session()->forget('order_id');
        session()->forget('total_messages');
    }
}
if (!function_exists("setValueSession")) {
    function setValueSession($value){
        Redis::set('lang', $value);
        Redis::set('lang', $value);
        session()->put("lang", $value);
        session()->put("lang", $value);
    }
}


if (!function_exists("setLangSession")) {
    function setLangSession($lang, $direction){
        Redis::set('lang', $lang);
        Redis::set('lang-direction', $direction);
        session()->put("lang", $lang);
        session()->put("lang-direction", $direction);
    }
}

if (!function_exists("getSession")) {
    function getSession($key){
        $code = Redis::get($key);
        return (empty($code))? "en":$code;
    }
}


if (!function_exists("userId")) {
    function userId()
    {

        if (!isLoggedIn()) {

            abort(401);
        }


        return auth()->id();
    }
}

if (!function_exists("isLoggedIn")) {
    function isLoggedIn()
    {

        return auth()->check();
    }
}

if (!function_exists("getUserType")) {
    function getUserType()
    {

        if (!isLoggedIn()) {

            abort(401);
        }

        return user()->user_type;
    }
}

if (!function_exists("isAdmin")) {
    function isAdmin()
    {

        if (!isLoggedIn()) {

            abort(401);
        }

        return getUserType() === appStatic()::TYPE_ADMIN;
    }
}


if (!function_exists("isAdminStaff")) {
    function isAdminStaff()
    {

        if (!isLoggedIn()) {

            abort(401);
        }

        return getUserType() === appStatic()::TYPE_ADMIN_STAFF;
    }
}

if (!function_exists("isPartner")) {
    function isPartner()
    {

        if (!isLoggedIn()) {

            abort(401);
        }

        return getUserType() == appStatic()::TYPE_PARTNER;
    }
}

if (!function_exists("isPartnerStaff")) {
    function isPartnerStaff()
    {

        if (!isLoggedIn()) {

            abort(401);
        }

        return getUserType() === appStatic()::TYPE_PARTNER_STAFF;
    }
}

if (!function_exists("isDistributor")) {
    function isDistributor()
    {

        if (!isLoggedIn()) {

            abort(401);
        }

        return getUserType() === appStatic()::TYPE_DISTRIBUTOR;
    }
}


if (!function_exists("isCustomer")) {
    function isCustomer()
    {

        if (!isLoggedIn()) {

            abort(401);
        }

        return getUserType() === appStatic()::TYPE_CUSTOMER;
    }
}

if (!function_exists("isClient")) {
    function isClient()
    {

        if (!isLoggedIn()) {

            abort(401);
        }

        return getUserType() === appStatic()::TYPE_CLIENT;
    }
}

if (!function_exists("isIndividual")) {
    function isIndividual()
    {

        if (!isLoggedIn()) {

            abort(401);
        }

        return getUserType() === appStatic()::TYPE_INDIVIDUAL;
    }
}



if (!function_exists("isDistributorStaff")) {
    function isDistributorStaff()
    {

        if (!isLoggedIn()) {

            abort(401);
        }

        return getUserType() === appStatic()::TYPE_DISTRIBUTOR_STAFF;
    }
}


if (!function_exists("maxPaginateNo")) {
    function maxPaginateNo($max = 50)
    {

        $request = request();

        return  $request->has('per_page') ? $request->per_page : $max;
    }
}


if (!function_exists("appStatic")) {
    function appStatic()
    {


        return new \App\Utils\AppStatic();
    }
}

# Random String Number Generator

if (!function_exists('randomStringNumberGenerator')) {
    function randomStringNumberGenerator(
        $length = 6,
        $includeNumbers = true,
        $includeLetters = false,
        $includeSymbols = false
    ) {
        $chars = [
            'letters' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'numbers' => '0123456789',
            'symbols' => '!@#$%^&*()-_+=<>?'
        ];

        $password = '';
        $charSets = [];

        if ($includeLetters) {
            $charSets[] = $chars['letters'];
        }

        if ($includeNumbers) {
            $charSets[] = $chars['numbers'];
        }

        if ($includeSymbols) {
            $charSets[] = $chars['symbols'];
        }

        $charSetsCount = count($charSets);

        if ($charSetsCount === 0) {
            return 'Invalid character set configuration';
        }

        for ($i = 0; $i < $length; $i++) {
            $charSet = $charSets[$i % $charSetsCount];
            $password .= $charSet[random_int(0, strlen($charSet) - 1)];
        }

        return $password;
    }
}



if (!function_exists("isRouteShow")) {
    function isRouteShow($routeName = null)
    {
        //TODO:: router show or not code here
        return true;
    }
}

if (!function_exists("ddError")) {
    function ddError($e, $extra = null)
    {
        return dd(errorArray($e), $extra);
    }
}

/**
 * Beware of changes, Because it's using as API Error Response
 * */
if (!function_exists("errorArray")) {
    function errorArray($e)
    {
        return [
            "title"         => $e->getMessage(),
            "file"          => $e->getFile(),
            "line"          => $e->getLine(),
        ];
    }
}


if (!function_exists("commonLog")) {
    /**
     * @throws JsonException
     */
    function commonLog($title, array $payloads = [], $channel = "daily", $writeToLog = true)
    {

        if (!$writeToLog) {
            return false;
        }
        \logService()->commonLog(
            $title,
            $payloads,
            $channel
        );
    }
}

if (!function_exists("logService")) {
    function logService()
    {
        return new LogService();
    }
}

if (!function_exists("appStatic")) {
    function appStatic()
    {
        return new AppStatic();
    }
}

if (!function_exists("sessionLab")) {
    function sessionLab()
    {
        return new SessionLab();
    }
}

if (!function_exists('isSvg')) {
    function isSvg(string $extension)
    {
        return $extension === "svg";
    }
}


# FIle Name Prefix
if (!function_exists('fileRenamePrefix')) {
    function fileRenamePrefix()
    {
        return (new FileService())::FILE_RENAME_PREFIX;
    }
}

if (!function_exists('fileRename')) {
    /**
     * @throws Exception
     */
    function fileRename(): string
    {
        return now()->format("Ymd") . fileRenamePrefix() . time() . random_int(1111, 9999);
    }
}

if (!function_exists('currentUrl')) {

    function currentUrl()
    {
        return request()->fullUrl();
    }
}

if (!function_exists("currentRoute")) {
    function currentRoute(): string
    {
        try {
            return  request()->route()?->getName() ?? "home";
        } catch (\Throwable $e) {
            info("Current Route Name error : " . $e->getMessage());
            return $e->getMessage();
        }
    }
}

if (!function_exists("manageDateTime")) {
    function manageDateTime($dateTime = null, $formatType = 1)
    {
        $dateTime = is_null($dateTime) ? now() : $dateTime;

        return carbonParse($dateTime)->format(getDateTimeFormat($formatType));
    }
}

if (!function_exists('carbonParse')) {
    function carbonParse($dateTime = null)
    {
        $dateTime = empty($dateTime) ? now() : $dateTime;
        return Carbon::parse($dateTime);
    }
}

if (!function_exists("clientIP")) {
    function clientIP()
    {

        return request()->ip();
    }
}


if (!function_exists("appCache")) {
    function appCache()
    {

        return new AppCache();
    }
}

# Image Mimes
if (!function_exists('imageMimes')) {
    function imageMimes()
    {

        return "mimes:jpg,png,webp,bimp,svg";
    }
}

# Set Active Status
if (!function_exists("setIsActive")) {
    function setIsActive()
    {

        return request()->has("is_active") ? request()->is_active : 0;
    }
}

if (!function_exists("fileService")) {
    function fileService()
    {

        return new FileService();
    }
}

# Default Disk
if (!function_exists('setDefaultDisk')) {
    function setDefaultDisk()
    {
        return "public";
    }
}


if (!function_exists('allowedImageExtensions')) {
    function allowedImageExtensions()
    {

        return [
            "jpeg",
            "jpg",
            "png",
            "bimp",
            "svg",
            "webp",
        ];
    }
}


if (!function_exists('allowedMediaExtensions')) {
    function allowedMediaExtensions()
    {

        return [
            "mp4",
            "mp3",
            "amr",
            "wev",
        ];
    }
}


if (!function_exists("getDateTimeFormat")) {
    function getDateTimeFormat($formatType = 1)
    {

        return [
            1 => "h:i:s,v d-m-Y",
            2 => "h:i A d-m-Y",
            3 => "H:i A d-M-Y",
            4 => "h:i A d-M-Y",
            5 => "d-M-Y",
            6 => "h:i A"
        ][$formatType] ?? "";
    }
}

# Slug Maker
if (!function_exists("slugMaker")) {
    function slugMaker($value)
    {
        return Str::slug($value);
    }
}

# Flush Message
if (!function_exists("flashMessage")) {
    function flashMessage($message, $type = "success")
    {
        return session()->flash($type, $message);
    }
}

# Dashboard Prefix
if (!function_exists("dashboardPrefix")) {
    function dashboardPrefix()
    {
        if (isAdmin() || isAdminStaff()) {
            return "Admin Dashboard";
        }

        if (isDistributor() || isDistributorStaff()) {
            return "Distributor Dashboard";
        }

        if (isPartner() || isPartnerStaff()) {
            return "Partner Dashboard";
        }
    }
}

# Dashboard Prefix
if (!function_exists("urlVersion")) {
    function urlVersion($file = null)
    {
        if (is_null($file)) {
            return asset("uploads/logo-192x192.png?v=" . time());
        }

        if (!file_exists($file)) {
            return asset("uploads/logo-192x192.png?v=" . time());
        }

        return asset($file . "?v=" . time());
    }
}


# currencySymbol
if (!function_exists("currencySymbol")) {
    function currencySymbol()
    {
        //TODO:: System setting currency symbol will implement here
        return "$";
    }
}

# currencySymbol
if (!function_exists("showExpireDateTime")) {
    function showExpireDateTime($value)
    {

        return carbonParse($value)->format("d-M Y, 23:59:59");
    }
}


# Find By Id

if (!function_exists("findById")) {
    function findById(\Illuminate\Database\Eloquent\Model $model,  $id, array | string $withRelationShip = [])
    {

        // Relationship Add
        (!empty($withRelationShip) ? $model->with($withRelationShip) : true);

        if (is_array($id)) {
            return $model->find($id);
        }

        return  $model->findOrFail($id);
    }
}

#Get the Subdomain from the Route
if (!function_exists("getSubDomain")) {
    function getSubDomain()
    {
        $subdomain = explode('.', request()->getHost());

        return count($subdomain) > 2 ? $subdomain[0] : null;
    }
}

#Get the Subdomain from the Route
if (!function_exists("getAppUrl")) {
    function getAppUrl()
    {
        $appUrl = config("app.url");

        return explode("//", $appUrl)[1];
    }
}


#Get the Subdomain from the Route
if (!function_exists("serialNoGenerator")) {
    function serialNoGenerator($start = 1, $addLeft = true, $padString = "0", $lentgh = 8): int
    {

        return (int) str_pad($start, $lentgh, $padString, $addLeft ? STR_PAD_LEFT : STR_PAD_RIGHT);
    }
}



#Get the Subdomain from the Route
if (!function_exists("showDateTime")) {
    function showDateTime($value, $formatType = 4)
    {

        return carbonParse($value)->format(getDateTimeFormat($formatType));
    }
}

#Get the Subdomain from the Route
if (!function_exists("getSubTotal")) {
    function getSubTotal($price, $quantity)
    {
        if ($quantity == 0 || $price == 0) {
            return 0;
        }

        return $price * $quantity;
    }
}


#Price Converter
if (!function_exists("priceFormat")) {
    function priceFormat($price, $decimalNumbers = 2)
    {

        return round($price, $decimalNumbers);
    }
}

#Get the Subdomain from the Route
if (!function_exists("getDistributorId")) {
    function getDistributorId($user_id = null)
    {
        if (is_null($user_id)) {
            return user()->distributor?->id ?: null;
        }

        $distributor  = (new \App\Services\Models\DistrackModel\DistrackModelService())->getDistributorByUserId($user_id);
    }
}
#Get the Subdomain from the Route
if (!function_exists("isRead")) {
    function isRead($readAt = null)
    {
        return !empty($readAt);
    }
}


#Get the Subdomain from the Route
if (!function_exists("isExpired")) {
    function isExpired($expire_date_time)
    {
        $expiresAt = carbonParse($expire_date_time);

        return Carbon::now()->greaterThanOrEqualTo($expiresAt);
    }
}



#Get the Subdomain from the Route
if (!function_exists("isExpired")) {
    function isExpired($expire_date_time)
    {
        $expiresAt = carbonParse($expire_date_time);

        return Carbon::now()->greaterThanOrEqualTo($expiresAt);
    }
}


#Get the Subdomain from the Route
if (!function_exists("getGooglePlaceApi")) {
    function getGooglePlaceApi()
    {
        return env("GOOGLE_PLACE_API_KEY");
    }
}

if (!function_exists("getStripeKey")) {
    function getStripeKey()
    {
        return env("STRIPE_PUBLIC_KEY");
    }
}

if (!function_exists("getStripeSecret")) {
    function getStripeSecret()
    {
        return env("STRIPE_SECRET_KEY");
    }
}

if (!function_exists("getStripeWebhookSecret")) {
    function getStripeWebhookSecret()
    {
        return env("STRIPE_WEBHOOK_SECRET");
    }
}

if (!function_exists("isLaravelGmailLoggedIn")) {
    function isLaravelGmailLoggedIn()
    {
        if (session()->get('gmailLoginCheck') == 'login') {
            return LaravelGmail::check();
        }
        return false;
        //        if ( session('gmailLoginCheck')){
        //            return LaravelGmail::check();
        //        }
    }
}

/**
 * It's returning only email who is logged in to the gmail account.
 *
 * ex. abcd@gmail.com
 * */
if (!function_exists("laravelGmailUser")) {
    function laravelGmailUser()
    {
        if (!isLaravelGmailLoggedIn()) {
            // throw new \Exception("Laravel Gmail user is not logged in");
        }


        return  LaravelGmail::user() ?? "rislam252@gmail.com";
    }
}


if (!function_exists("isLaravelGmailSameEmail")) {
    function isLaravelGmailSameEmail($requestEmail)
    {
        return laravelGmailUser() == $requestEmail;
    }
}


if (!function_exists("stringSplit")) {
    function stringSplit($value)
    {
        // Split the input string into an array based on commas or semicolons
        // The regular expression /[,;]+/ matches one or more commas or semicolons
        $keywords = preg_split('/[,;]+/', $value);

        // Filter out any empty elements from the resulting array
        // array_filter() is used to apply a callback function that removes empty strings
        // trim($keyword) !== '' ensures that only non-empty strings are kept
        return array_filter($keywords, function ($keyword) {
            return trim($keyword) !== '';
        });
    }
}

if (!function_exists("createRawIncludeQuery")) {
    function createRawIncludeQuery(array $dataArray)
    {
        if (!empty($dataArray)) {
            return  implode(" OR ", $dataArray);  // hello OR from OR dev
        }

        return "";
    }
}

if (!function_exists("extractName")) {
    function extractName($emailString)
    {
        // Match the name part before the email in angle brackets
        preg_match('/^(.*?)\s*<.*?>$/', $emailString, $matches);

        // If a name is found, clean it up, otherwise return an empty string
        if (!empty($matches[1])) {
            $name = trim($matches[1], ' "\'');
            return Str::title($name);
        }

        // Return empty string if no name part is found
        return '';
    }
}

if (!function_exists("extractEmail")) {
    function extractEmail($emailString)
    {
        preg_match('/<(.+?)>/', $emailString, $matches);

        return $matches[1] ?? $emailString;
    }
}

if (!function_exists("createRawExcludeQuery")) {
    function createRawExcludeQuery($array)
    {
        $string = "";

        if (!empty($array)) {
            $string = '-' . implode("-", $array);
            return $string; // -hello -from -dev
        }
        return $string;
    }
}

if (!function_exists("platformInside")) {
    function platformInside()
    {

        return "1=Gmail, 2=Outlook,3=WhatsApp,4=OpenAI Advice,5=Gemini Advice";
    }
}

if (!function_exists("message_count")) {
    function message_count()
    {
        $payload = session()->get('last_order_info');
        $service = new \App\Services\Google\OrderMessageService();
        $count = $service->storeOrderMessage($payload);
        return $count;
    }
}

/**email encrypt like te**@gmail.com */
if (!function_exists("email_encrypt")) {
    function email_encrypt($email)
    {
        $email = $email;
        $email_parts = explode('@', $email);
        $name = $email_parts[0];
        $domain = $email_parts[1];
        $name = substr($name, 0, 2) . '**';
        //        $domain = substr($domain, 0, 2) . '**';
        return  $name . '@***';
        //        return  $name . '@' . $domain;
    }
}


/**
 * $type == 1 means days, 2 means month, 3 means year
 * $value == 1 ex : 1,2,3,4,5
 * */
if (!function_exists("getStartAndEndDate")) {
    function getStartAndEndDate($value = 0, $type = 1)
    {
        $now = Carbon::now();

        $startDate = null;
        $endDate   = $now->format("Y-m-d");

        if ($type == 1) {
            if ($value == 1) {
                $startDate = Carbon::yesterday()->startOfDay()->format('Y-m-d');
                $endDate = Carbon::yesterday()->endOfDay()->format('Y-m-d');
                return [
                    $startDate,
                    $endDate
                ];
            }
            if ($value == 0) {
                $startDate = Carbon::today()->format('Y-m-d');
                $endDate = Carbon::today()->format('Y-m-d');
                return [
                    $startDate,
                    $endDate
                ];
            }
            if ($value == 7) {
                $startDate = Carbon::now()->subWeek()->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
                $endDate = Carbon::now()->subWeek()->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');
                return [
                    $startDate,
                    $endDate
                ];
            }
            $startDate = $value > 0 ? $now->subDay($value)->format('Y-m-d') : $endDate;
        } else {
            $startDate = $type == 2 ? $now->subMonth($value)->format('Y-m-d') : $now->subYear($value)->format("Y-m-d");
        }

        return [
            $startDate,
            $endDate
        ];
    }
}

if (!function_exists("paginateView")) {
    function paginateView($collections)
    {

        return view("components.common.paginate")->with([
            "items" => $collections
        ]);
    }
}

if (!function_exists("round_value")) {
    function round_value($value)
    {
        return round($value, 2);
    }
}


if (!function_exists("count_partners")) {
    function count_partners()
    {
        return \App\Models\User::query()->where('user_type', 'partner')->get();
    }
}
if (!function_exists("get_all_order")) {
    function get_all_order()
    {
        $order = new \App\Services\Google\OrderMessageService();
        return $order->getAll(false);
    }
}



if (!function_exists("get_all_order")) {
    function get_all_order()
    {
        $order = new \App\Services\Google\OrderMessageService();
        return $order->getAll(false);
    }
}


if (!function_exists("base64UrlDecode")) {
    function base64UrlDecode($input)
    {

        return base64_decode(str_replace(['-', '_'], ['+', '/'], $input));
    }
}


if (!function_exists("getBody")) {
    // Function to get the message body
    function getBody($payload)
    {
        // if (isset($payload['parts'])) {
        //     foreach ($payload['parts'] as $part) {
        //         if ($part['mimeType'] === 'text/plain' && isset($part['body']['data'])) {
        //             return base64_decode(str_replace(['-', '_'], ['+', '/'], $part['body']['data']));
        //         }
        //     }
        // }
        // elseif (isset($payload['body']['data'])) {
        //     return base64_decode(str_replace(['-', '_'], ['+', '/'], $payload['body']['data']));
        // }

        // return null;

        $body = '';
        if (isset($payload['parts'])) {
            foreach ($payload['parts'] as $part) {
                if (isset($part['body']['data'])) {
                    $body .= base64UrlDecode($part['body']['data']);
                }
            }
        } else {
            if (isset($payload['body']['data'])) {
                $body = base64UrlDecode($payload['body']['data']);
            }
        }
        return $body;
    }
}

if (!function_exists("getGmailMessageBody")) {
    /**
     * Extracts the body content from a Gmail message payload.
     *
     * @param array $payload The Gmail API response for a single message.
     * @return array An array containing the extracted HTML and plain text body content, if available.
     */

    function getGmailMessageBody($payload)
    {
        $body = [
            'html' => "",
            'text' => "",
            'document' => []
        ];

        // Check if the payload has multiple parts (multipart message)
        if (isset($payload['parts'])) {
            // Iterate through each part
            foreach ($payload['parts'] as $part) {
                // Check if the part has body data or is a multipart itself
                if (isset($part['body']['data'])) {
                    // Decode the base64-encoded data
                    $decodedData = base64UrlDecode($part['body']['data']);

                    // Normalize the decoded data to handle potential character variations
                    $normalizedData = normalizeData($decodedData);

                    // Check the MIME type to determine if it's text content
                    if (isset($part['mimeType'])) {
                        if (strpos($part['mimeType'], 'text/html') !== false) {
                            $body['html'] .= $normalizedData;
                        } elseif (strpos($part['mimeType'], 'text/plain') !== false) {
                            $body['text'] .= $normalizedData;
                        }
                    }
                } elseif (isset($part['parts'])) {
                    // If the part contains more sub-parts, recursively process them
                    $subBody = getGmailMessageBody($part);
                    $body['html'] .= $subBody['html'];
                    $body['text'] .= $subBody['text'];
                    $body['document'] = array_merge($body['document'], $subBody['document']);
                }

                // Check for attachments
                if (isset($part['body']['attachmentId'])) {
                    $body['document'][] = [
                        'mimeType' => $part['mimeType'],
                        'filename' => $part['filename'],
                        'attachmentId' => $part['body']['attachmentId'],
                    ];
                }
            }
        } else {
            // Single-part message
            if (isset($payload['body']['data'])) {
                $decodedData = base64UrlDecode($payload['body']['data']);
                $normalizedData = normalizeData($decodedData);

                if (isset($payload['mimeType']) && strpos($payload['mimeType'], 'text/html') !== false) {
                    $body['html'] .= $normalizedData;
                } elseif (isset($payload['mimeType']) && strpos($payload['mimeType'], 'text/plain') !== false) {
                    $body['text'] .= $normalizedData;
                }
            }

            // Handle single-part attachments
            if (isset($payload['body']['attachmentId'])) {
                $body['document'][] = [
                    'mimeType' => $payload['mimeType'],
                    'filename' => $payload['filename'],
                    'attachmentId' => $payload['body']['attachmentId'],
                ];
            }
        }

        return $body;
    }
}

if (!function_exists("normalizeData")) {
    /**
     * Normalizes text data by removing invisible characters and applying character normalization.
     *
     * @param string $data The input text data.
     * @return string The normalized text data.
     */
    function normalizeData($data)
    {
        // This pattern matches various types of non-breaking spaces, invisible characters, and control characters
        $pattern = '/[\x{00A0}\x{2000}-\x{200F}\x{202F}\x{205F}\x{3000}\x{2028}\x{2029}\x{FEFF}\x{0080}-\x{009F}\x{202A}\x{202B}\x{202C}\x{202D}\x{202E}\s]/u';

        // Replace them with a regular space or remove them completely
        return preg_replace($pattern, ' ', $data); // Use '' to remove or ' ' to replace with a space
    }
}

if (!function_exists("extract_charset")) {
    function extract_charset($html)
    {
        if (preg_match('/<meta\s+[^>]*charset=[\'"]?([a-zA-Z0-9\-]+)[\'"]?/i', $html, $matches)) {
            return $matches[1]; // Return the detected charset
        }

        return null; // No charset found
    }
}


if (!function_exists("isOutlookPlatform")) {
    function isOutlookPlatform()
    {

        return request()->has("platform") && (string) request()->platform == "outlook";
    }
}


if (!function_exists("isGmailPlatform")) {
    // Function to get the message body
    function isGmailPlatform()
    {

        return request()->has("platform") && (string)request()->platform !== "outlook";
    }
}


if (!function_exists("is100")) {
    // Function to get the message body
    function is100($totalMessages)
    {

        return   $totalMessages >= 100;
    }
}


if (!function_exists("calculateBenchMark")) {
    // Function to get the message body
    function calculateBenchMark($previous = 0, $current = 0)
    {

        if ($previous == 0) {
            return $current == 0 ? 0 : $current * 100;
        }

        if ($current == 0) {
            if ($previous == 0) {

                return 0;
            }

            return - ($previous * 100);
        }

        return (($current - $previous) / $previous) * 100;
    }
}

if (!function_exists("highlightString")) {
    function highlightString($text, $search)
    {
        // Escape special characters in the search term
        $search = preg_quote($search, '/');

        // Replace matched search term with highlighted version
        $highlightedText = preg_replace("/($search)/i", '<span style="background-color: yellow;">$1</span>', $text);

        return $highlightedText;
    }
}

if (!function_exists("bench_mark")) {
    // Function to get the message body
    function bench_mark($value = 0, $benchMarkClass = "defaultClass")
    {

        $successDangerClass = $value < 0 ? "text-danger" : "text-success d-inline-block";
        $trendingClassUpDown = $value < 0 ? "ti ti-trending-down" : "ti ti-trending-up";

        return  '<span class="' . $successDangerClass . ' fs-12 ms-2 fw-semibold ' . $benchMarkClass . '">
                    <i class="' . $trendingClassUpDown . ' align-middle me-1"></i>
                    ' . number_format($value, 2) . '%
                </span>';
    }
}

if (!function_exists('setEnvironmentValue')) {
    /**
     * Set environment variable value
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    function setEnvironmentValue($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            // Read the .env file content
            $env = file_get_contents($path);

            // Look for existing variable
            $pattern = "/^{$key}=.*/m";
            if (preg_match($pattern, $env)) {
                // Replace existing value
                $env = preg_replace($pattern, "{$key}={$value}", $env);
            } else {
                // Append new value
                $env .= "\n{$key}={$value}";
            }

            // Write the content back to the .env file
            file_put_contents($path, $env);
        }
    }
}


if (!function_exists("setMemoryLimitation")) {
    // Function to get the message body
    function setMemoryLimitation()
    {
        ob_start();
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
        set_time_limit(-1);
        ini_set("pcre.backtrack_limit", 500000000000);
    }
}

if (!function_exists("getTheOrderStage")) {
    // Function to get the message body
    function getTheOrderStage($processing_status)
    {

        /**
         *1=Fetching Start, 2=Fetching End, 3=pdf_making_start_at, 4=pdf_making_end_at
         */

        if ($processing_status == 1) {
            return '<span class="badge bg-primary">Data Fetching</span>';
        }

        if ($processing_status == 2) {
            return '<span class="badge bg-success">Data Fetching Done</span>';
        }

        if ($processing_status == 3) {
            return '<span class="badge bg-warning">Pdf Making has started</span>';
        }

        if ($processing_status == 4) {
            return '<span class="badge bg-info">Pdf is ready.</span>';
        }
    }
}
if (!function_exists("convertToLocalDateTime")) {
    function convertToLocalDateTime($utcDateTime, $format = 'd-m-Y H:i:s')
    {
        try {
            $timezone = session('user_timezone') ?? config('app.timezone');
            return Carbon::parse($utcDateTime)
                ->setTimezone($timezone)
                ->format($format);
        } catch (Exception $exception) {
            $timezone = config('app.timezone');
            return Carbon::parse($utcDateTime)
                ->setTimezone($timezone)
                ->format($format);
        }
    }
}
if (!function_exists("convertToLocalDate")) {
    function convertToLocalDate($utcTime, $format = 'd-m-Y')
    {
        try {
            $timezone = session('user_timezone') ?? config('app.timezone');
            return Carbon::parse($utcTime)
                ->setTimezone($timezone)
                ->format($format);
        } catch (Exception $exception) {
            $timezone = config('app.timezone');
            return Carbon::parse($utcTime)
                ->setTimezone($timezone)
                ->format($format);
        }
    }
}
if (!function_exists("convertToLocalTime")) {
    function convertToLocalTime($utcTime, $format = 'H:i:s')
    {
        try {
            $timezone = session('user_timezone') ?? config('app.timezone');
            return Carbon::parse($utcTime)
                ->setTimezone($timezone)
                ->format($format);
        } catch (Exception $exception) {
            $timezone = config('app.timezone');
            return Carbon::parse($utcTime)
                ->setTimezone($timezone)
                ->format($format);
        }
    }
}

if (!function_exists("getTimezone")) {
    /**
     * Get the timezone of the authenticated user or fallback to the default app timezone.
     *
     * @return string
     */
    function getTimeZone()
    {
        // If the user is authenticated, return the user's timezone.
        // Otherwise, fallback to the default timezone defined in config/app.php.
        return auth()->user()->timezone ?? config('app.timezone');
    }
}



if (!function_exists('getCountries')) {
    function getCountries()
    {
        return \App\Models\Language::where("is_active", "=", 1)->join("localizations", "languages.id","=", "localizations.language_id")->groupBy("languages.code")->orderBy("name", "ASC")->get();
    }
}

if (!function_exists('localize')) {
    function localize($key, $language = null)
    {

        // Get specific text for its language code
        if(isset($language))
            $code = $language;
        else
            $code = Redis::get("lang");

        $languageCode = (empty($code))? "en":$code; // Get the current language code from session
        $language = \App\Models\Language::where('code', $languageCode)->first(); // Retrieve the language model

        if (!$language) {
            return $key; // Return the key if language is not found
        }

        // Try to find the localization entry for the given key in the selected language
        $localization = \App\Models\Localization::where('key', $key)
            ->where('language_id', $language->id)
            ->first();

        $englishId = 1; // The ID for English localization

        // If not found, try to find it in English
        if (empty($localization)) {
            $localization = \App\Models\Localization::where('key', $key)
                ->where('language_id', $englishId)
                ->first();
        }

        // Check if localization was found
        if ($localization) {
            return $localization->value; // Return the localization value
        }

        return $key; // If no localization is found, return the key itself
    }
}
