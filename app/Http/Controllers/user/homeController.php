<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function __construct()
    {
    }
    public function home()
    {
        $product = Product::paginate(8);
        return view('home.pages.home', [
            'product' => $product
        ]);
    }
    public function pageSearch()
    {
        $product = Product::paginate(8);

        $getAllCategoryProducts = CategoryProduct::where("parent_id", 0)->get();

        $getCategoryProductChildren = CategoryProduct::where("parent_id", "<>", 0)->get();

        return view('home.pages.pageSearch', [
            'product' => $product,
            'getAllCategoryProducts' => $getAllCategoryProducts,
            'getCategoryProductChildren' => $getCategoryProductChildren,
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
}
