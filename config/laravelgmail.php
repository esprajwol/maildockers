<?php

return [

/*
|--------------------------------------------------------------------------
| Gmail Configuration
|--------------------------------------------------------------------------
|
| Here you may specify the configuration for your Gmail credentials
|
*/
'project_id' => env('GOOGLE_PROJECT_ID'),
'client_id' => env('GOOGLE_CLIENT_ID'),
'client_secret' => env('GOOGLE_CLIENT_SECRET'),
'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
'state' => env('GOOGLE_STATE'),

/*
|--------------------------------------------------------------------------
| Token Configuration
|--------------------------------------------------------------------------
|
| Here you may specify the configuration for the token
|
*/
'allow_json_encrypt' => env('ALLOW_JSON_ENCRYPT', true),
'credentials_file_name' => env('GOOGLE_CREDENTIALS_NAME', 'gmail-json.json'),
'credentials_path' => storage_path('app/credentials/gmail-json.json'),

/*
|--------------------------------------------------------------------------
| Token Prefix
|--------------------------------------------------------------------------
|
| Here you may specify the token prefix which will be used to store the
| token in the session or database uniquely for each user.
|
*/
'token_prefix' => 'laravelgmail_',

/*
|--------------------------------------------------------------------------
| User Model
|--------------------------------------------------------------------------
|
| Here you may specify the user model to be used by the package. This is
| necessary to store the token in the database for each user.
|
*/
'user_model' => \App\Models\User::class,
];
