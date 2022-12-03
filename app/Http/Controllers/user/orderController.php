<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStore;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    public function __construct()
    {
    }
    public function checkout(Request $request)
    {
        if (isset($request->address)) {
            $address = UserAddress::where('id', '=', $request->address)->first();
        } else {
            $address = UserAddress::where('user_id', '=', Auth::user()->id)->where('status', '=', '0')->first();
        }
        $system_coupons = Coupons::where(['apply_store' => '0' , 'status' => '0', 'coupon_type' => '0'])->where('stop_time','>=',Carbon::today()->toDateString())->where('start_time','<=',Carbon::today()->toDateString())->get();
        return view('home.pages.checkout', [
            'address' => $address,
            'system_coupons'    => $system_coupons
        ]);
    }
    public function chooseCart(Request $request)
    {
        Auth::user()->cart()->where('id', $request->id)->update(['status' => $request->status]);
    }
    public function manageOrder(){
        $order = Order::where('create_by', Auth::user()->id)->orderby('id', 'DESC')->paginate(8);
        return view('home.pages.receipt', [
            'order' => $order,
        ]);
    }
    public function orderDetail($id_order){
        $order = Order::find($id_order);
        return view('home.pages.receiptDetail', [
            'order' => $order,
        ]);
    }
}
