<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\PermissionStore;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Store;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserWishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class userController extends Controller
{
    public function __construct()
    {
    }
    public function cart()
    {
        Auth::user()->cart()->where('status', '1')->update(['status' => '0']);
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

    public function registerBooth()
    {
        $checkStore = PermissionStore::where("id_user", request()->user()->id)->first();

        // dd($checkStore);

        return view("home.pages.register_booth", [
            'checkStore' => $checkStore
        ]);
    }

    public function storeBooth(Request $request)
    {
        $userId = $request->user()->id;

        $validated = $request->validate([
            "name" => ["bail", "required", "unique:store,name"],
            "name_cate" => ["bail", "required"],
            "slogan" => ["bail", "required"],
            "message" => ["bail", "required"],
            "city" => ["bail", "required"],
            "district" => ["bail", "required"],
            "address" => ["bail", "required"],
            "avatar" => ["bail", "required", "mimes:jpg,jpeg,png"],
            "background" => ["bail", "required", "mimes:jpg,jpeg,png"],
        ]);

        $nameCates = explode(",", $validated["name_cate"]);

        $extensionAvatar = $validated['avatar']->extension();
        $fileNameAvatar = "avatar-store-of-user-" . $userId . "." . $extensionAvatar;

        $extensionBackground = $validated['background']->extension();
        $fileNameBackground = "background-store-of-user-" . $userId . "." . $extensionBackground;


        $store['name'] = $validated['name'];
        $store['slug'] = Str::slug($store['name'], '-');
        $store['avatar'] = $fileNameAvatar;
        $store['background'] = $fileNameBackground;
        $store['slogan'] = $validated['slogan'];
        $store['address'] = $validated['address'];
        $store['city'] = $validated['city'];
        $store['district'] = $validated['district'];

        $modelStore = Store::create($store);

        $validated['avatar']->move(public_path('upload/store/avatars'), $fileNameAvatar);
        $validated['background']->move(public_path('upload/store/backgrounds'), $fileNameBackground);

        foreach ($nameCates as $cate) {
            \DB::table('store_cate')->insert([
                'id_store' => $modelStore->id,
                'name' => $cate,
                'slug' => Str::slug($cate, '-'),
            ]);
        }

        \DB::table('permission_store')->insert([
            'id_store' => $modelStore->id,
            'id_user' => $userId,
            'permission' => "0",
        ]);

        \DB::table('ticket_create_store')->insert([
            'id_user' => $userId,
            'id_store' => $modelStore->id,
            'message' => $validated["message"],
        ]);

        return back();
    }

    public function userAddress()
    {
        $address = UserAddress::with(['user'])->where('user_id', '=', auth()->user()->id)->orderBy("status", 'desc')->get();

        return view("home.pages.user_adress", [
            'address' => $address
        ]);
    }

    public function addUserAddress(Request $request)
    {
        $validated = $request->validate([
            "city" => 'bail|required|string',
            "district" => 'bail|required|string',
            "address" => 'bail|required|string',
        ]);
        $validated['status'] = "0";
        $validated['user_id'] = auth()->user()->id;

        UserAddress::updateOrCreate($validated);

        return back()->with("message", "Địa chỉ đã được thêm mới");
    }

    public function showUserAddress($id)
    {
        $userAddress = UserAddress::find($id);

        return response()->json([
            'data' => $userAddress,
            'success' => true,
        ]);
    }

    public function updateUserAddress(Request $request)
    {
        $id = $request->id;
        $city = $request->city;
        $district = $request->district;
        $address = $request->address;

        $userAddress = UserAddress::find($id);

        $userAddress->city = $city;
        $userAddress->district = $district;
        $userAddress->address = $address;

        $saved = $userAddress->save();

        if($saved){
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi vui lòng thử lại',
            ]);
        }

        
    }

    public function updateAddressStatus($id)
    {
        $listUserAdress = UserAddress::where("user_id", auth()->user()->id)->get();
        $ids = $listUserAdress->pluck("id")->toArray();
        if (in_array($id, $ids)) {
            if (UserAddress::find($id)->status == '1') {
                return back()->with("message", "Đã thiết lập mặc định không cần thiết lập lại");
            } else {
                foreach ($listUserAdress as $userAddress) {
                    if ($userAddress->status == '1') {
                        UserAddress::find($userAddress->id)->update([
                            'status' => '0',
                        ]);
                    }
                }
                $update = UserAddress::find($id);
                $update->status = "1";
                $update->save();
            }
        }
        return back()->with("message", "Thiết lập thành công");
    }

    public function deleteUserAddress($id)
    {
        UserAddress::find($id)->delete();

        return back()->with("message", "Xoá thành công");
    }

    public function wishlist()
    {
        $product = Product::select('product.*')->join('user_wishlist', 'user_wishlist.product_id', '=', 'product.id')->where('user_wishlist.user_id',Auth::user()->id)->paginate(10);
        return view('home.pages.wishlist', [
            'product' => $product
        ]);
    }

    public function add_wishlist(Request $request)
    {
        $id = $request->id;
        $wishlist = UserWishlist::where('user_id',Auth::user()->id)->where('product_id', $id)->count();
        if($wishlist == 0) {
            UserWishlist::create(['user_id' => Auth::user()->id, 'product_id' => $id]);
            $res = ['status' => 'success', 'message' => 'Thêm vào', 'method' => 'add'];
        } else {
            UserWishlist::where('user_id',Auth::user()->id)->where('product_id', $id)->delete();
            $res = ['status' => 'success', 'message' => 'Xoá khỏi' , 'method' => 'remove'];
        }
        return json_encode($res);
    }
}
