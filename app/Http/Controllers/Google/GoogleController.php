<?php

namespace App\Http\Controllers\Google;

use App\Http\Controllers\Controller;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function something() {
        // $messages = LaravelGmail::message()->subject('test')->unread()->preload()->all();
        $messages = LaravelGmail::message()
                ->from('ewcanwin@gmail.com')
                ->hasAttachment()
                ->all();
        foreach ( $messages as $message ) {
            $body = $message->getHtmlBody();
            $subject = $message->getSubject();
        }
    }
}
