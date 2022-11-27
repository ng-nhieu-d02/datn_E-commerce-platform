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
                                        <img src="{{ asset('upload/store/avatars/' . $store->store->avatar) }}" alt="">
                                    </div>
                                    <div class="title">
                                        <a href="{{route('user.store', $store->store->id)}}">
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
                                        <input type="text" class="message__input massage__input__checkout" name="{{$store->store->slug}}" placeholder="Message">
                                    </div>
                                    <div class="right">
                                        @php
                                        $data = [
                                        "pick_province" => $store->store->city,
                                        "pick_district" => $store->store->district,
                                        "pick_address" => $store->store->address,
                                        "province" => $address->city,
                                        "district" => $address->district,
                                        "address" => $address->address,
                                        "weight" => $weight,
                                        "value" => $total,
                                        "transport" => "road",
                                        "deliver_option" => "none",
                                        "tags" => [1]
                                        ];
                                        $ship_store = $store->shipping_fees($data);
                                        @endphp
                                        <p>Phí vận chuyển: <span class="ship_store__{{$store->store->slug}} store__ship__result" data-reduce="0">{{number_format($ship_store)}}</span>đ</p>
                                    </div>
                                </div>
                                <div class="box__total">
                                    <ion-icon name="ticket-outline"></ion-icon>
                                    <p class="btn_use_voucher" data-id="{{$store->store->id}}">Voucher của shop</p>

                                    <input type="text" name="{{$store->store->slug}}" class="voucher__input__checkout voucher__input__{{$store->store->slug}}" hidden>
                                    <div class="container__modal modal__user__voucher_{{$store->store->id}}" style="display:none">

                                        <div class="container__modal--header">
                                            <div class="container__modal--header__title">
                                                <p>Chọn FFBees voucher</p>
                                            </div>
                                            <div></div>
                                            <div class="container__modal--header__icon_close">
                                                <ion-icon name="close-circle-outline"></ion-icon>
                                            </div>
                                        </div>

                                        <div class="container__modal--main">
                                            <div class="container__modal--main__input__search">
                                                <div class="input-group my-4">
                                                    <span class="input-group-text">Mã voucher</span>
                                                    <input type="text" class="form-control py-3 input__apply__voucher__{{$store->store->slug}}" name="{{$store->store->slug}}">
                                                    <span class="input-group-text apply__voucher__store" data-store="{{$store->store->slug}}" data-id="{{$store->store->id}}" data-ship="{{$ship_store}}" data-total="{{$total}}" role="button">Áp dụng</span>
                                                </div>
                                            </div>
                                            <div class="container__modal--main__voucher">
                                                @foreach($store->coupon($store->store->id) as $voucher)
                                                <div class="content__voucher {{$voucher->quantity - $voucher->remaining_quantity <= 0 ? 'disable' : ($voucher->money_apply_start > $total ? 'disable' : ($voucher->money_apply_end < $total ? 'disable' : ''))}}">
                                                    <div class="left__content__voucher">
                                                        <img src="{{asset('assets\images\voucher.png')}}" alt="">
                                                        <span class="badge text-bg-success" role="button">{{$voucher->type == 0 ? 'Giảm tiền' : ($voucher->type == 1 ? 'Giảm %' : 'FreeShip')}}</span>
                                                    </div>
                                                    <div class="right__content__voucher">
                                                        <div class="information__voucher">
                                                            <p>{{$voucher->name}}</p>
                                                            <button type="button" class="btn btn-outline-danger">{{number_format($voucher->value)}}{{$voucher->type == 1 ? '%' :""}} Tối đa {{number_format($voucher->max_price)}}</button>
                                                            <p>Thời hạn: <span style="color: #328b05">{{$voucher->stop_time}}</span> </p>
                                                        </div>
                                                        <button type="button" class="btn btn-outline-primary apply__code__store" data-type="{{$voucher->type}}" data-id="{{$voucher->id}}" data-value="{{$voucher->value}}" data-max_value="{{$voucher->max_price}}" data-ship="{{$ship_store}}" data-total="{{$total}}" data-action="{{$voucher->quantity - $voucher->remaining_quantity <= 0 ? 'false' : ($voucher->money_apply_start > $total ? 'false' : ($voucher->money_apply_end < $total ? 'false' : 'true'))}}" data-store="{{$store->store->slug}}">Áp dụng</button>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="box__total">
                                    <p>TỔNG SỐ TIỀN (<span>{{count($store->productCart($store->id_store))}}</span> sản phẩm):
                                        <span class="total__store__{{$store->store->slug}} store__total__result" data-reduce="0"> {{number_format($total + $ship_store, 0, ',', '.')}}đ</span>
                                    </p>
                                </div>
                            </div>
                            @php
                            $ship += $ship_store;
                            $price += $total;
                            @endphp
                        </div>
                        @endforeach

                    </div>
                    <hr class="my-4">
                    <div class="select animated zoomIn">
                        <!-- You can toggle select (disabled) -->
                        <input type="radio" class="address_option" name="option" value="required" required>
                        <i class="toggle icon fa fa-chevron-down"></i>
                        <i class="toggle icon fa fa-chevron-up"></i>
                        <span class="placeholder">Choose...</span>
                        @foreach(Auth::user()->address()->get() as $addressChoose)
                        <label class="option">
                            <input type="radio" class="address_option" name="option" {{$addressChoose->id == $address->id ? 'checked' : ''}} value="{{$addressChoose->id}}" required>
                            <span class="title animated fadeIn"><i class="icon fa fa-location-dot {{$addressChoose->id == $address->id ? 'active' : ''}}"></i>{{$addressChoose->address}}, {{$addressChoose->district}}, {{$addressChoose->city}} - {{$addressChoose->name}}, {{$addressChoose->phone}}, {{$addressChoose->email}}</span>
                        </label>
                        @endforeach
                    </div>
                    <hr class="my-4">
                    <div class="card bg--none border--none">
                        <label class="form-check-label pb-3" for="discount-code">Discount Code</label>
                        <div class="input-group">
                            <input type="text" class="input__apply__voucher__big__tech form-control discode--input rounded--1r big-event" name="big-event" id="discount-code" placeholder="Discount Code">
                            <button type="submit" class="btn btn-secondary rounded--1r ml--10 btn--apply apply__voucher__main" data-store="big__tech" data-id="0" data-total="{{$price}}" data-ship="{{$ship}}">Apply</button>
                            <button type="submit" class="btn btn-secondary rounded--1r ml--10 btn--apply">Chọn voucher</button>
                        </div>
                    </div>
                    <ul class="list-group mb-3 mt-5">
                        <li class="py-3 d-flex justify-content-between align-items-center lh-sm border--none bg--none">
                            <div>
                                <h5 class="my-0">Product name</h5>
                                <small class="text-muted">Subtotal</small>
                            </div>
                            <span class="text-muted price__order__result" data-price="{{$price}}">{{number_format($price, 0, ',', '.')}}đ</span>
                        </li>
                        <li class="py-3 d-flex justify-content-between align-items-center lh-sm border--none bg--none">
                            <div>
                                <h6 class="my-0">Shipping estimate</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted ship__order__result" data-price="{{$ship}}">{{number_format($ship, 0, ',', '.')}}đ</span>
                        </li>
                        <li class="py-3 d-flex justify-content-between align-items-center lh-sm border--none bg--none">
                            <div>
                                <h6 class="my-0">Tax estimate</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted">0đ</span>
                        </li>
                        <li class="py-3 d-flex justify-content-between align-items-center lh-sm border--none bg--none">
                            <div>
                                <h6 class="my-0">Voucher</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted voucher__main" data-value="0">-0đ</span>
                        </li>
                        <li class="py-3 d-flex justify-content-between align-items-center border--none bg--none">
                            <span class="text--order--total">Order total</span>
                            <strong class="confirm_total" data-price="{{$price + $ship}}">{{number_format($price + $ship, 0, ',', '.')}}đ</strong>
                        </li>
                    </ul>

                    <hr class="my-4">
                    <h2 class="mb-5 mt-5">Payment Method</h2>
                    <div class="my-3">
                        <div class="form-check form--check--payment justify--content--between items-end">
                            <div>
                                <input id="vnpay" name="paymentMethod" type="radio" class="form-check-input" value="2" required>
                                <label class="form-check-label" for="vnpay">Credit or debit card VNPay</label>
                            </div>
                            <div>
                                <img src="{{ url('assets/images/icons/vnpay.png') }}" class="icon--card">
                                <img src="{{ url('assets/images/icons/bank.png') }}" class="icon--cardBank">
                            </div>
                        </div>
                        <div class="form-check form--check--payment justify--content--between items-end">
                            <div>
                                <input id="momo" name="paymentMethod" type="radio" class="form-check-input" value="3" required>
                                <label class="form-check-label" for="momo">Momo</label>
                            </div>
                            <img src="{{ url('assets/images/icons/momo.png') }}" class="icon--card">
                        </div>
                        <div class="form-check form--check--payment justify--content--between items-end">
                            <div>
                                <input id="beespay" name="paymentMethod" type="radio" class="form-check-input" value="1" required>
                                <label class="form-check-label" for="beespay">Beespay</label>
                            </div>
                            <img src="{{ url('assets/images/icons/beespay.png') }}" class="icon--card">
                        </div>
                        <div class="form-check form--check--payment justify--content--between items-end">
                            <div>
                                <input id="cod" name="paymentMethod" type="radio" class="form-check-input" value="0" required>
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

