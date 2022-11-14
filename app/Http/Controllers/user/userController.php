<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ProductDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class userController extends Controller
{
    public function __construct()
    {
    }
    public function cart()
    {
        Auth::user()->cart()->where('status','1')->update(['status' => '0']);
        return view('home.pages.cart');
    }
    public function store_cart(Request $request)
    {
        $request->validate([
            'detail' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
        ]);
        $quantity = $request->quantity;
        $product_detail = ProductDetail::find($request->detail);
        if ($quantity > $product_detail->quantity - $product_detail->sold) {
            $response = [
                'status' => 401,
                'message'  => 'quantity is error'
            ];
        } else {
            $cart = Cart::where('id_user', Auth::id())->where('id_product_detail', $request->detail)->first();
            if ($cart) {
                $cart->update(['quantity' => $cart->quantity + $quantity]);
                $response = [
                    'status' => 200,
                    'data'  => $cart,
                ];
            } else {
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
                        'message'      => 'something your request is error'
                    ];
                }
            }
        }
        return json_encode($response);
    }

    public function profile()
    {
        return view('home.pages.profile');
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'username' => 'bail|required|unique:users,name',
            'phone' => 'bail|required|digits:10|numeric',
            'email' => 'bail|required|unique:users,email,' . auth()->user()->id . '|email:rfc,dns',
            'name' => 'bail|required',
            'gender' => 'bail|required|string',
            'file_image' => 'mimes:jpg,jpeg,png'
        ]);
        $getImageUrl = User::where('id', auth()->user()->id)->value('avatar');

        $file_image = $request->file('file_image');
        if (!empty($file_image)) {
            Storage::disk('public')->delete($getImageUrl);
            $path = Storage::disk('public')->put('avatars', $file_image);
            $validated['avatar'] = $path;
        }

        $user = User::find(auth()->user()->id);
        $user->update($validated);
        return redirect()->back()->with('Update success', 'Update Successfully');
    }
<<<<<<< HEAD
<<<<<<< HEAD
=======
        
>>>>>>> eb0c6e68ac446d829f1d8bed55e7a4ca197105a4
=======
>>>>>>> e4aed67ac5a6690b0e07a33b29c3d8625fce9e3f
    public function delete_item_cart(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
        ]);
        $result = Cart::find($request->id)->delete();
        if ($result) {
            $response = [
                'status'    => 200,
                'message'      => 'success'
            ];
        } else {
            $response = [
                'status'    => 400,
                'message'      => 'something is error, please try again'
            ];
        };
        return json_encode($response);
    }
    public function update_item_cart(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
        ]);
        $result = Cart::find($request->id);
        if ($result < $request->quantity) {
            $response = [
                'status'    => 400,
                'message'   => 'error',
            ];
        } else {
            $result->quantity = $request->quantity;
            $result->save();
            $response = [
                'status'    => 200,
                'message'   => 'success'
            ];
        }
        return json_encode($response);
    }
    
}
