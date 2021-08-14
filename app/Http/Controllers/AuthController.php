<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    /**
     * @var LoginService
     */
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $login = $this->loginService->execute($request);



        if (!$login) {
            return Redirect::to('/admin')->withErrors(['failed_login' => __('auth.failed_login')]);
        }

        return Redirect::to('/admin/dashboard');

        //Session::flash('error', 'Flash error!');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
