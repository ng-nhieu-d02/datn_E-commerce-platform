<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\Coupons;
use App\Models\PermissionStore;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductImages;
use App\Models\Store;
use App\Models\StoreCate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class storeController extends Controller
{
    public function store($id)
    {
        $permission = PermissionStore::where('id_store', '=', $id)->where('id_user', '=', Auth::user()->id)->count();

        $store = Store::find($id);
        // dd($store);
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

    public function editProduct($idStore, $idProduct)
    {
        $store = Store::with(['product'])->find($idStore);
        $product = Product::find($idProduct);
        $categories = $this->getCategoryProduct();
        $permission = PermissionStore::where('id_store', '=', $idStore)->where('id_user', '=', Auth::user()->id)->count();
        $checkPermissionStore = PermissionStore::where("id_store", $idStore)->where('id_user', '=', auth()->user()->id)->first();

        if (!is_null($checkPermissionStore) && $store->product->pluck("id")->contains($product->id)) {

            return view("home.pages.edit_product_store", [
                'product' => $product,
                'store' => $store,
                'permission' => $permission,
                'checkPermissionStore' => $checkPermissionStore,
                'categories' => $categories,
            ]);
        } else {
            abort(404);
        }
    }

    public function updateProduct(Request $request)
    {
        return "Đang cập nhật";
        // $findProduct = Product::find($request->id_product);
        // $validated = $request->validate([
        //     'name' => 'bail|required|unique:product,name,' .  $findProduct->id . '|string',
        //     'description' => 'bail|required|string',
        //     'long_description' => 'bail|required',
        //     'type' => 'bail|required|string',
        //     'category_id' => 'bail|required|exists:App\Models\CategoryProduct,id',
        //     'thumb' => 'bail|nullable|mimes:jpg,jpeg,png,jfif',
        //     'brand' => 'bail|required|string',
        //     'origin' => 'bail|required|string',
        //     'title' => 'bail|required|string',
        //     'keyword' => 'bail|required',
        //     'colorText' => 'bail|required_without:size',
        //     'sizeText' => 'bail|required_without:color',
        //     'attribute' => 'nullable',
        //     'url_image' => 'bail|nullable',
        //     'url' => 'bail|nullable',
        //     'url_image.*' => 'mimes:jpg,jpeg,png,jfif,mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv',
        //     'url.*' => 'mimes:jpg,jpeg,png,jfif,mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv',
        //     'price' => 'bail|required',
        //     'price.*' => 'required|string|gt:0',
        //     'sale' => 'bail|required',
        //     'sale.*' => 'required|string|gt:0',
        //     'weight' => 'bail|required',
        //     'weight.*' => 'required|string|gt:0',
        //     'quantity' => 'bail|required',
        //     'quantity.*' => 'required|string|gt:0',
        // ]);
        // if (!is_null($validated["sizeText"][0])) {
        //     $request->validate(['attribute' => 'required|string']);
        // }

        // \DB::beginTransaction();
        // try {

        //     $product['id_store'] = $request->id_store;
        //     $product['create_by'] = auth()->user()->id;
        //     $product['name'] = $validated['name'];
        //     $product['slug'] = Str::slug($product['name'], "-");
        //     $product['description'] = $validated['description'];
        //     $product['long_description'] = $validated['long_description'];
        //     $product['type'] = $validated['type'];
        //     $product['category_path'] = $validated['category_id'];
        //     $categoryPath = explode('_', $validated['category_id']);
        //     $product['category_id'] = end($categoryPath);
        //     if ($request->hasFile("thumb")) {
        //         $product['thumb'] = $product['id_store'] . "/thumb/" . $validated['thumb']->hashName();
        //         // $validated['thumb']->move(public_path('upload/product/' . $product['id_store'] . '/thumb'),  $validated['thumb']->hashName());
        //         unlink(public_path('upload/product/' . $product->thumb));
        //     } else {
        //         $product['thumb'] = $request->thumbOld;
        //     }
        //     $product['brand'] = $validated['brand'];
        //     $product['origin'] = $validated['origin'];
        //     $product['title'] = $validated['title'];
        //     $product['keyword'] = implode(",", $validated['keyword']);

        //     // $product_id = Product::create($product)->id;
        //     $findProduct->update($product);



        //     $productDetailAttributes = [];

        //     $productListImages = [];

        //     foreach ($validated['colorText'] as $key => $color) {
        //         $fileName = $findProduct->id . '-size-' . $validated['url_image'][$key]->hashName();
        //         $productDetailAttributes[] = [
        //             'id_product' => $findProduct->id,
        //             'color_value' => $color,
        //             'attribute' => $validated['attribute'],
        //             'attribute_value' => $validated['sizeText'][$key],
        //             'weight' => $validated['weight'][$key],
        //             'quantity' => $validated['quantity'][$key],
        //             'price' => $validated['price'][$key],
        //             'sale' => $validated['sale'][$key],
        //             'url_image' => $fileName,
        //             'status' => '0',
        //         ];
        //         $validated['url_image'][$key]->move(public_path('upload/product/' . $product['id_store'] . '/album'), $fileName);
        //     }

        //     ProductDetail::insert($productDetailAttributes);

        //     $image = ["jpg", "jpeg", "png", "jfif"];
        //     $video = ['mp4', 'ogg'];

        //     foreach ($validated['url'] as $url) {
        //         if (in_array($url->extension(), $image)) {
        //             $type = "0";
        //         } else if (in_array($url->extension(), $video)) {
        //             $type = "1";
        //         }

        //         $fileName = $product['id_store'] . '-' . "$product_id-" . $url->hashName();
        //         $url->move(public_path('upload/product/' . $product['id_store'] . '/album'),  $fileName);

        //         $productListImages[] = [
        //             'id_product' => $product_id,
        //             'type' => $type,
        //             'url' => $fileName,
        //         ];
        //     }

        //     ProductImages::insert($productListImages);

        //     \DB::commit();

        //     return back()->with("message", "Thêm mới sản phẩm thành công");
        // } catch (\Exception $e) {
        //     \DB::rollback();
        // }
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
            $product['thumb'] = $product['id_store'] . "/thumb/" . $validated['thumb']->hashName(); // name file
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
    public function voucher_store($id)
    {
        $permission = PermissionStore::where('id_store', '=', $id)->where('id_user', '=', Auth::user()->id)->count();
        $store = Store::find($id);
        if ($permission == 0) {
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
        $check = Coupons::where('code', '=', $request->code)->count();
        return $check;
    }
    public function add_voucher($id, Request $request)
    {
        $permission = PermissionStore::where('id_store', '=', $id)->where('id_user', '=', Auth::user()->id)->count();
        if ($permission == 0) {
            return redirect()->back()->with('error', 'you have no right');
        }
        if (strtotime($request->day_start) > strtotime($request->day_end)) {
            return redirect()->back()->with('error', 'Ngày không hợp lệ')->withInput($request->input());
        }
        if ($request->money_start > $request->money_end) {
            return redirect()->back()->with('error', 'Hoá đơn từ ' . $request->money_start . ' đến ' . $request->money_end . ' không hợp lệ')->withInput($request->input());
        }
        if ($request->type == 1) {
            if ($request->value > 100) {
                return redirect()->back()->with('error', 'value not validate')->withInput($request->input());
            }
        }
        if (strlen($request->description) > 255) {
            return redirect()->back()->with('error', 'description length longer')->withInput($request->input());
        }
        if ($request->value > $request->max_value) {
            return redirect()->back()->with('error', 'max giá trị không hợp lệ')->withInput($request->input());
        }
        $check = Coupons::where('code', '=', $request->code)->count();
        if ($check > 0) {
            return redirect()->back()->with('error', 'code đã tồn tại')->withInput($request->input());
        }

        $storage = "upload/voucher/";
        $format = array("JPG", "JPEG", "PNG", "GIF", "BMP", "jpg", "jpeg", "png", "gif", "bmp");
        $filename = $_FILES['avatar']['name'];
        $filename_tmp = $_FILES['avatar']['tmp_name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = time() . '_' . $filename;
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
    public function delete_voucher($id, Request $request)
    {
        $permission = PermissionStore::where('id_store', '=', $id)->where('id_user', '=', Auth::user()->id)->count();
        if ($permission == 0) {
            return 'you have no right';
        }
        Coupons::find($request->id)->delete();
    }
    public function update_voucher($id, Request $request)
    {
        $permission = PermissionStore::where('id_store', '=', $id)->where('id_user', '=', Auth::user()->id)->count();
        if ($permission == 0) {
            return 'you have no right';
        }
        Coupons::find($request->id)->update(['status'   => $request->status]);
    }
    public function get_voucher(Request $request)
    {
        $coupons = Coupons::where(['code' => $request->code, 'apply_store' => $request->store, 'status' => '0'])->where('stop_time', '>=', Carbon::today()->toDateString())->where('start_time', '<=', Carbon::today()->toDateString())->first();
        if ($coupons == null) {
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

    public function updateProductStatus($id)
    {
        try {
            $statusProduct = Product::find($id);

            $status = '';
            if ($statusProduct->status == '1') {
                $status = '0';
            } else {
                $status = '1';
            }

            $statusProduct->status = $status;
            $statusProduct->save();
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function deleteProduct($id)
    {
        $findProduct = Product::find($id);

        if (is_null($findProduct)) {
            return redirect()->back()->with("error", "Sản phẩm không tồn tại");
        }

        $findProduct->delete();
        return redirect()->back()->with("success", "Xoá thành công");
    }
}
