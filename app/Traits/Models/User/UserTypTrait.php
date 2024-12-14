<?php

namespace App\Traits\Models\User;

trait UserTypTrait
{
    public function scopeUserType($query, $user_type = null)
    {
        $query->where('user_type', $user_type);
    }
}
