<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\PermissionStore;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductImages;
use App\Models\Store;
use App\Models\StoreCate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class storeController extends Controller
{
    public function store($id)
    {
        $permission = PermissionStore::where('id_store', '=', $id)->where('id_user', '=', Auth::user()->id)->count();

        $store = Store::find($id);

        if (is_null($store)) {
            return abort(404);
        }

        $checkPermissionStore = PermissionStore::where("id_store", $id)->where('id_user', '=', auth()->user()->id)->first();


        return view('home.pages.home_store', [
            'store' => $store,
            'permission'    => $permission,
            'checkPermissionStore' => $checkPermissionStore,
        ]);
    }

    public function createProduct($id)
    {
        $store = Store::find($id);

        $permission = PermissionStore::where('id_store', '=', $id)->where('id_user', '=', Auth::user()->id)->count();

        $checkPermissionStore = PermissionStore::where("id_store", $id)->where('id_user', '=', auth()->user()->id)->first();

        if (is_null($checkPermissionStore)) {
            return abort(404);
        }


        $categories = $this->getCategoryProduct();

        return view("home.pages.add_product_store", [
            'store' => $store,
            'permission' => $permission,
            'checkPermissionStore' => $checkPermissionStore,
            'categories' => $categories,

        ]);
    }

    public function storeAddProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'bail|required|unique:product,name|string',
            'description' => 'bail|required|string',
            'long_description' => 'bail|required',
            'type' => 'bail|required|string',
            'category_id' => 'bail|required|exists:App\Models\CategoryProduct,id',
            'thumb' => 'bail|required|mimes:jpg,jpeg,png,jfif',
            'brand' => 'bail|required|string',
            'origin' => 'bail|required|string',
            'title' => 'bail|required|string',
            'keyword' => 'bail|required',
            'colorText' => 'bail|required_without:size',
            'sizeText' => 'bail|required_without:color',
            'attribute' => 'nullable',
            'url_image' => 'bail|required',
            'url' => 'bail|required',
            'url_image.*' => 'mimes:jpg,jpeg,png,jfif,mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv',
            'url.*' => 'mimes:jpg,jpeg,png,jfif,mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv',
            'price' => 'bail|required',
            'price.*' => 'required|string|gt:0',
            'sale' => 'bail|required',
            'sale.*' => 'required|string|gt:0',
            'weight' => 'bail|required',
            'weight.*' => 'required|string|gt:0',
            'quantity' => 'bail|required',
            'quantity.*' => 'required|string|gt:0',
        ]);


        if (!is_null($validated["sizeText"][0])) {
            $request->validate(['attribute' => 'required|string']);
        }

        \DB::beginTransaction();
        try {
            $id_store = $request->id;

            $product['id_store'] = $id_store;
            $product['create_by'] = auth()->user()->id;
            $product['name'] = $validated['name'];
            $product['slug'] = Str::slug($product['name'], "-");
            $product['description'] = $validated['description'];
            $product['long_description'] = $validated['long_description'];
            $product['type'] = $validated['type'];
            $product['category_path'] = $validated['category_id'];
            $categoryPath = explode('_', $validated['category_id']);
            $product['category_id'] = end($categoryPath);
            $product['thumb'] = $product['id_store'] . "/thumb" . $validated['thumb']->hashName(); // name file
            $product['brand'] = $validated['brand'];
            $product['origin'] = $validated['origin'];
            $product['title'] = $validated['title'];
            $product['keyword'] = implode(",", $validated['keyword']);

            $product_id = Product::create($product)->id;

            $validated['thumb']->move(public_path('upload/product/' . $product['id_store'] . '/thumb'),  $validated['thumb']->hashName());

            $productDetailAttributes = [];

            $productListImages = [];

            foreach ($validated['colorText'] as $key => $color) {
                $fileName = $product_id . '-size-' . $validated['url_image'][$key]->hashName();
                $productDetailAttributes[] = [
                    'id_product' => $product_id,
                    'color_value' => $color,
                    'attribute' => $validated['attribute'],
                    'attribute_value' => $validated['sizeText'][$key],
                    'weight' => $validated['weight'][$key],
                    'quantity' => $validated['quantity'][$key],
                    'price' => $validated['price'][$key],
                    'sale' => $validated['sale'][$key],
                    'url_image' => $fileName,
                    'status' => '0',
                ];
                $validated['url_image'][$key]->move(public_path('upload/product/' . $product['id_store'] . '/album'), $fileName);
            }
            // dd($productDetailAttributes);

            ProductDetail::insert($productDetailAttributes);

            $image = ["jpg", "jpeg", "png", "jfif"];
            $video = ['mp4', 'ogg'];

            foreach ($validated['url'] as $url) {
                if (in_array($url->extension(), $image)) {
                    $type = "0";
                } else if (in_array($url->extension(), $video)) {
                    $type = "1";
                }

                $fileName = $product['id_store'] . '-' . "$product_id-" . $url->hashName();
                $url->move(public_path('upload/product/' . $product['id_store'] . '/album'),  $fileName);

                $productListImages[] = [
                    'id_product' => $product_id,
                    'type' => $type,
                    'url' => $fileName,
                ];
            }

            ProductImages::insert($productListImages);

            \DB::commit();

            return back()->with("message", "Thêm mới sản phẩm thành công");
        } catch (\Exception $e) {
            \DB::rollback();
        }
    }

    public function getCategoryProduct()
    {
        $listCategory = [];
        $categoryProducts = CategoryProduct::get();

        $category = new CategoryProduct();

        $category->recursive($categoryProducts, $parents = 0, $level = 1, $listCategory);

        return $listCategory;
    }
}
