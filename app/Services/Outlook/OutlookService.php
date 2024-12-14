<?php

namespace App\Services\Outlook;

use App\TokenStore\TokenCache;
use Microsoft\Graph\Graph;

class OutlookService
{
    /**
     * Retrieves all messages from the inbox and sent items,
     * optionally filtered by keywords (as an array) and date range.
     *
     * @param string $email The email address to filter by.
     * @param array|null $keywords Optional array of keywords to search for in the messages.
     * @param string|null $startDate Optional start date for filtering messages.
     * @param string|null $endDate Optional end date for filtering messages.
     * @return array Filtered messages from inbox and sent items.
     */
    public static function GetMessages($email, $keywords = null, $startDate = null, $endDate = null, $search_keyword_list = null, $email_from = null)
    {
       // Get inbox and sent messages, merged together
        $inboxMessages = self::GetInboxItems($email, $keywords, $search_keyword_list, $email_from)->getPage();
        $sentMessages = self::GetSentItems($email, $keywords, $search_keyword_list, $email_from)->getPage();
        $totalMessages = array_merge($inboxMessages['value'], $sentMessages['value']);

        // If a date range is provided, filter messages by receivedDateTime
        if ($startDate && $endDate) {
            return collect($totalMessages)->filter(function ($message) use ($startDate, $endDate) {
                $emailDate = date('Y-m-d', strtotime($message['receivedDateTime']));
                return $emailDate >= $startDate && $emailDate <= $endDate;
            })->toArray(); // Convert back to array
        }
        // Filter parent messages
        $parentMessages = array_filter($totalMessages, function ($message) {
            return !preg_match('/^(RE|FWD|FW):\s/i', $message['subject']);
        });

        $allMessages = [];
        $conversationIdArr = [];
        foreach ($totalMessages as $message) {
            $conversationId = $message['conversationId'];
            if(!isset($conversationIdArr[trim($conversationId)])){
                $conversationIdArr[trim($conversationId)] = true;
                $allMessages[] = array_merge($message, ['threads' => self::GetMessageByConversation($conversationId)]);
            }            
        }
        return $allMessages;
    }


    /**
     * Get Outlook Messages by conversation Id
     *
     * @param string $conversationId.
     * @return mixed A collection request for inbox messages.
     */
    public static function GetMessageByConversation($conversationId)
    {
        $graph = self::initGraphClient();
        $conversationMessages = [];

        // Build the URL for the request
        $url = "/me/messages?\$filter=conversationId eq '$conversationId'";
        $url .= '&$select=id,subject,from,toRecipients,bodyPreview,body,receivedDateTime';
        try {
            // Send the request to Microsoft Graph
            $response =  $graph->createCollectionRequest('GET', $url);
            $response = $response->getPage();

            // Loop through each message in the response
            foreach ($response['value'] as $res) {
                $conversationMessages[] = $res;
            }
        } catch (\Exception $e) {
            // Handle exceptions
            echo 'Error: ' . $e->getMessage() . PHP_EOL;
        }
        return $conversationMessages;
    }
    /**
     * Retrieves inbox items for a specific email address, filtered by optional keywords.
     *
     * @param string $email The email address to filter by.
     * @param array|null $keywords Optional array of keywords to search for in the messages.
     * @return mixed A collection request for inbox messages.
     */
    public static function GetInboxItems($email, $keywords, $search_keyword_list, $email_from)
    {
        // Initialize the Graph API client with access token
        $graph = self::initGraphClient();

        // Define the specific properties to retrieve from messages
        $select = '$select=from,toRecipients,isRead,receivedDateTime,body,subject,conversationId';

        // Build search query based on email and optional keywords
        // $from = "from:" . $email;
        // $query = $from;

        $query = "(from:$email_from AND to:$email)";

        // If keywords are provided, add each one to the search query
        if ($search_keyword_list == 1 || $search_keyword_list === "1") {
            if (!empty($keywords)) {
                $keywordsArray = explode(',', $keywords);
                $keywordSearch = implode(' OR ', array_map('trim', $keywordsArray));
                $query .= " AND $keywordSearch";
            }
        }

        // Construct request URL with search and select parameters
        $requestUrl = '/me/messages?$search="' . $query . '"&' . $select;

        // Return the collection request to fetch inbox items
        return $graph->createCollectionRequest('GET', $requestUrl);
    }

    /**
     * Retrieves sent items for a specific email address, filtered by optional keywords.
     *
     * @param string $email The email address to filter by.
     * @param array|null $keywords Optional array of keywords to search for in the messages.
     * @return mixed A collection request for sent messages.
     */
    public static function GetSentItems($email, $keywords, $search_keyword_list, $email_from)
    {
        // Initialize the Graph API client with access token
        $graph = self::initGraphClient();

        // Define the specific properties to retrieve from messages
        $select = '$select=from,toRecipients,isRead,receivedDateTime,body,subject,conversationId';

        // Build search query based on email and optional keywords
        // $recipients = "recipients:" . $email;
        // $query = $recipients;

        $query = "(from:$email AND to:$email_from)";

        // If keywords are provided, add each one to the search query
        if ($search_keyword_list == 1 || $search_keyword_list === "1") {
            if (!empty($keywords)) {
                $keywordsArray = explode(',', $keywords);
                $keywordSearch = implode(' OR ', array_map('trim', $keywordsArray));
                $query .= " AND $keywordSearch";
            }
        }

        // Construct request URL with search and select parameters
        $requestUrl = '/me/messages?$search="' . $query . '"&' . $select;

        // Return the collection request to fetch sent items
        return $graph->createCollectionRequest('GET', $requestUrl);
    }

    /**
     * Initializes the Microsoft Graph client with an access token.
     *
     * @return Graph An instance of the Graph client initialized with the access token.
     */
    private static function initGraphClient()
    {
        // Retrieve the access token from the token cache
        $tokenCache = new TokenCache();
        $accessToken = $tokenCache->getAccessToken();

        // Initialize the Graph client and set the access token
        $graph = new Graph();
        $graph->setAccessToken($accessToken);

        return $graph;
    }
}
