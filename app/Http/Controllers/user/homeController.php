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
use Illuminate\Support\Facades\View;

class homeController extends Controller
{
    public function __construct()
    {
    }
    public function home()
    {
        
        $category = CategoryProduct::where('parent_id', '=', 0)->get();

        // product bán chạy nhất
        $product_hotSale = Product::select('product.*', DB::raw('sum(product_detail.sold) as sold'))
            ->join('product_detail', 'product_detail.id_product', '=', 'product.id')
            ->join('store', 'store.id', '=', 'product.id_store')
            ->where('store.status', '=', '1')
            ->where('product.status', '=', '0')
            ->groupBy('product_detail.id_product')
            ->orderBy('sold', 'DESC')
            ->paginate(18);

        // sản phẩm nhiều lượt xem nhất
        $product_hotView = Product::select('product.*')->join('store', 'store.id', '=', 'product.id_store')
            ->where('store.status', '=', '1')
            ->where('product.status', '=', '0')
            ->orderBy('product.view', 'DESC')
            ->paginate(18);

        // sản phẩm được thuê up top
        $product_upTop = Product::select('product.*')->join('store', 'store.id', '=', 'product.id_store')
            ->where('store.status', '=', '1')
            ->where('product.status', '=', '0')
            ->where('product.view_prioritized', '>', 0)
            ->inRandomOrder()
            ->paginate(18);

        // sự kiện khuyến mãi
        $coupons = Coupons::where(['apply_store' => '0', 'status' => '0', 'coupon_type' => '0'])->where('stop_time', '>=', Carbon::now('Asia/Ho_Chi_Minh')->toDateTime())->where('start_time', '<=', Carbon::now('Asia/Ho_Chi_Minh')->toDateTime())->paginate(10);

        return view('home.pages.home', [
            'coupons'   => $coupons,
            'products_view'   => $product_hotView,
            'products_sold' => $product_hotSale,
            'categories'  => $category
        ]);
    }

    public function pageSearch(Request $request)
    {
        $product = Product::select('product.*', DB::raw('sum(product_detail.sold) as sold'))
        ->join('product_detail', 'product_detail.id_product', '=', 'product.id')
        ->join('store', 'store.id', '=', 'product.id_store')
        ->where('store.status', '=', '1')
        ->where('product.status', '=', '0')
        ->groupBy('product_detail.id_product')
        ->orderBy('sold', 'DESC')
        ->paginate(18);

        $category = CategoryProduct::where('parent_id', 0)->get();

        $parentCategory = CategoryProduct::where('parent_id', 0)->get();

        if(isset($request->category)) {
            $cate = CategoryProduct::where('slug',$request->category)->first();
            $parentCategory = CategoryProduct::where('parent_id', $cate->id)->get();
        

            $product_top = Product::join('store', 'store.id', '=', 'product.id_store')
            ->where('store.status', '=', '1')
            ->where('product.status', '=', '0')
            ->where('product.category_path', 'like', $cate->path.'%')
            ->where('product.view_prioritized', '>', 0)
            ->inRandomOrder()->limit(5)->get();

            $product = Product::select('product.*', DB::raw('sum(product_detail.sold) as sold'))
            ->join('product_detail', 'product_detail.id_product', '=', 'product.id')
            ->join('store', 'store.id', '=', 'product.id_store')
            ->where('store.status', '=', '1')
            ->where('product.status', '=', '0')
            ->where('product.category_path', 'like', $cate->path.'%')
            ->groupBy('product_detail.id_product')
            ->orderBy('sold', 'DESC')
            ->paginate(18);

            View::share(['product_top'=> $product_top, 'cate' => $cate]);
        }

        if(isset($request->search)) {
            $product_top = Product::select('product.*')->join('store', 'store.id', '=', 'product.id_store')
            ->where('store.status', '=', '1')
            ->where('product.status', '=', '0')
            ->where('product.name','like','%'.$request->search.'%')
            ->where('product.view_prioritized', '>', 0)
            ->inRandomOrder()->limit(5)->get();
           
            $product = Product::select('product.*', DB::raw('sum(product_detail.sold) as sold'))
            ->join('product_detail', 'product_detail.id_product', '=', 'product.id')
            ->join('store', 'store.id', '=', 'product.id_store')
            ->where('store.status', '=', '1')
            ->where('product.status', '=', '0')
            ->where('product.name','like','%'.$request->search.'%')
            ->groupBy('product_detail.id_product')
            ->orderBy('sold', 'DESC')
            ->paginate(15);
            View::share('product_top', $product_top);
        }

        return view('home.pages.pageSearch', [
            'product' => $product,
            'category'  => $category,
            'parent_category'   => $parentCategory
        ]);
    }
    public function update_view_top (Request $request)
    {
        $product_top = Product::find($request->id);
        foreach($product_top as $top) {
            $top->view_prioritized = $top->view_prioritized - 1;
            $top->save();
        }
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

    public function about()
    {
        return view('home.pages.about', []);
    }
}
