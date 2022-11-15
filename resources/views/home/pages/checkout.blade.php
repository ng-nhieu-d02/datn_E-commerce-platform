@extends('home.layout.main')

@section('content')

<form class="page--checkout" id="form_radio">
    <div>
        <main>
            <div class="checkout-div">
                <div class="container--checkout-submit">
                    <!-- <h2 class="mb-5">Order summary</h2> -->
                    <div class="list--product list_cart--items">
                        @php
                            $ship = 0;
                            $price = 0;
                        @endphp
                        @foreach(Auth::user()->cartStoreActive() as $store)
                        @php
                            $total = 0;
                            $weight = 0;
                        @endphp
                        <div class="component--checkout--store--product">
                            <div class="component--checkout--store--product__store">
                                <div class="left">
                                    <div class="img-store">
                                        <img src="{{ asset('upload/store/'.$store->store->avatar) }}" alt="">
                                    </div>
                                    <div class="title">
                                        <a href="">
                                            <p>{{$store->store->name}}</p>
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
                                @foreach($store->productCart($store->id_store) as $product)
                                @php
                                    $total += $product->detail->price * $product->quantity;
                                    $weight += $product->detail->weight * $product->quantity;
                                @endphp
                                <x-cardProductCart :data='$product'></x-cardProductCart>
                                @endforeach
                            </div>
                            <div class="component--checkout--store--product__total">
                                <div class="box__total">
                                    <div class="left">
                                        <p>Lời nhắn: </p>
                                        <input type="text" class="message__input massage__input__checkout" name="{{$store->store->slug}}" id="message" placeholder="Message">
                                    </div>
                                    <div class="right">
                                        @php
                                            $data = [
                                                "pick_province" => $store->store->city,
                                                "pick_district" => $store->store->district,
                                                "pick_address" => $store->store->address,
                                                "province"  => $address->city,
                                                "district" => $address->district,
                                                "address" => $address->address,
                                                "weight" => $weight,
                                                "value" => $total,
                                                "transport" => "road",
                                                "deliver_option" => "none",
                                                "tags"  => [1]
                                            ];
                                        @endphp
                                        <p>Phí vận chuyển: <span>{{number_format($store->shipping_fees($data))}}</span>đ</p>
                                    </div>
                                </div>
                                <div class="box__total">
                                    <ion-icon name="ticket-outline"></ion-icon>
                                    <p>Voucher của shop</p>
                                    <input type="text" name="{{$store->store->slug}}" class="voucher__input__checkout" id="voucherShop" hidden>
                                </div>
                                <div class="box__total">
                                    <p>TỔNG SỐ TIỀN (<span>{{count($store->productCart($store->id_store))}}</span> sản phẩm): <span> {{number_format($total + $store->shipping_fees($data), 0, ',', '.')}}đ</span></p>
                                </div>
                            </div>
                            @php
                                $ship += $store->shipping_fees($data);
                                $price += $total;
                            @endphp
                        </div>
                        @endforeach

                    </div>
                    <hr class="my-4">
                    <div class="select animated zoomIn">
                        <!-- You can toggle select (disabled) -->
                        <input type="radio" id="input_radio" class="address_option" name="option" value="required" required>
                        <i class="toggle icon fa fa-chevron-down"></i>
                        <i class="toggle icon fa fa-chevron-up"></i>
                        <span class="placeholder">Choose...</span>
                        @foreach(Auth::user()->address()->get() as $addressChoose)
                            <label class="option">
                                <input type="radio" id="input_radio" class="address_option" name="option" {{$addressChoose->id == $address->id ? 'checked' : ''}} value="{{$addressChoose->id}}" required>
                                <span class="title animated fadeIn"><i class="icon fa fa-location-dot {{$addressChoose->id == $address->id ? 'active' : ''}}"></i>{{$addressChoose->address}}, {{$addressChoose->district}}, {{$addressChoose->city}} - {{$addressChoose->name}}, {{$addressChoose->phone}}, {{$addressChoose->email}}</span>
                            </label>
                        @endforeach
                    </div>
                    <hr class="my-4">
                    <div class="card bg--none border--none">
                        <label class="form-check-label pb-3" for="discount-code">Discount Code</label>
                        <div class="input-group">
                            <input type="text" class="form-control discode--input rounded--1r big-event" name="big-event" id="discount-code" placeholder="Discount Code">
                            <button type="submit" class="btn btn-secondary rounded--1r ml--10 btn--apply">Apply</button>
                            <button type="submit" class="btn btn-secondary rounded--1r ml--10 btn--apply">Chọn voucher</button>
                        </div>
                    </div>
                    <ul class="list-group mb-3 mt-5">
                        <li class="py-3 d-flex justify-content-between align-items-center lh-sm border--none bg--none">
                            <div>
                                <h5 class="my-0">Product name</h5>
                                <small class="text-muted">Subtotal</small>
                            </div>
                            <span class="text-muted">{{number_format($price, 0, ',', '.')}}đ</span>
                        </li>
                        <li class="py-3 d-flex justify-content-between align-items-center lh-sm border--none bg--none">
                            <div>
                                <h6 class="my-0">Shipping estimate</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted">{{number_format($ship, 0, ',', '.')}}đ</span>
                        </li>
                        <li class="py-3 d-flex justify-content-between align-items-center lh-sm border--none bg--none">
                            <div>
                                <h6 class="my-0">Tax estimate</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted">0đ</span>
                        </li>
                        <li class="py-3 d-flex justify-content-between align-items-center border--none bg--none">
                            <span class="text--order--total">Order total</span>
                            <strong class="confirm_total">{{number_format($price + $ship, 0, ',', '.')}}đ</strong>
                        </li>
                    </ul>

                    <hr class="my-4">
                    <h2 class="mb-5 mt-5">Payment Method</h2>
                    <div class="my-3">
                        <div class="form-check form--check--payment justify--content--between items-end">
                            <div>
                                <input id="vnpay" name="paymentMethod" type="radio" class="form-check-input" value="1" required>
                                <label class="form-check-label" for="vnpay">Credit or debit card</label>
                            </div>
                            <div>
                                <img src="{{ url('assets/images/icons/vnpay.png') }}" class="icon--card">
                                <img src="{{ url('assets/images/icons/bank.png') }}" class="icon--cardBank">
                            </div>
                        </div>
                        <div class="form-check form--check--payment justify--content--between items-end">
                            <div>
                                <input id="momo" name="paymentMethod" type="radio" class="form-check-input" value="2" required>
                                <label class="form-check-label" for="momo">Momo</label>
                            </div>
                            <img src="{{ url('assets/images/icons/momo.png') }}" class="icon--card">
                        </div>
                        <div class="form-check form--check--payment justify--content--between items-end">
                            <div>
                                <input id="beespay" name="paymentMethod" type="radio" class="form-check-input" value="3" required>
                                <label class="form-check-label" for="beespay">Beespay</label>
                            </div>
                            <img src="{{ url('assets/images/icons/beespay.png') }}" class="icon--card">
                        </div>
                        <div class="form-check form--check--payment justify--content--between items-end">
                            <div>
                                <input id="cod" name="paymentMethod" type="radio" class="form-check-input" value="4" required>
                                <label class="form-check-label" for="cod">Thanh toán khi nhận hàng</label>
                            </div>
                            <img src="{{ url('assets/images/icons/receive.png') }}" class="icon--card">
                        </div>
                    </div>

                    <div class="py-4">
                        <button type="submit" class="btn button_confirm_order btn-secondary btn--confirm--order bg--color w-100">Confirm Order</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</form>

@endsection