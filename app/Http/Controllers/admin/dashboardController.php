<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use App\Models\Store;
use App\Models\TickerCreateStore;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function __construct()
    {
        
    }
    public function dashboard()
    {
        return view('dashboard.layout.main');
    }
    public function voucher()
    {
        $coupons = Coupons::where('apply_store', '=', 0)->orderBy('id', 'DESC')->paginate(10);

        return view('dashboard.pages.voucher', [
            'coupons'   => $coupons
        ]);
    }
    public function add_voucher(Request $request)
    {
        $request->start = Carbon::parse($request->start)->format('Y-m-d H:i:s');
        $request->end = Carbon::parse($request->end)->format('Y-m-d H:i:s');
        
        if(strtotime($request->start) > strtotime($request->end)) {
            return redirect()->back()->with('error','Ngày không hợp lệ')->withInput($request->input());
        }
        if($request->order_lowest > $request->order_biggest) {
            return redirect()->back()->with('error','Hoá đơn từ '.$request->order_lowest.' đến '.$request->order_biggest.' không hợp lệ')->withInput($request->input());
        }
        if($request->type == 1) {
            if($request->value > 100) {
                return redirect()->back()->with('error','value not validate')->withInput($request->input());
            }
        }
        if(strlen($request->description) > 255) {
            return redirect()->back()->with('error', 'description length longer')->withInput($request->input());
        }
        if($request->value > $request->max_value) {
            return redirect()->back()->with('error', 'max giá trị không hợp lệ')->withInput($request->input());
        }
        $check = Coupons::where('code','=',$request->code)->count();
        if($check > 0) {
            return redirect()->back()->with('error', 'code đã tồn tại')->withInput($request->input());
        }
        $storage = "upload/voucher/";
        $format = array("JPG", "JPEG", "PNG", "GIF", "BMP", "jpg", "jpeg", "png", "gif", "bmp");
        $filename = $_FILES['avatar']['name'];
        $filename_tmp = $_FILES['avatar']['tmp_name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = time().'_'.$filename;
        if (!in_array($ext, $format)) {
            return redirect()->back()->with('error', 'file không đúng định dạng')->withInput($request->input());
        }
        $voucher = [
            'create_by_user'    => Auth::user()->id,
            'apply_store'       => '0',
            'code'              => $request->code,
            'name'              => $request->name,
            'type'              => $request->type,
            'message'           => $request->description,
            'money_apply_start' => $request->order_lowest,
            'money_apply_end'   => $request->order_biggest,
            'value'             => $request->value,
            'max_price'         => $request->max_value,
            'quantity'          => $request->quantity,
            'remaining_quantity'    => '0',
            'start_time'        => $request->start,
            'stop_time'        => $request->end,
            'coupon_type'       => $request->type_event,
            'apply_with'        => '0',
            'status'            => '0'
        ];
        $voucher = Coupons::create($voucher);
        move_uploaded_file($filename_tmp, $storage . $filename);
        $voucher->avatar = $filename;
        $voucher->save();
        return redirect()->back()->with('success', 'Thêm voucher success');
    }
    public function update_voucher($voucher, $status)
    {
        Coupons::find($voucher)->update(['status' => $status]);
        return redirect()->back()->with('success', 'Cập nhật status thành công');
    }
    public function member()
    {
        $members = User::orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.pages.member', [
            'members'    => $members
        ]);
    }
    public function update_member($member, $status)
    {
        User::find($member)->update(['status' => $status]);
        return redirect()->back()->with('success', 'Cập nhật status thành công');
    }
    public function store()
    {
        $tickets = TickerCreateStore::orderBy('id', 'DESC')->paginate(10);
        $stores = Store::orderBy('id', 'Desc')->paginate(10);
        return view('dashboard.pages.store', [
            'tickets' => $tickets,
            'stores'    => $stores
        ]);
    }
    public function update_store($store,$status)
    {
        Store::find($store)->update(['status' => $status]);
        return redirect()->back()->with('success', 'Cập nhật status thành công');
    }
    public function update_ticket_store($ticket, $status)
    {
        $ticket = TickerCreateStore::find($ticket);
        Store::find($ticket->id_store)->update(['status'    => $status]);
        $ticket->status = $status;
        $ticket->save();
        return redirect()->back()->with('success', 'Cập nhật status thành công');
    }
    public function category()
    {
        return view('dashboard.pages.category');
    }
}
