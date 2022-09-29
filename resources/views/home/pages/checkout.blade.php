@extends('home.layout.main')

@section('content')

<form class="page--checkout" id="form_radio">
    <div>
        <main>
            <div class="checkout-div">
                <div class="container--checkout-submit">
                    <!-- <h2 class="mb-5">Order summary</h2> -->
                    <div class="list--product list_cart--items">
                        <div class="component--checkout--store--product">
                            <div class="component--checkout--store--product__store">
                                <div class="left">
                                    <div class="img-store">
                                        <img src="{{ asset('assets/images/image_product/logo.png') }}" alt="">
                                    </div>
                                    <div class="title">
                                        <a href="">
                                            <p>Five Bees Store</p>
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
                                <x-cardProductCart></x-cardProductCart>
                                <x-cardProductCart></x-cardProductCart>
                            </div>
                            <div class="component--checkout--store--product__total">
                                <div class="box__total">
                                    <div class="left">
                                        <p>Lời nhắn: </p>
                                        <input type="text" class="message__input" id="message" placeholder="Message">
                                    </div>
                                    <div class="right">
                                        <p>Phí vận chuyển: <span>23.000</span></p>
                                    </div>
                                </div>
                                <div class="box__total">
                                    <ion-icon name="ticket-outline"></ion-icon>
                                    <p>Voucher của shop</p>
                                </div>
                                <div class="box__total">
                                    <p>TỔNG SỐ TIỀN (<span>2</span> sản phẩm): <span>600.000đ</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="component--checkout--store--product">
                            <div class="component--checkout--store--product__store">
                                <div class="left">
                                    <div class="img-store">
                                        <img src="{{ asset('assets/images/image_product/logo.png') }}" alt="">
                                    </div>
                                    <div class="title">
                                        <a href="">
                                            <p>Five Bees Store</p>
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
                                <x-cardProductCart></x-cardProductCart>
                                <x-cardProductCart></x-cardProductCart>
                            </div>
                            <div class="component--checkout--store--product__total">
                                <div class="box__total">
                                    <div class="left">
                                        <p>Lời nhắn: </p>
                                        <input type="text" class="message__input" id="message" placeholder="Message">
                                    </div>
                                    <div class="right">
                                        <p>Phí vận chuyển: <span>23.000</span></p>
                                    </div>
                                </div>
                                <div class="box__total">
                                    <ion-icon name="ticket-outline"></ion-icon>
                                    <p>Voucher của shop</p>
                                </div>
                                <div class="box__total">
                                    <p>TỔNG SỐ TIỀN (<span>2</span> sản phẩm): <span>600.000đ</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="select animated zoomIn">
                        <!-- You can toggle select (disabled) -->
                        <input type="radio" id="input_radio" name="option" required>
                        <i class="toggle icon fa fa-chevron-down"></i>
                        <i class="toggle icon fa fa-chevron-up"></i>
                        <span class="placeholder">Choose...</span>
                        <label class="option">
                            <input type="radio" id="input_radio" name="option" checked value="1" required>
                            <span class="title animated fadeIn"><i class="icon fa fa-location-dot"></i>Address 1, Quận 12, Thành phố HCM</span>
                        </label>
                        <label class="option">
                            <input type="radio" id="input_radio" name="option" value="2" required>
                            <span class="title animated fadeIn"><i class="icon fa fa-location-dot"></i>Address 1, Quận 12, Thành phố HCM</span>
                        </label>
                        <label class="option">
                            <input type="radio" id="input_radio" name="option" value="3" required>
                            <span class="title animated fadeIn"><i class="icon fa fa-location-dot"></i>Address 1, Quận 12, Thành phố HCM</span>
                        </label>
                    </div>
                    <!-- form thêm địa chỉ -->
                    <!-- <form class="needs-validation" novalidate="">
                        <div class="row g-3" style="display: none;">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">First name</label>
                                <input type="text" class="form-control checkout--input rounded--1r" id="firstName" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Last name</label>
                                <input type="text" class="form-control checkout--input rounded--1r" id="lastName" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control checkout--input rounded--1r" id="email" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Valid email is required.
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="phoneNumber" class="form-label">Phone Number</label>
                                <input type="text" class="form-control checkout--input rounded--1r" id="phoneNumber" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="country" class="form-label">Tỉnh / Thành Phố</label>
                                <select id="city" class="form-select checkout--select rounded--1r fs--12" id="country" required="">

                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid Tỉnh / Thành Phố.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="state" class="form-label">Quận / Huyện</label>
                                <select id="district" class="form-select checkout--select rounded--1r fs--12" id="state" required="">

                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid Quận / Huyện.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="state" class="form-label">Phường / Xã</label>
                                <select id="ward" class="form-select checkout--select rounded--1r fs--12" id="state" required="">

                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid Phường / Xã.
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="streets" class="form-label">Đường</label>
                                <input type="text" class="form-control checkout--input rounded--1r" id="streets" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Valid Đường is required.
                                </div>
                            </div>
                        </div>
                    </form> -->
                    <hr class="my-4">
                    <div class="card bg--none border--none">
                        <label class="form-check-label pb-3" for="discount-code">Discount Code</label>
                        <div class="input-group">
                            <input type="text" class="form-control discode--input rounded--1r" id="discount-code" placeholder="Discount Code">
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
                            <span class="text-muted">249.000đ</span>
                        </li>
                        <li class="py-3 d-flex justify-content-between align-items-center lh-sm border--none bg--none">
                            <div>
                                <h6 class="my-0">Shipping estimate</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted">5.000đ</span>
                        </li>
                        <li class="py-3 d-flex justify-content-between align-items-center lh-sm border--none bg--none">
                            <div>
                                <h6 class="my-0">Tax estimate</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted">24.000đ</span>
                        </li>
                        <li class="py-3 d-flex justify-content-between align-items-center border--none bg--none">
                            <span class="text--order--total">Order total</span>
                            <strong class="confirm_total">300.000đ</strong>
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
                        <button type="submit" class="btn btn-secondary btn--confirm--order bg--color w-100">Confirm Order</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</form>

<!-- css page--checkout width = var(--max-width) margin auto -->
@endsection