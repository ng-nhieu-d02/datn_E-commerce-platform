<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use App\Models\PermissionStore;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class storeController extends Controller
{
    public function store($id)
    {
        $store = Store::find($id);
        $permission = PermissionStore::where('id_store','=',$id)->where('id_user','=', Auth::user()->id)->count();

        return view('home.pages.home_store', [
            'store' => $store,
            'permission'    => $permission
        ]);
    }
    public function voucher_store($id)
    {
        $permission = PermissionStore::where('id_store','=',$id)->where('id_user','=', Auth::user()->id)->count();
        $store = Store::find($id);
        if($permission == 0) {
            return 'error';
        }
        $coupons = Coupons::where('apply_store', '=', $id)->orderBy('id', 'DESC')->paginate(5);
        return view('home.pages.voucher_store', [
            'store' => $store,
            'permission'    => $permission,
            'coupons'   => $coupons
        ]);
    }
    public function check_code(Request $request)
    {
        $check = Coupons::where('code','=',$request->code)->count();
        return $check;
    }
    public function add_voucher($id,Request $request)
    {
        $permission = PermissionStore::where('id_store','=',$id)->where('id_user','=', Auth::user()->id)->count();
        if($permission == 0) {
            return redirect()->back()->with('error','you have no right');
        }
        if(strtotime($request->day_start) > strtotime($request->day_end)) {
            return redirect()->back()->with('error','Ngày không hợp lệ')->withInput($request->input());
        }
        if($request->money_start > $request->money_end) {
            return redirect()->back()->with('error','Hoá đơn từ '.$request->money_start.' đến '.$request->money_end.' không hợp lệ')->withInput($request->input());
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
            'apply_store'       => $id,
            'code'              => $request->code,
            'name'              => $request->name,
            'type'              => $request->type,
            'message'           => $request->description,
            'money_apply_start' => $request->money_start,
            'money_apply_end'   => $request->money_end,
            'value'             => $request->value,
            'max_price'         => $request->max_value,
            'quantity'          => $request->quantity,
            'remaining_quantity'    => '0',
            'start_time'        => $request->day_start,
            'stop_time'        => $request->day_end,
            'coupon_type'       => $request->coupon_type,
            'apply_with'        => '0',
            'status'            => '0'
        ];
        $voucher = Coupons::create($voucher);
        
        move_uploaded_file($filename_tmp, $storage . $filename);
        $voucher->avatar = $filename;
        $voucher->save();
        return redirect()->back()->with('success', 'Thêm voucher success');
    }
    public function delete_voucher($id,Request $request)
    {
        $permission = PermissionStore::where('id_store','=',$id)->where('id_user','=', Auth::user()->id)->count();
        if($permission == 0) {
            return 'you have no right';
        }
        Coupons::find($request->id)->delete();
    }
    public function update_voucher($id, Request $request)
    {
        $permission = PermissionStore::where('id_store','=',$id)->where('id_user','=', Auth::user()->id)->count();
        if($permission == 0) {
            return 'you have no right';
        }
        Coupons::find($request->id)->update(['status'   => $request->status]);
    }
    public function get_voucher(Request $request)
    {
        $coupons = Coupons::where(['code' => $request->code, 'apply_store' => $request->store ,'status' => '0'])->where('stop_time','>=',Carbon::today()->toDateString())->where('start_time','<=',Carbon::today()->toDateString())->first();
        if($coupons == null) {
            $data = [
                'message'   => 'error'                
            ];
        } else {
            $data = [
                'coupon'    => $coupons,
                'message'   => 'success'                
            ];
        }
        return json_encode($data);
    }
}
