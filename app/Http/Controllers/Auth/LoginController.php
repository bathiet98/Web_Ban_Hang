<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestLogin;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       //$this->middleware('guest')->except('logout');
    }

    public function getFromLogin()
    {
        $title_page = 'Đăng nhập';
        return view('auth.login',compact('title_page'));
    }

    public function postLogin(RequestLogin $request)
    {
        $login = $request->only('email', 'password');

        if (Auth::attempt($login)) {
            \Session::flash('toastr',[
                'type'       => 'success',
                'message'   => 'Đăng Nhập Thành Công'
            ]);
            // Authentication passed...
            return redirect()->intended('/');
        }

        return redirect()->back();
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->to('');
    }
}
