<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        'id_user',
        'id_store',
        'id_product',
        'id_product_detail',
        'quantity',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function detail()
    {
        return $this->belongsTo(ProductDetail::class, 'id_product_detail');
    }

    public function cart($store)
    {
        return $this->hasMany(Cart::class, 'id_user', 'id_user')->where('id_store', $store)->orderBy('created_at','desc')->get();
    }

    public function productCart($store)
    {
        return $this->hasMany(Cart::class, 'id_user', 'id_user')->where('id_store', $store)->where('status', '1')->orderBy('created_at','desc')->get();
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'id_store');
    }

    public function coupon($id_store)
    {
        return Coupons::where(['apply_store' => $id_store , 'status' => '0', 'coupon_type' => '0'])->where('stop_time','>=',Carbon::today()->toDateString())->where('start_time','<=',Carbon::today()->toDateString())->get();
    }

    public function shipping_fees($data)
    {
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/fee?" . http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Token: 89E02490AE6bf51aE3fE40D1F1FA0f09d6F87844",
            ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response)->fee;
        if($response->delivery == false) {
            return 100000000000;
        } else {
            return $response->fee;
        }
    }
}
