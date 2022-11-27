<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    public function __construct()
    {
    }
    public function checkout(Request $request)
    {
        if (isset($request->address)) {
            $address = UserAddress::where('id', '=', $request->address)->first();
        } else {
            $address = UserAddress::where('user_id', '=', Auth::user()->id)->where('status', '=', '0')->first();
        }
        return view('home.pages.checkout', [
            'address' => $address
        ]);
    }
    public function chooseCart(Request $request)
    {
        Auth::user()->cart()->where('id', $request->id)->update(['status' => $request->status]);
    }
}
