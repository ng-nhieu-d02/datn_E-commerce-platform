<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function __construct()
    {
        
    }
    public function home()
    {
        return view('home.pages.home');
    }
    public function product(){
        return view('home.pages.productDetail');
    }
}
