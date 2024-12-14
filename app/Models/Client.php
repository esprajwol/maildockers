<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'client';
    protected $fillable = [
        'user_id', 'card_number', 'card_holder_name', 'card_exipre', 'card_cvv', 'business_name', 'business_address', 'vat_no', 'attachment'
    ];
}
