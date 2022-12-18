<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CommentProduct;
use App\Models\Coupons;
use App\Models\PaymentUser;
use App\Models\PermissionStore;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Store;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserWishlist;
use Carbon\Carbon;
use Exception;
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

            'phone' => 'bail|required|digits:10|numeric',
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
        return redirect()->back()->with('success', 'Update Successfully');
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
        $address = UserAddress::with(['user'])->where('user_id', '=', auth()->user()->id)->orderBy("status")->get();
        return view("home.pages.user_adress", [
            'address' => $address
        ]);
    }

    public function addUserAddress(Request $request)
    {
        $validated = $request->validate([
            "name" => 'required|string',
            "city" => 'bail|required|string',
            "district" => 'bail|required|string',
            "address" => 'bail|required|string',
            "phone" => [
                'bail',
                'required',
                'string',
                'regex:/^(84|0[3|5|7|8|9])[0-9]{8}$/i',
            ],
            'email' => 'email:rfc,dns',
        ]);
        $validated['status'] = "1";
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
        $validated = $request->validate([
            "name" => "required|string",
            "city" => 'bail|required|string',
            "district" => 'bail|required|string',
            "address" => 'bail|required|string',
            "phone" => [
                'bail',
                'required',
                'string',
                'regex:/^(84|0[3|5|7|8|9])[0-9]{8}$/i',
            ],
            "email" => "email:rfc,dns",
        ]);


        $userAddress = UserAddress::find($request->id);

        $userAddress->name = $validated['name'];
        $userAddress->city = $validated['city'];
        $userAddress->district = $validated['district'];
        $userAddress->address = $validated['address'];
        $userAddress->phone = $validated['phone'];
        $userAddress->email = $validated['email'];
        $saved = $userAddress->save();

        if ($saved) {
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công',
            ]);
        } else {
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
            if (UserAddress::find($id)->status == '0') {
                return back()->with("message", "Đã thiết lập mặc định không cần thiết lập lại");
            } else {
                foreach ($listUserAdress as $userAddress) {
                    if ($userAddress->status == '0') {
                        UserAddress::find($userAddress->id)->update([
                            'status' => '1',
                        ]);
                    }
                }
                $update = UserAddress::find($id);
                $update->status = "0";
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
        $product = Product::select('product.*')->join('user_wishlist', 'user_wishlist.product_id', '=', 'product.id')->where('user_wishlist.user_id', Auth::user()->id)->paginate(10);
        return view('home.pages.wishlist', [
            'product' => $product
        ]);
    }

    public function add_wishlist(Request $request)
    {
        $id = $request->id;
        $wishlist = UserWishlist::where('user_id', Auth::user()->id)->where('product_id', $id)->count();
        if ($wishlist == 0) {
            UserWishlist::create(['user_id' => Auth::user()->id, 'product_id' => $id]);
            $res = ['status' => 'success', 'message' => 'Thêm vào', 'method' => 'add'];
        } else {
            UserWishlist::where('user_id', Auth::user()->id)->where('product_id', $id)->delete();
            $res = ['status' => 'success', 'message' => 'Xoá khỏi', 'method' => 'remove'];
        }
        return json_encode($res);
    }

    public function payment()
    {
        $payment = PaymentUser::where('id_user', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        return view('home.pages.payment_user', [
            'payment'   => $payment
        ]);
    }

    public function payment_checkout(Request $request)
    {
        $payment = [
            'id_user'   => Auth::user()->id,
            'amount'    => $request->amount,
            'type'      => '0',
            'description'   => Auth::user()->name . ' nạp tiền vào tài khoản',
            'status'    => '2'
        ];
        $payment = PaymentUser::create($payment);

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('user.payment_user_return'); // return url
        $vnp_TmnCode = "7JV6DF6L"; //Mã website tại VNPAY 
        $vnp_HashSecret = "VXOMRZOMLKIIGUXOECIYPYIFXGCSJUIT"; //Chuỗi bí mật

        $vnp_TxnRef = $payment->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán hoá đơn nạp tiền user ' . $payment->id;
        $vnp_OrderType = 'billPayment';
        $vnp_Amount = $payment->amount * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect()->to($vnp_Url);
    }

    public function payment_return(Request $request)
    {
        if (isset($request->vnp_Amount)) {
            $inputData = array();
            $vnp_HashSecret = "VXOMRZOMLKIIGUXOECIYPYIFXGCSJUIT";
            foreach ($_GET as $key => $value) {
                if (substr($key, 0, 4) == "vnp_") {
                    $inputData[$key] = $value;
                }
            }
            $vnp_SecureHash = $inputData['vnp_SecureHash'];
            unset($inputData['vnp_SecureHash']);
            ksort($inputData);
            $i = 0;
            $hashData = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
            }
            $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
            $data = [
                'id_order'  => $request->vnp_TxnRef,
                'amount'    => $request->vnp_Amount / 100,
                'id_payment_vnpay'  => $request->vnp_TransactionNo,
                'id_payment_bank'   =>  $request->vnp_BankTranNo,
                'message'   => $request->vnp_OrderInfo
            ];

            try {
                if ($secureHash == $vnp_SecureHash) {
                    $payment = PaymentUser::find($request->vnp_TxnRef);
                    if ($payment->amount == $request->vnp_Amount / 100) {
                        if ($request->vnp_ResponseCode == '00' && $request->vnp_TransactionStatus == '00') {
                            $data['status'] = 'success';
                            $payment->status = '1';
                            $payment->save();
                            $user = User::find(Auth::user()->id);
                            $user->money = Auth::user()->money + $payment->amount;
                            $user->save();
                        } else {
                            $data['status'] = 'error';
                        }
                    }
                }
            } catch (Exception $e) {
            };
            return redirect()->route('user.payment_user')->with('success', 'Nạp tiền thành công');
        }
    }

    public function comment($id, $store, Request $request)
    {
        $comment = [
            'create_by' => Auth::user()->id,
            'id_store'  => $store,
            'id_product'    => $id,
            'message'   => $request->message,
            'rate'  => $request->rate,
            'parent_id'    => 0,
            'parent_path'   => '0_'
        ];
        $comment = CommentProduct::create($comment);
        return redirect()->back()->with('success', 'comment hoàn thành');
    }

    public function lucky_random()
    {
        $user = User::find(Auth::user()->id);
        if ($user->turns == 0) {
            return 'error';
        }
        $day = Carbon::now('Asia/Ho_Chi_Minh');
        $day->addMonth();
        $lucky = random_int(0, 6);

        if ($lucky == 0) {
            $data = [
                'create_by_user'    => $user->id,
                'apply_store'   => 0,
                'code'  => time(),
                'name'  => 'Lucky random',
                'type'  => '2',
                'message'   => 'Vòng quay may mắn',
                'money_apply_start' => 1,
                'money_apply_end'   => 100000000,
                'value' => 10000,
                'max_price' => 10000,
                'quantity'  => 1,
                'remaining_quantity'    => 0,
                'start_time'    => Carbon::now('Asia/Ho_Chi_Minh')->toDateTime(),
                'stop_time' => $day->toDateTime(),
                'coupon_type'   => '1',
                'apply_with'    => '1',
                'user_id'       => $user->id,
                'status'    => '0'
            ];
            Coupons::create($data);
        } elseif ($lucky == 1) {
            $data = [
                'create_by_user'    => $user->id,
                'apply_store'   => 0,
                'code'  => time(),
                'name'  => 'Lucky random',
                'type'  => '2',
                'message'   => 'Vòng quay may mắn',
                'money_apply_start' => 1,
                'money_apply_end'   => 100000000,
                'value' => 20000,
                'max_price' => 20000,
                'quantity'  => 1,
                'remaining_quantity'    => 0,
                'start_time'    => Carbon::now('Asia/Ho_Chi_Minh')->toDateTime(),
                'stop_time' => $day->toDateTime(),
                'coupon_type'   => '1',
                'apply_with'    => '1',
                'user_id'       => $user->id,
                'status'    => '0'
            ];
            Coupons::create($data);
        } elseif ($lucky == 2) {
            $data = [
                'create_by_user'    => $user->id,
                'apply_store'   => 0,
                'code'  => time(),
                'name'  => 'Lucky random',
                'type'  => '0',
                'message'   => 'Vòng quay may mắn',
                'money_apply_start' => 1,
                'money_apply_end'   => 100000000,
                'value' => 10000,
                'max_price' => 10000,
                'quantity'  => 1,
                'remaining_quantity'    => 0,
                'start_time'    => Carbon::now('Asia/Ho_Chi_Minh')->toDateTime(),
                'stop_time' => $day->toDateTime(),
                'coupon_type'   => '1',
                'apply_with'    => '1',
                'user_id'       => $user->id,
                'status'    => '0'
            ];
            Coupons::create($data);
        } elseif ($lucky == 3) {
            $data = [
                'create_by_user'    => $user->id,
                'apply_store'   => 0,
                'code'  => time(),
                'name'  => 'Lucky random',
                'type'  => '0',
                'message'   => 'Vòng quay may mắn',
                'money_apply_start' => 1,
                'money_apply_end'   => 100000000,
                'value' => 20000,
                'max_price' => 20000,
                'quantity'  => 1,
                'remaining_quantity'    => 0,
                'start_time'    => Carbon::now('Asia/Ho_Chi_Minh')->toDateTime(),
                'stop_time' => $day->toDateTime(),
                'coupon_type'   => '1',
                'apply_with'    => '1',
                'user_id'       => $user->id,
                'status'    => '0'
            ];
            Coupons::create($data);
        } elseif ($lucky == 4) {
            $user->money = $user->money + 10000;
            $user->save();
            $info = [
                'id_user'   => $user->id,
                'amount'    => 10000,
                'type'      => '0',
                'description'   => 'Thưởng vòng quay may mắn',
                'status'    => '1'
            ];
            PaymentUser::create($info);
        } elseif ($lucky == 5) {
            $user->money = $user->money + 20000;
            $user->save();
            $info = [
                'id_user'   => $user->id,
                'amount'    => 10000,
                'type'      => '0',
                'description'   => 'Thưởng vòng quay may mắn',
                'status'    => '1'
            ];
            PaymentUser::create($info);
        }
        $user->turns = $user->turns - 1;
        $user->save();
        return $lucky;
    }
}
