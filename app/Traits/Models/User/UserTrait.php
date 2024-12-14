<?php

namespace App\Traits\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserTrait
{
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,"user_id");
    }
}
