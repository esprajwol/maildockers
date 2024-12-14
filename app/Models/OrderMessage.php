<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMessage extends Model
{
    use HasFactory;
    protected $table = 'order_messages';
    protected $fillable = [
        'user_id',
        'order_id',
        'bcc',
        'cc',
        'subject',
        'message',
        'optional_1',
        'optional_2',
        'optional_3',
        'date_time',
    ];
}
