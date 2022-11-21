<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupons;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStore;
use App\Models\PaymentInfo;
use App\Models\User;
use App\Models\UserAddress;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class paymentController extends Controller
{
    public function checkout(Request $request)
    {
        $address = UserAddress::where('id', $request->address)->first();
        $order = [
            'create_by'   => Auth::user()->id,
            'address'     => $address->address . ',' . $address->district . ',' . $address->city,
            'name'        => $address->name,
            'phone'       => $address->phone,
            'email'       => $address->email,
            'payment_method'      => $request->paymentMethod,
            'payment_status'      => '0',
            'status_order'        => '0',
            'status_payment_store'    => '0'
        ];

        $order = Order::create($order);
        $ship = 0;
        $price = 0;
        foreach (Auth::user()->cartStoreActive() as $store) {
            $total = 0;
            $weight = 0;
            $message = 'message_' . $store->store->slug;
            $order_store = [
                'id_order'      => $order->id,
                'id_store'      => $store->store->id,
                'status_order'  => '0',
                'status_payment_store'  => '0',
                'message'       => $request->$message
            ];
            $order_store = OrderStore::create($order_store);
            foreach ($store->productCart($store->id_store) as $product) {
                $total += $product->detail->price * $product->quantity;
                $weight += $product->detail->weight * $product->quantity;
                OrderDetail::create([
                    'id_order'  => $order->id,
                    'id_order_store'    => $order_store->id,
                    'id_product'    => $product->detail->id_product,
                    'id_product_detail' => $product->detail->id,
                    'quantity'  => $product->quantity,
                    'price' => $product->detail->price,
                    'status'    => '0'
                ]);
                Cart::find($product->id)->delete();
            };
            $data__ship = [
                "pick_province" => $store->store->city,
                "pick_district" => $store->store->district,
                "pick_address" => $store->store->address,
                "province"  => $address->city,
                "district" => $address->district,
                "address" => $address->address,
                "weight" => $weight,
                "value" => $total,
                "transport" => "road",
                "deliver_option" => "none",
                "tags"  => [1]
            ];
            $order_store->ship = $store->shipping_fees($data__ship);
            $order_store->total_price = $total;
            $coupon = 'voucher_' . $store->slug;
            if (!empty($request->$coupon)) {
                $coupon = Coupons::find($request->$coupon);
                if ($coupon->apply_store == 0 || $coupon->apply_store == $store->$order_store->id) {
                    if (
                        $total < $coupon->money_apply_end && $total > $coupon->money_apply_start
                        && $coupon->remaining_quantity < $coupon->quantity && Carbon::today()->toDateString() > $coupon->start_time
                        && Carbon::today()->toDateString() < $coupon->stop_time && $coupon->status == 0
                    ) {
                        if (($coupon->apply_with == 1 && $coupon->user_id == Auth::user()->id) || $coupon->apply_with == 0) {
                            if ($coupon->type == 2) {
                                $order_store->id_coupon_frs = $coupon->id;
                                $order_store->coupon_frs_price = $coupon->value;
                            } else {
                                $order_store->id_coupons = $coupon->id;
                                if ($coupon->type == 1) {
                                    $order_store->coupons_price = $coupon->value;
                                } else {
                                    $coupon_price = ($total / 100) * $coupon->value;
                                    if ($coupon_price > $coupon->max_price) {
                                        $coupon_price = $coupon->max_price;
                                    }
                                    $order_store->coupons_price = $coupon_price;
                                }
                            }
                        }
                    }
                }
            }
            $order_store->save();
            $ship += $order_store->ship - $order_store->coupon_frs_price;
            $price += $order_store->total_price - $order_store->coupons_price;
        }
        $order->total_price = $price;
        $order->ship = $ship;
        if (!empty($request->bigCoupon)) {
            $bigCoupon = Coupons::find($request->bigCoupon);
            if ($bigCoupon->apply_store == 0) {
                if (
                    $price < $bigCoupon->money_apply_end && $price > $bigCoupon->money_apply_start
                    && $bigCoupon->remaining_quantity < $bigCoupon->quantity && Carbon::today()->toDateString() > $bigCoupon->start_time
                    && Carbon::today()->toDateString() < $bigCoupon->stop_time && $bigCoupon->status == 0
                ) {
                    if (($bigCoupon->apply_with == 1 && $bigCoupon->user_id == Auth::user()->id) || $bigCoupon->apply_with == 0) {
                        if ($bigCoupon->type == 2) {
                            $order->id_coupon_frs = $bigCoupon->id;
                            $order->coupons_frs_price = $bigCoupon->value;
                        } else {
                            $order->id_coupons = $bigCoupon->id;
                            if ($coupon->type == 1) {
                                $order->coupons_price = $bigCoupon->value;
                            } else {
                                $coupon_price = ($price / 100) * $bigCoupon->value;
                                if ($coupon_price > $bigCoupon->max_price) {
                                    $coupon_price = $bigCoupon->max_price;
                                }
                                $order->coupons_price = $coupon_price;
                            }
                        }
                    }
                }
            }
        }
        $order->save();
        if ($order->payment_method == 1) {
            if (Auth::user()->money > $order->price) {
                User::find(Auth::user()->id)->update(['money' => Auth::user()->money - $order->price]);
                $order->payment_status = '1';
            } else {
                $order->payment_status = '0';
                $order->status_order = '4';
            }
            $order->save();
            $returnData = array(
                'method'    => $order->payment_method,
                'url'       => route('user.checkout-return')
            );
            return json_encode($returnData);
        } elseif ($order->payment_method == 2) {
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = route('user.pay-return'); // return url
            $vnp_TmnCode = "7JV6DF6L"; //Mã website tại VNPAY 
            $vnp_HashSecret = "VXOMRZOMLKIIGUXOECIYPYIFXGCSJUIT"; //Chuỗi bí mật

            $vnp_TxnRef = $order->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toán hoá đơn ' . $order->id;
            $vnp_OrderType = 'billPayment';
            $vnp_Amount = (($order->total_price - $order->coupons_price) + ($order->ship - $order->coupons_frs_price)) * 100;
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

            //var_dump($inputData);
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
            $returnData = array(
                'method'    => $order->payment_method,
                'url' => $vnp_Url
            );
            return json_encode($returnData);
        } elseif ($order->payment_method == 0) {
            $returnData = array(
                'method'    => $order->payment_method,
                'url'       => route('user.checkout-return')
            );
            return json_encode($returnData);
        }
    }

    public function pay_return(Request $request)
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
                    $order = Order::find($request->vnp_TxnRef);
                    if (($order->total_price - $order->coupons_price) + ($order->ship - $order->coupons_frs_price) == $request->vnp_Amount / 100) {
                        if ($request->vnp_ResponseCode == '00' && $request->vnp_TransactionStatus == '00') {
                            $data['status'] = 'success';
                        } else {
                            $data['status'] = 'error';
                        }

                        $order->payment_status = '1';
                        OrderStore::where('id_order', '=', $order->id)->update(['status_payment_store' => '1']);
                        PaymentInfo::create($data);
                        $order->save();
                    }
                }
            } catch (Exception $e) {
            };
            return redirect()->route('user.checkout-return', [$order->id]);
        }
    }
    public function checkout_return($order)
    {
        $message = 'chúc mừng bạn thanh toán hoá đơn ' . $order . ' thành công';
        return $message;
    }
}
