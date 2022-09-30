<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function __construct()
    {
    }
    public function store_cart(Request $request)
    {
        $request->validate([
            'detail' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
        ]);
        $quantity = $request->quantity;
        $cart = Cart::where('id_user', Auth::id())->where('id_product_detail', $request->detail)->first();
        if ($cart) {
            $cart->update(['quantity'=> $cart->quantity + $quantity]);
            $response = [
                'status' => 200,
                'data'  => $cart,
            ];
        } else {
            $product_detail = ProductDetail::find($request->detail);
            $data = [
                'id_user'   => Auth::id(),
                'id_store'  => $product_detail->product->id_store,
                'id_product'    => $product_detail->id_product,
                'id_product_detail' => $product_detail->id,
                'quantity'   => $quantity
            ];
            $result = Cart::create($data);
            if ($result) {
                $response = [
                    'status'    => 201,
                    'data'  => [
                        'id' => $result->id,
                        'quantity'  => $result->quantity,
                        'product' => [
                            'slug' => $result->product->slug,
                            'name' => $result->product->name,
                            'type' => $result->product->type,
                        ],
                        'detail'  => [
                            'url_image' => $result->detail->url_image,
                            'color_value'   => $result->detail->color_value,
                            'attribute' => $result->detail->attribute,
                            'attribute_value'   => $result->detail->attribute_value,
                            'price' => $result->detail->price
                        ]
                    ]
                ];
            } else {
                $response = [
                    'status'    => 400,
                    'data'      => 'something your request is error'
                ];
            }
        }
        return json_encode($response);
    }
}
