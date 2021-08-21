<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordChangeRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class PasswordController extends Controller
{
    public function changePassword(): View
    {
        return view('admin.change_password');
    }

    public function store(PasswordChangeRequest $request): RedirectResponse
    {
        $userId = \Auth::id();
        $user = User::find($userId);

        $newPassword = \Hash::make($request->password);

        $user->password = $newPassword;
        $user->save();

        return Redirect::back()
            ->with('alert-success', __('messages.password_changed'));
    }
}
