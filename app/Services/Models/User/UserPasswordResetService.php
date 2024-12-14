<?php

namespace App\Services\Models\User;

use Illuminate\Support\Facades\Hash;

class UserPasswordResetService
{
    public function update(object $user, array $data) : object
    {
        $user->update($data);
        return $user;
    }
}
