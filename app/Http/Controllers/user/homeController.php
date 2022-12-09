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
        $product = Product::paginate(9);
        return view('home.pages.home', [
            'product' => $product
        ]);
    }
    public function pageSearch(){
        $product = Product::paginate(9);
        return view('home.pages.pageSearch', [
            'product' => $product
        ]);
    }
}