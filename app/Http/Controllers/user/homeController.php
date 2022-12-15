<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use App\Models\CategoryProduct;

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
            ->join('product_detail', 'product_detail.id_product', '=', 'product.id')
            ->join('store', 'store.id', '=', 'product.id_store')
            ->where('store.status', '=', '1')
            ->where('product.status', '=', '0')
            ->groupBy('product_detail.id_product')
            ->orderBy('sold', 'DESC')
            ->paginate(15);

        // sản phẩm nhiều lượt xem nhất
        $product_hotView = Product::select('product.*')->join('store', 'store.id', '=', 'product.id_store')
            ->where('store.status', '=', '1')
            ->where('product.status', '=', '0')
            ->orderBy('product.view', 'DESC')
            ->paginate(15);

        // sản phẩm được thuê up top
        $product_upTop = Product::select('product.*')->join('store', 'store.id', '=', 'product.id_store')
            ->where('store.status', '=', '1')
            ->where('product.status', '=', '0')
            ->where('product.view_prioritized', '>', 0)
            ->inRandomOrder()
            ->paginate(15);

        // sự kiện khuyến mãi
        $coupons = Coupons::where(['apply_store' => '0', 'status' => '0', 'coupon_type' => '0'])->where('stop_time', '>=', Carbon::now('Asia/Ho_Chi_Minh')->toDateTime())->where('start_time', '<=', Carbon::now('Asia/Ho_Chi_Minh')->toDateTime())->paginate(10);

        $product = Product::paginate(9);
        return view('home.pages.home', [
            'product' => $product,
            'coupons'   => $coupons
        ]);
    }

    public function pageSearch()
    {
        $product = Product::paginate(8);

        $getAllCategoryProducts = CategoryProduct::where("parent_id", 0)->get();

        $getCategoryProductChildren = CategoryProduct::where("parent_id", "<>", 0)->get();

        $getAllColor = ProductDetail::select("color_value")->distinct()->get();

        $getAllAttribute = ProductDetail::select("attribute_value")->distinct()->get();

        return view('home.pages.pageSearch', [
            'product' => $product,
            'getAllCategoryProducts' => $getAllCategoryProducts,
            'getCategoryProductChildren' => $getCategoryProductChildren,
            'getAllColor' => $getAllColor,
            'getAllAttribute' => $getAllAttribute,
        ]);
    }

    public function filterProductChildren(Request $request)
    {
        $categoryProductParentId = $request->id;
        $findChildrent = CategoryProduct::query();

        if ($categoryProductParentId == 0) {
            $findChildrent->where("parent_id", "<>", 0);
        } else {
            $findChildrent->where("parent_id", $categoryProductParentId);
        }

        $data = $findChildrent->get();

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function filterProduct(Request $request)
    {
        $queryFilter = Product::with('comment')
            ->join("product_detail", "product_detail.id", "=", "product.id");
        if (isset($request->arrayCategories)) {
            $queryFilter->whereIn("product.category_id", $request->arrayCategories);
        }
        if (isset($request->arrayAttributes)) {
            $queryFilter->whereIn("product_detail.attribute_value", $request->arrayAttributes);
        }
        if (isset($request->inputMin) && isset($request->inputMax)) {
            $queryFilter->whereBetween("product_detail.price", array($request->inputMin, $request->inputMax));
        }

        $data = $queryFilter->get();
        return response()->json([
            'status' => true,
            'data' => $data,
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
