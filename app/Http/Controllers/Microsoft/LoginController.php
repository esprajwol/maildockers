<?php

namespace App\Http\Controllers\Microsoft;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

class LoginController extends Controller
{
    private $clientId;
    private $clientSecret;
    private $redirectUri;
    private $authority;
    private $authorizeEndpoint;
    private $tokenEndpoint;
    private $scopes;

    public function __construct()
    {
        $this->clientId = config('services.microsoft.client_id');
        $this->clientSecret = config('services.microsoft.client_secret');
        $this->redirectUri = config('services.microsoft.redirect');
        $this->authority = env('MICROSOFT_AUTHORITY');
        $this->authorizeEndpoint = env('MICROSOFT_AUTHORIZE_ENDPOINT');
        $this->tokenEndpoint = env('MICROSOFT_TOKEN_ENDPOINT');
        $this->scopes = env('MICROSOFT_SCOPES');
    }

    public function redirectToMicrosoft()
    {
        $authorizationUrl = $this->authority . $this->authorizeEndpoint;
        $params = [
            'client_id' => $this->clientId,
            'redirect_uri' => urlencode($this->redirectUri),
            'response_type' => 'code',
            'scope' => $this->scopes,
            'response_mode' => 'query',
        ];
        $query = http_build_query($params);

        return redirect($authorizationUrl . '?' . $query);
    }

    public function handleMicrosoftCallback(Request $request)
    {
        $code = $request->query('code');

        if (!$code) {
            return redirect('/login')->withErrors('Authorization code not returned');
        }

        $tokenUrl = $this->authority . $this->tokenEndpoint;
        $response = Http::asForm()->post($tokenUrl, [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'code' => $code,
            'redirect_uri' => $this->redirectUri,
            'grant_type' => 'authorization_code',
        ]);

        $body = $response->json();

        if (isset($body['error'])) {
            return redirect('/login')->withErrors('Error retrieving access token');
        }

        $accessToken = $body['access_token'];

        $graphUrl = 'https://graph.microsoft.com/v1.0/me';
        $userResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get($graphUrl);

        $userData = $userResponse->json();

        $user = User::updateOrCreate(
            ['email' => $userData['mail'] ?? $userData['userPrincipalName']],
            [
                'name' => $userData['displayName'],
                'password' => bcrypt(str_random(16)),
            ]
        );

        Auth::login($user, true);

        return redirect()->intended('dashboard');
    }
}
