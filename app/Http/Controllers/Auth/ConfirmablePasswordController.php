<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        // return view('auth.confirm-password');
        return view('user.update_profile');
    }

    /**
     * Confirm the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {

        if (!Hash::check($request->password_old, $request->user()->password)) {
            return back()->withErrors([
                'password' => ['The provided password does not match our records.']
            ]);
        }

        $input = $request->validate([
            'password' => [
                'required',
                'min:2',
                'string',

            ],
        ]);
        $input['password'] = Hash::make($request->password);
        User::find(auth()->user()->id)->update($input);

        $request->session()->passwordConfirmed();

        return redirect()->intended();
    }
}
