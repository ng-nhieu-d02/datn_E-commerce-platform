<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function __construct()
    {
    }
    public function loginGoogle(Request $request)
    {
        if (isset($request->code)) {
            $secret = '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';
            $client_id = '549830004697-qc6ihiudedmh14r1g65rjifj7mhh3h3q.apps.googleusercontent.com';
            $redirect_url = route('user.loginGoogle');
            $code = $request->code;

            $url = 'https://www.googleapis.com/oauth2/v4/token';
            $data = [
                'code'  => $code,
                'client_id' => $client_id,
                'client_secret' => $secret,
                'redirect_uri' => $redirect_url,
                'grant_type' => 'authorization_code'
            ];
            $data_string = http_build_query($data);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $response = json_decode($response);
            $token = $response->access_token;
            curl_close($ch);

            $url_token = 'https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token';
            $url_get_info_user = $url_token . "=$token";
            $call = curl_init();
            curl_setopt($call, CURLOPT_URL, $url_get_info_user);
            curl_setopt($call, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($call, CURLOPT_RETURNTRANSFER, 1);

            $user_info = curl_exec($call);
            curl_close($call);
            $user_info = json_decode($user_info);

            $user = User::where('username', $user_info->id)->count();
            if ($user == 0) {
                $user = [
                    'username'  => $user_info->id,
                    'name'      => $user_info->name,
                    'password'  => Hash::make('social'),
                ];
                $user = User::create($user);
                $avatar = $user_info->picture;

                $fp = 'upload\profile\avatar/' . $user->id . '.png';
                if (file_exists($fp)) {
                    unlink($fp);
                }
                file_put_contents($fp, file_get_contents($avatar));
                $user->avatar = $user->id . '.png';
                $user->save();
            }

            if (Auth::attempt(['username' => $user_info->id, 'password' => 'social'], false)) {
                $request->session()->regenerate();
                return redirect()->route('user.home');
            }
        }
    }
    public function loginFacebook(Request $request)
    {
        if (isset($request->code)) {
            $secret = '';
            $client_id = '';
            $redirect_url = '';
            $code = $request->code;

            $url = '';
            $call = curl_init();
            curl_setopt($call, CURLOPT_URL, $url);
            curl_setopt($call, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($call, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($call);
            $response = json_decode($response);
            $response = $response->access_token;
            curl_close($call);

            $url_get_info_user = '' . $response;
            $call = curl_init();
            curl_setopt($call, CURLOPT_URL, $url_get_info_user);
            curl_setopt($call, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($call, CURLOPT_SSL_VERIFYPEER, false);
            $user_info = curl_exec($call);
            curl_close($call);

            $user_info = json_decode($user_info);

            $user = User::where('username', $user_info->id)->count();
            if ($user == 0) {
                $user = [
                    'username'  => $user_info->id,
                    'name'      => $user_info->name,
                    'password'  => Hash::make('social'),
                ];
                $user = User::create($user);
                $avatar = $user_info->picture;

                $fp = 'upload\profile\avatar/' . $user->id . '.png';
                if (file_exists($fp)) {
                    unlink($fp);
                }
                file_put_contents($fp, file_get_contents($avatar));
                $user->avatar = $user->id . '.png';
                $user->save();
            }

            if (Auth::attempt(['username' => $user_info->id, 'password' => 'social'], false)) {
                $request->session()->regenerate();
                return redirect()->route('user.home');
            }
        }
    }
}
