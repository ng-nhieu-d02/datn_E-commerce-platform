<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\CommentProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function __construct()
    {
    }
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $getTotalCommentByProduct = $product->comment()->count();
        return view('home.pages.productDetail', [
            'product' => $product,
            'getTotalCommentByProduct' => $getTotalCommentByProduct,
        ]);
    }


}
