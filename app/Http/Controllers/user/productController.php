<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class productController extends Controller
{
    public function __construct()
    {
    
    }
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $product_related = Product::join('store', 'store.id', '=', 'product.id_store')
        ->where('store.status', '=', '1')
        ->where('product.id_store', '=', $product->id_store)
        ->where('product.status', '=', '0')
        ->where('product.category_path', 'like', $product->category_path.'%')
        ->limit(6)->get();
        return view('home.pages.productDetail', [
            'product' => $product,
            'product_related'=> $product_related
        ]);
    }


}
