<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $google = 'https://accounts.google.com/o/oauth2/auth?response_type=code&client_id=549830004697-qc6ihiudedmh14r1g65rjifj7mhh3h3q.apps.googleusercontent.com&redirect_uri='.route('user.loginGoogle').'&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile&approval_prompt=force&flowName=GeneralOAuthFlow';
        $facebook = 'https://www.facebook.com/v12.0/dialog/oauth?client_id=1582788455527311&redirect_uri='.route('user.loginFacebook').'&scope=public_profile';
        return view('auth.login', [
            'url_google'    => $google,
            'url_facebook'  => $facebook
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $user = User::where("email", $request->email)->first();

       

        $request->authenticate();
        
        if($user->status == '4'){
            return back()->with("error", "Tài khoản bị khoá, vui lòng liên hệ quản trị viên");
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