@section('scripts')

<script>
    $('.apply__code__store').click(function(e) {
        e.preventDefault();
        const action = $(this).attr('data-action');
        if (action == 'false') {
            alert('Không đủ điều kiện sử dụng voucher này !!');
            return;
        } else {
            const id = $(this).attr('data-id');
            const store = $(this).attr('data-store');
            const type = $(this).attr('data-type');
            const value = $(this).attr('data-value');
            const max_value = $(this).attr('data-max_value');
            const total = $(this).attr('data-total');
            const ship = $(this).attr('data-ship');
            let result = 0;
            if (type == 0) {
                result = Number(total) + Number(ship) - Number(value);
            } else if (type == 1) {
                let reduce = (total / 100) * value;
                if (reduce > max_value) {
                    reduce = max_value;
                }
                result = Number(total) + Number(ship) - Number(reduce);
            } else if (type == 2) {
                if (ship > value) {
                    result = Number(total) + Number(ship) - Number(value);
                    $('.ship_store__' + store).text(Intl.NumberFormat().format(Number(ship)) + '-' + Intl.NumberFormat().format(Number(value)));
                } else {
                    result = Number(total);
                    $('.ship_store__' + store).text(Intl.NumberFormat().format(Number(ship)) + '-' + Intl.NumberFormat().format(Number(ship)));
                }
            }
            if ($(this).text() == 'Áp dụng') {
                $('.container__modal--header__icon_close').click();
                $('.apply__code__store').text('Áp dụng');
                $(this).text('Đang sử dụng');
                $(this).removeClass('apply__code__store');
                if (type == 2) {
                    $('.total__store__' + store).text(Intl.NumberFormat().format(Number(result)) + 'đ');
                    $('.ship_store__' + store).attr('data-reduce', Number(total) + Number(ship) - Number(result));
                } else {
                    $('.total__store__' + store).text(Intl.NumberFormat().format(Number(total) + Number(ship)) + 'đ - ' + Intl.NumberFormat().format(Number(total) + Number(ship) - Number(result)) + 'đ');
                    $('.total__store__' + store).attr('data-reduce', Number(total) + Number(ship) - Number(result));
                }
                let sum_ship_reduce = 0;
                document.querySelectorAll('.store__ship__result').forEach(element => {
                    const reduce_value = element.getAttribute('data-reduce');
                    sum_ship_reduce += Number(reduce_value);
                });
                let sum_total_reduce = 0;
                document.querySelectorAll('.store__total__result').forEach(element => {
                    const reduce_value = element.getAttribute('data-reduce');
                    sum_total_reduce += Number(reduce_value);
                });
                const element__total__order = $('.price__order__result');
                element__total__order.text(Intl.NumberFormat().format(Number(element__total__order.attr('data-price')) - sum_total_reduce) + 'đ');
                const element__ship__order = $('.ship__order__result');
                element__ship__order.text(Intl.NumberFormat().format(Number(element__ship__order.attr('data-price')) - sum_ship_reduce) + 'đ');
                $('.confirm_total').text(Intl.NumberFormat().format((Number(element__total__order.attr('data-price')) - sum_total_reduce) + (Number(element__ship__order.attr('data-price')) - sum_ship_reduce)) + 'đ');
                $('.confirm_total').attr('data-price', (Number(element__total__order.attr('data-price')) - sum_total_reduce) + (Number(element__ship__order.attr('data-price') - sum_ship_reduce)));
                $('.voucher__input__' + store).val(id);
            }
        }
    });
    $('.apply__voucher__main').click(function(e) {
        e.preventDefault();
        const code = $('.input__apply__voucher__big__tech').val();
        const url__submit = '{{route("user.get_voucher")}}';
        const _csrf = '{{ csrf_token() }}';
        const total = $(this).attr('data-total');
        const ship = $(this).attr('data-ship');
        const data = {
            code: code,
            store: 0,
            _token: _csrf
        };
        let reduce = 0;
        $.ajax({
            url: url__submit,
            type: 'POST',
            data: data,
            success: function(res) {
                const json = JSON.parse(res);
                if (json.message == 'error') {
                    alert('voucher không hợp lệ. vui lòng kiểm tra lại !!');
                } else {
                    if (total < json.coupon.money_apply_start || total > json.coupon.money_apply_end) {
                        alert('hoá đơn không đủ điều kiện sử dụng');
                    } else if (json.coupon.quantity - json.coupon.remaining_quantity <= 0) {
                        alert('voucher đã quá số lần sử dụng');
                    } else if (json.coupon.apply_with == 1 && json.coupon.user_id != '{{Auth::user()->id}}') {
                        alert('Hoá đơn này không dành cho bạn.');
                    } else {
                        if (json.coupon.type == 0) {
                            reduce = Number(json.coupon.value);
                        } else if (json.coupon.type == 1) {
                            reduce = (Number(total) / 100) * Number(json.coupon.value)
                            if (reduce > json.coupon.max_price) {
                                reduce = Number(json.coupon.max_price);
                            }
                        } else if (json.coupon.type == 2) {
                            if (ship > json.coupon.value) {
                                reduce = Number(ship) - Number(json.coupon.value)
                            } else {
                                reduce = Number(ship);
                            }
                        }
                        $('.voucher__main').text('- ' + Intl.NumberFormat().format(reduce) + 'đ');
                        $('.voucher__main').attr('data-value', reduce);
                        $('.confirm_total').text(Number($('.confirm_total').attr('data-price')) - Number(reduce) + 'đ')
                    }
                }
            }
        });
    })
    $('.apply__voucher__store').click(function(e) {
        e.preventDefault();
        const store = $(this).attr('data-store');
        const code = $('.input__apply__voucher__' + store).val();
        const id_store = $(this).attr('data-id');
        const url__submit = '{{route("user.get_voucher")}}';
        const _csrf = '{{ csrf_token() }}';
        const total = $(this).attr('data-total');
        const ship = $(this).attr('data-ship');
        const data = {
            code: code,
            store: id_store,
            _token: _csrf
        };
        $.ajax({
            url: url__submit,
            type: 'POST',
            data: data,
            success: function(res) {
                const json = JSON.parse(res);
                if (json.message == 'error') {
                    alert('voucher không hợp lệ. vui lòng kiểm tra lại !!');
                } else {
                    if (total < json.coupon.money_apply_start || total > json.coupon.money_apply_end) {
                        alert('hoá đơn không đủ điều kiện sử dụng');
                    } else if (json.coupon.quantity - json.coupon.remaining_quantity <= 0) {
                        alert('voucher đã quá số lần sử dụng');
                    } else if (json.coupon.apply_with == 1 && json.coupon.user_id != '{{Auth::user()->id}}') {
                        alert('Hoá đơn này không dành cho bạn.');
                    } else {
                        if (json.coupon.type == 0) {
                            result = Number(total) + Number(ship) - Number(json.coupon.value);
                        } else if (json.coupon.type == 1) {
                            let reduce = (total / 100) * json.coupon.value;
                            if (reduce > json.coupon.max_price) {
                                reduce = json.coupon.max_price;
                            }
                            result = Number(total) + Number(ship) - Number(reduce);
                        } else if (json.coupon.type == 2) {
                            if (ship > json.coupon.value) {
                                result = Number(total) + Number(ship) - Number(json.coupon.value);
                                $('.ship_store__' + store).text(Intl.NumberFormat().format(Number(ship)) + '-' + Intl.NumberFormat().format(Number(json.coupon.value)));
                            } else {
                                result = Number(total);
                                $('.ship_store__' + store).text(Intl.NumberFormat().format(Number(ship)) + '-' + Intl.NumberFormat().format(Number(ship)));
                            }
                        }
                        $('.container__modal--header__icon_close').click();
                        if (json.coupon.type == 2) {
                            $('.total__store__' + store).text(Intl.NumberFormat().format(Number(result)) + 'đ');
                            $('.ship_store__' + store).attr('data-reduce', Number(total) + Number(ship) - Number(result));
                        } else {
                            $('.total__store__' + store).text(Intl.NumberFormat().format(Number(total) + Number(ship)) + 'đ - ' + Intl.NumberFormat().format(Number(total) + Number(ship) - Number(result)) + 'đ');
                            $('.total__store__' + store).attr('data-reduce', Number(total) + Number(ship) - Number(result));
                        }
                        let sum_ship_reduce = 0;
                        document.querySelectorAll('.store__ship__result').forEach(element => {
                            const reduce_value = element.getAttribute('data-reduce');
                            sum_ship_reduce += Number(reduce_value);
                        });
                        let sum_total_reduce = 0;
                        document.querySelectorAll('.store__total__result').forEach(element => {
                            const reduce_value = element.getAttribute('data-reduce');
                            sum_total_reduce += Number(reduce_value);
                        });
                        const element__total__order = $('.price__order__result');
                        element__total__order.text(Intl.NumberFormat().format(Number(element__total__order.attr('data-price')) - sum_total_reduce) + 'đ');
                        const element__ship__order = $('.ship__order__result');
                        element__ship__order.text(Intl.NumberFormat().format(Number(element__ship__order.attr('data-price')) - sum_ship_reduce) + 'đ');
                        $('.confirm_total').text(Intl.NumberFormat().format((Number(element__total__order.attr('data-price')) - sum_total_reduce) + (Number(element__ship__order.attr('data-price')) - sum_ship_reduce)) + 'đ');
                        $('.confirm_total').attr('data-price', (Number(element__total__order.attr('data-price')) - sum_total_reduce) + (Number(element__ship__order.attr('data-price') - sum_ship_reduce)));
                        $('.voucher__input__' + store).val(json.coupon.id);
                    }
                }
            }
        });
    })
</script>

@endsection