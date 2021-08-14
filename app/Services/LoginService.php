<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function execute($request): bool
    {
        $user = $request->except(['_token']);

        if (Auth::attempt($user)) {
            return true;
        }

        return false;
    }
}
