<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // ログイン後のリダイレクト先
    protected $redirectTo = '/events'; // 変更

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // logoutアクション以外ではguestである必要がある
        // guest とは、ログイン認証されていない閲覧者
        $this->middleware('guest')->except('logout');
    }

 
}
