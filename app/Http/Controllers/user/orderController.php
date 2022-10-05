<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    public function __construct()
    {
        
    }
    public function checkout(Request $request)
    {
        Auth::user()->cart()->where('status','1')->update(['status' => '0']);
        Auth::user()->cart()->whereIn('id',$request->checkout)->update(['status' => '1']);
        return view('home.pages.checkout');
    }
}
