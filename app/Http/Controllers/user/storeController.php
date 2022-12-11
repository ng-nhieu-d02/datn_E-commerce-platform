<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\BankInfo;
use App\Models\CategoryProduct;
use App\Models\Coupons;
use App\Models\HistoryUpdateOrder;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStore;
use App\Models\PaymentStore;
use App\Models\PaymentUser;
use App\Models\PermissionStore;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductImages;
use App\Models\Store;
use App\Models\StoreCate;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class storeController extends Controller
{
    public function store($id)
    {
        $store = Store::find($id);
        $product = Product::where('id_store', $id)->orderBy('id', 'DESC')->paginate(16);
        $permission = $this->checkPermission($id);
        return view('home.pages.home_store', [
            'product' => $product,
            'store' => $store,
            'permission'    => $permission
        ]);
    }

    public function product($id)
    {
        $permission = $this->checkPermission($id);

        $store = Store::find($id);
        // dd($store);
        if (is_null($store)) {
            return abort(404);
        }

        $products = Product::where('id_store', $store->id)->orderBy('id', 'DESC')->paginate(3);

        $checkPermissionStore = PermissionStore::where("id_store", $id)->where('id_user', '=', auth()->user()->id)->first();

        return view('home.pages.manager_product_store', [
            'store' => $store,
            'permission'    => $permission,
            'checkPermissionStore' => $checkPermissionStore,
            'products'  => $products
        ]);
    }

    public function editStore($id)
    {
        $store = Store::find($id);
        
        $nameCateByStore = null;
        
        if(!is_null($store)){
            $nameCateByStore = implode(",", $store->store_cate->pluck("name")->toArray());
        }
        

        $permission = PermissionStore::where('id_store', '=', $id)->where('id_user', '=', Auth::user()->id)->count();

        $checkPermissionStore = PermissionStore::where("id_store", $id)->where('id_user', '=', auth()->user()->id)->first();

        if (is_null($checkPermissionStore)) {
            return abort(404);
        }
        return view("home.pages.edit_store", [
            'store' => $store,
            'permission' => $permission,
            'nameCateByStore' => $nameCateByStore
        ]);
    }

    public function updateStore(Request $request, $id)
    {
        $store = Store::find($id);

        $validate = [
            "name" => 'required|string|unique:store,name,' . $id,
            "name_cate" => 'required',
            "slogan" => 'required',
            "message" => 'nullable',
            "city" => 'required',
            "district" => 'required',
            "address" => 'required',
        ];

        $validated = $request->validate($validate);

        $validated['slug'] = str()->slug($validated['name']);

        $arrayStoreCateNotIn = [];
        $arrayStoreCateNew = [];

        $getIdByStoreCate = StoreCate::where("id_store", $store->id)->whereNotIn("name", explode(",", $validated['name_cate']))->get()->pluck("id")->toArray();

        if (count($getIdByStoreCate) > 0) {
            $arrayStoreCateNotIn = $getIdByStoreCate;
        }

        $store->store_cate()->whereIn("id", $arrayStoreCateNotIn)->delete();

        foreach (explode(",", $validated['name_cate']) as $nameCate) {
            $storeCateNew = StoreCate::where("id_store", $store->id)->where("name", explode(",", $nameCate))->first();
            if (is_null($storeCateNew)) {
                $createStoreCateNew = StoreCate::create(['id_store' => $store->id, 'slug' => str()->slug($nameCate), 'name' => $nameCate]);
                $arrayStoreCateNew[] = $createStoreCateNew->id;
            }
        }


        if ($request->hasFile("avatar")) {
            $pathAvatar = "upload/store/avatars/";
            $avatar = $request->file("avatar");
            $fileNameAvatar = time() . "-avatar-store-of-user-" . auth()->id() . "." . $avatar->extension();
            $validated['avatar'] = $fileNameAvatar;
            unlink("upload/store/avatars/$store->avatar");
            $avatar->move(public_path($pathAvatar), $fileNameAvatar);
        }
        if ($request->hasFile("background")) {
            $pathBackground = "upload/store/backgrounds/";
            $background = $request->file("background");
            $fileNameBackground = time() . "-background-store-of-user-" . auth()->id() . "." . $background->extension();
            $validated['background'] = $fileNameBackground;
            unlink("upload/store/backgrounds/$store->background");
            $background->move(public_path($pathBackground),  $fileNameBackground);
        }

        $store->update($validated);
        return back()->with("success", "Cập nhật thành công");
        // đã xong phần chỉnh sửa SHOP
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

        $permission = $this->checkPermission($id);

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
        $permission = $this->checkPermission($id);
        $store = Store::find($id);
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
        $permission = $this->checkPermission($id);
        $this->check_status_store($id);
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
        $permission = $this->checkPermission($id);
        $this->check_status_store($id);
        Coupons::find($request->id)->delete();
    }
    public function update_voucher($id, Request $request)
    {
        $permission = $this->checkPermission($id);
        $this->check_status_store($id);
        $coupon = Coupons::find($request->id);
        if ($coupon->quantity > $coupon->remaining_quantity) {
            Coupons::find($request->id)->update(['status'   => $request->status]);
        } else {
            return 'not validate';
        }
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
        $this->check_status_store($id);

        if (is_null($findProduct)) {
            return redirect()->back()->with("error", "Sản phẩm không tồn tại");
        }

        $findProduct->delete();
        return redirect()->back()->with("success", "Xoá thành công");
    }

    public function order($id)
    {

        $permission = $this->checkPermission($id);
        $store = Store::find($id);
        $orders = OrderStore::where('id_store', $id)->orderBy('id', 'DESC')->paginate(10);
        return view('home.pages.order_store', [
            'store' => $store,
            'permission'    => $permission,
            'orders'    => $orders
        ]);
    }
    public function order_detail($id, $id_order_store)
    {

        $permission = $this->checkPermission($id);
        $store = Store::find($id);
        $details = OrderDetail::where('id_order_store', $id_order_store)->get();
        return view('home.pages.detail_order_store', [
            'store' => $store,
            'permission'    => $permission,
            'details'    => $details
        ]);
    }
    public function update_order_store($id, $order, $status)
    {

        $permission = $this->checkPermission($id);
        $orderStore = OrderStore::find($order);
        $this->check_status_store($id);
        $orderStore->status_order = $status;
        if ($status == 3) {
            $orderStore->status_payment_store = '1';
            foreach ($orderStore->orderDetail as $detail) {
                $product_detail = ProductDetail::find($detail->id_product_detail);
                $product_detail->sold = $product_detail->sold + $detail->quantity;
                $product_detail->save();
            }
        } else {
            $orderStore->status_payment_store = '2';
        }
        if ($status == 1) {
            $history = [
                'id_order'  => $orderStore->id_order,
                'create_by' => $orderStore->store->name,
                'content'   => 'Đã xác nhận đơn hàng - đang xử lí'
            ];
        } else if ($status == 2) {
            $history = [
                'id_order'  => $orderStore->id_order,
                'create_by' => $orderStore->store->name,
                'content'   => 'Đang giao hàng'
            ];
        } else if ($status == 3) {
            $history = [
                'id_order'  => $orderStore->id_order,
                'create_by' => $orderStore->store->name,
                'content'   => 'Đã giao hàng thành công'
            ];
            $store = Store::find($orderStore->store->id);
            $store->money = $store->money + ($orderStore->total_price - $orderStore->coupons_price) + ($orderStore->ship - $orderStore->coupon_frs_price);
            $store->save();
            $user = User::find($orderStore->order->create_by);
            $user->turns = $user->turns + 1;
            $user->save();
        } else if ($status == 4) {
            $history = [
                'id_order'  => $orderStore->id_order,
                'create_by' => $orderStore->store->name,
                'content'   => 'Đã giao hàng thất bại - huỷ đơn hàng'
            ];
            if($orderStore->order->payment_status == 1) {
                $user = User::find($orderStore->order->create_by);
                $user->money = $user->money + ($orderStore->total_price - $orderStore->coupons_price) + ($orderStore->ship - $orderStore->coupon_frs_price);
                $user->save();
                $info = [
                    'id_user'   => $orderStore->order->create_by,
                    'amount'    => ($orderStore->total_price - $orderStore->coupons_price) + ($orderStore->ship - $orderStore->coupon_frs_price),
                    'type'      => '0',
                    'description'   => 'Hoàn tiền hoá đơn '.$orderStore->id,
                    'status'    => '1'
                ];
                PaymentUser::create($info);
            } 
        }
        HistoryUpdateOrder::create($history);
        $orderStore->save();

        $check = OrderStore::where('id_order', $orderStore->id_order)->where('status_order', '!=', $status)->count();
        if ($check == 0) {
            Order::find($orderStore->id_order)->update(['status_order' => $status]);
        }
        return redirect()->back()->with('success', 'Cập nhật thành công');
    }
    public function payment($id)
    {
        $permission = $this->checkPermission($id);
        $store = Store::find($id);
        $payment = PaymentStore::where('id_store',$id)->orderBy('id', 'DESC')->paginate(8);
        return view('home.pages.payment_store', [
            'store' => $store,
            'permission'    => $permission,
            'payment'   => $payment
        ]);
    }
    public function store_payment($id, Request $request)
    {
        $permission = $this->checkPermission($id);
        $this->check_status_store($id);
        $payment = [
            'id_store'  => $id,
            'create_by' => Auth::user()->id,
            'amount'    => $request->amount,
            'type'      => $request->type,
            'description'   => 'next',
            'status'    => '0'
        ];
        $payment = PaymentStore::create($payment);
        if($request->type == 1) {
            $store = Store::find($id);
            if($store->money < $payment->amount) {
                $payment->description = Auth::user()->name .' thực hiện yêu cầu rút tiền thất bại.';
                $payment->status = '2';
                $payment->save();
                return redirect()->back()->with('error', 'Số dư không đủ');
            } else {
                $payment->description = Auth::user()->name .' thực hiện yêu cầu rút tiền';
                $store->money = $store->money - $payment->amount;
                $payment->save();
                $store->save();
                $bank = [
                    'id_payment'    => $payment->id,
                    'name_bank'     => $request->bank_name,
                    'stk'           => $request->stk,
                    'chu_tk'        =>  $request->chu_tk
                ];
                BankInfo::create($bank);
                return redirect()->back()->with('success', 'Thực hiện yêu cầu rút tiền thành công, vui lòng chờ hệ thống kiểm duyệt');
            }
        } else {
            $payment->description = Auth::user()->name .' thực hiện nạp tiền vào tài khoản';
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = route('user.store_pay_return'); // return url
            $vnp_TmnCode = "7JV6DF6L"; //Mã website tại VNPAY 
            $vnp_HashSecret = "VXOMRZOMLKIIGUXOECIYPYIFXGCSJUIT"; //Chuỗi bí mật
    
            $vnp_TxnRef = $payment->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toán hoá đơn nạp tiền user ' . $payment->id;
            $vnp_OrderType = 'billPayment';
            $vnp_Amount = $payment->amount * 100;
            $vnp_Locale = 'vn';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef
            );
    
            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }
    
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
    
            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
    
            return redirect()->to($vnp_Url);
        }
    }

    public function payment_return(Request $request)
    {
        if (isset($request->vnp_Amount)) {
            $inputData = array();
            $vnp_HashSecret = "VXOMRZOMLKIIGUXOECIYPYIFXGCSJUIT";
            foreach ($_GET as $key => $value) {
                if (substr($key, 0, 4) == "vnp_") {
                    $inputData[$key] = $value;
                }
            }
            $vnp_SecureHash = $inputData['vnp_SecureHash'];
            unset($inputData['vnp_SecureHash']);
            ksort($inputData);
            $i = 0;
            $hashData = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
            }
            $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
            $data = [
                'id_order'  => $request->vnp_TxnRef,
                'amount'    => $request->vnp_Amount / 100,
                'id_payment_vnpay'  => $request->vnp_TransactionNo,
                'id_payment_bank'   =>  $request->vnp_BankTranNo,
                'message'   => $request->vnp_OrderInfo
            ];

            try {
                
                if ($secureHash == $vnp_SecureHash) {
                    
                    $payment = PaymentStore::find($request->vnp_TxnRef);
                    if ($payment->amount == $request->vnp_Amount / 100) {
                        if ($request->vnp_ResponseCode == '00' && $request->vnp_TransactionStatus == '00') {
                            $data['status'] = 'success';
                            $payment->description = 'Nạp tiền thành công';
                            $payment->status = '1';
                            $payment->save();
                            $store = Store::find($payment->id_store);
                            $store->money = $store->money + $payment->amount;
                            $store->save();
                            return redirect()->route('user.payment_store', $store->id)->with('success', 'Nạp tiền thành công');
                        } else {
                            $data['status'] = 'error';
                            $payment->description = 'Nạp tiền thất bại';
                            $payment->status = '2';
                            $payment->save();
                            return redirect()->route('user.payment_store', $payment->id_store)->with('error', 'Nạp tiền thất bại');
                        }
                    }
                }
            } catch (Exception $e) {
            };
        }
    }

    public function checkPermission($id)
    {
        $permission = PermissionStore::where('id_store', '=', $id)->where('id_user', '=', Auth::user()->id)->count();
        if ($permission == 0) {
            return redirect()->back()->with('error', 'you have no right');
        }
        else {
            return $permission;
        }
    }

    public function marketing($id,$product, Request $request)
    {
        $permission = $this->checkPermission($id);
        $this->check_status_store($id);
        $store = Store::find($id);
        if($store->money < $request->amount) {
            return redirect()->back()->with('error', 'Số dư không khả dụng');
        }
        $product = Product::find($product);
        $product->view_prioritized = $product->view_prioritized + ($request->amount*2);
        $product->save();
        $store->money = $store->money - $request->amount;
        $store->save();
        return redirect()->back()->with('success', 'Mua lượt view thành công');
    }

    public function check_status_store($id)
    {
        $store = Store::find($id);
        if($store->status != 1) {
            return redirect()->back()->with('error', 'Cửa hàng đang bị khoá');
        } 
    }
}
