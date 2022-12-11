<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use App\Models\Product;
use App\Models\ProductDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function __construct()
    {
        
    }
    public function home()
    {
        // product bình thường
        $products = Product::select('product.*')->join('store', 'store.id', '=', 'product.id_store')->where('store.status', '=', '1')
        ->where('product.status', '=', '0')->paginate(15);

        // product bán chạy nhất
        $product_hotSale = Product::select('product.*', DB::raw('sum(product_detail.sold) as sold'))
        ->join('product_detail', 'product_detail.id_product','=','product.id')
        ->join('store', 'store.id' ,'=', 'product.id_store')
        ->where('store.status', '=', '1')
        ->where('product.status', '=', '0')
        ->groupBy('product_detail.id_product')
        ->orderBy('sold', 'DESC')
        ->paginate(15);

        // sản phẩm nhiều lượt xem nhất
        $product_hotView = Product::select('product.*')->join('store', 'store.id' ,'=', 'product.id_store')
        ->where('store.status', '=', '1')
        ->where('product.status', '=', '0')
        ->orderBy('product.view', 'DESC')
        ->paginate(15);

        // sản phẩm được thuê up top
        $product_upTop = Product::select('product.*')->join('store', 'store.id' ,'=', 'product.id_store')
        ->where('store.status', '=', '1')
        ->where('product.status', '=', '0')
        ->where('product.view_prioritized', '>', 0)
        ->inRandomOrder()
        ->paginate(15);

        // sự kiện khuyến mãi
        $coupons = Coupons::where(['apply_store' => '0' , 'status' => '0', 'coupon_type' => '0'])->where('stop_time','>=',Carbon::now('Asia/Ho_Chi_Minh')->toDateTime())->where('start_time','<=',Carbon::now('Asia/Ho_Chi_Minh')->toDateTime())->paginate(10);

        $product = Product::paginate(9);
        return view('home.pages.home', [
            'product' => $product
        ]);
    }
    public function pageSearch(){
        $product = Product::paginate(9);
        return view('home.pages.pageSearch', [
            'product' => $product
        ]);
    }
    public function lucky()
    {
        return view('home.pages.lucky_page', []);
    }

    public function view($product)
    {
        sleep(30);
        $product = Product::find($product);
        $product->view = $product->view + 1;
        $product->save();
    }
}