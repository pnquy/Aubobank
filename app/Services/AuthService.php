<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthService
{
    public function login($credentials)
    {
        $user = $this->getUserByEmail($credentials['email']);

        if ($user && $user->active == 0) {
            throw ValidationException::withMessages([
                'email' => ['Your account is not active.'],
            ]);
        }

        return Auth::attempt($credentials);
    }

    protected function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
