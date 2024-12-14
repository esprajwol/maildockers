<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class UserSetting extends Model
{
    use HasFactory;
    protected $table = "user_settings";
    protected $fillable = [
        "user_id",
        "is_enable_two_factor_authentication",
        "is_enable_notification",
        "is_enable_sms"
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, "user_id" );
    }
}
