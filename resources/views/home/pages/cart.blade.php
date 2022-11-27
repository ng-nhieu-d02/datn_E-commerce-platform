@extends('home.layout.main')

@section('content')
<div class="page--checkout" id="form_radio">
    <div>
        <form action="{{route('user.checkout')}}" method="GET">
            <div class="checkout-div">
                <div class="container--checkout-submit">
                    <div class="list--product list_cart--items">
                        @foreach(Auth::user()->cartStore() as $cart)
                        <div class="component--checkout--store--product">
                            <div class="component--checkout--store--product__store">
                                <div class="left">
                                    <div class="img-store">
                                        <img src="{{ asset('upload/store/avatars/' . $cart->store->avatar) }}" alt="">
                                    </div>
                                    <div class="title">
                                        <a href="{{route('user.store', $cart->store->id)}}">
                                            <p>{{$cart->store->name}}</p>
                                        </a>
                                    </div>
                                </div>

                                <div class="right">
                                    <a href="">
                                        <i class="fa fa-message"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="component--checkout--store--product__product">
                                @foreach($cart->cart($cart->id_store) as $product)
                                <x-cardProductCartDetail :data='$product'></x-cardProductCartDetail>
                                @endforeach
                            </div>
                            <div class="component--checkout--store--product__total">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <hr class="my-4">
                    <div class="card bg--none border--none">
                        <div class="div-input-group__cart">
                            <div>
                                <div class="input">
                                    <p>Chọn tất cả</p>
                                </div>
                                <div class="input">
                                    <p>Xoá</p>
                                </div>
                            </div>
                            <div>
                                <div class="div_price">
                                    <p>Tổng thanh toán (<span class="total_cart">0</span> sản phẩm):</p>
                                    <p class="price"> <span class="price_cart">0</span>đ</p>
                                </div>
                                <button type="submit" class="btn btn-secondary btn--apply">Mua ngay</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    var detail = JSON.parse('{!! json_encode(Auth::user()->cart()->select("cart.id", "cart.quantity", "product_detail.price")->join("product_detail", "cart.id_product_detail", "product_detail.id")->get()) !!}');
</script>

@endsection