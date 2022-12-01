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
        $order = Order::orderby('id')->paginate(8);
        // $orderDelivery = Order::where('status_order','=','2')->paginate(8);
        // $orderSuccess = Order::where('status_order','=','3')->paginate(8);
        // $orderCancel = Order::where('status_order','=','4')->paginate(8);

        // lịch sử đơn hàng
        return view('home.pages.receipt', [
            'order' => $order,
        ]);
    }
    public function orderDetail($id_order){
        // xem lịch sử mua hàng
        $getorder = Order::where('id',$id_order)->first();
        $order_detail = OrderDetail::with('product')->where('id_order',$id_order)->get();
        $order_detail_store = OrderStore::with('store')->first();
        // dd($order_detail_store);
        return view('home.pages.receiptDetail', [
            'getorder' => $getorder,
            'order_detail'=> $order_detail,
            'order_detail_store'=> $order_detail_store,
        ]);
    }
}
