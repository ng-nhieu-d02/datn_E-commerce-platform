<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;
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
    public function product()
    {
        $product =  Product::find(1);
        return view('home.pages.productDetail', [
            'product' => $product
        ]);
    }
    public function checkout(){
        return view('home.pages.checkout');
    }
}
