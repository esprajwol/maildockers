<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageArchive extends Model
{
    use HasFactory;
    protected $table = "message_archives";
    protected $fillable = [
        "purpose",
        "to_number", 
        "from_number", 
        "body",
        "otp",
        "sms_provider",
        "created_by_id",
        "updated_by_id",
        "deleted_by_id"
    ];
}
