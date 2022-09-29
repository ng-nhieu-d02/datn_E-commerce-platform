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
        $product = Product::paginate(8);
        return view('home.pages.home', [
            'product' => $product
        ]);
    }

    public function checkout()
    {
        return view('home.pages.checkout');
    }
}
