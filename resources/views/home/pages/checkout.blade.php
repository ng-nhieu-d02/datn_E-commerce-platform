@extends('home.layout.main')

@section('content')

<div class="page--checkout">
    <div>
        <main>
            <div class="checkout-div">
                <div class="order-md-last container--checkout-submit">
                    <!-- <h2 class="mb-5">Order summary</h2> -->
                    <div class="list--product list_cart--items">
                        <div class="item row">
                            <div class="item--left col-md-3">
                                <a href=""><img class="image-product" src="{{ asset('assets/images/image_cart/17.7701cf9446a6b588de67.png') }}" alt=""></a>
                            </div>
                            <div class="item--right col-md-9 d-flex flex-column justify-content-between">
                                <div class="item--product_price d-flex">
                                    <div class="info">
                                        <h3 class="text--info">
                                            <a href="">Rey Nylon Backpack</a>
                                        </h3>
                                        <p>
                                            <span>Natural</span>
                                            <span> | </span>
                                            <span>XL</span>
                                        </p>
                                    </div>
                                    <div class="price">
                                        <span>$74.00</span>
                                    </div>
                                </div>
                                <div class="item--qty_remove align-items-center">
                                    <p class="input--cart m-0">
                                        <span class="summation">+</span>
                                        <input type="number" value="1" id="qty">
                                        <span class="subtraction">-</span>
                                    </p>
                                    <div class="remove">
                                        <button>Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <form class="card bg--none border--none">
                        <label class="form-check-label pb-3" for="discount-code">Discount Code</label>
                        <div class="input-group">
                            <input type="text" class="form-control discode--input rounded--1r" id="discount-code" placeholder="Discount Code">
                            <button type="submit" class="btn btn-secondary rounded--1r ml--10 btn--apply">Apply</button>
                        </div>
                    </form>
                    <ul class="list-group mb-3 mt-5">
                        <li class="py-3 d-flex justify-content-between align-items-center lh-sm border--none bg--none">
                            <div>
                                <h5 class="my-0">Product name</h5>
                                <small class="text-muted">Subtotal</small>
                            </div>
                            <span class="text-muted">$249.00</span>
                        </li>
                        <li class="py-3 d-flex justify-content-between align-items-center lh-sm border--none bg--none">
                            <div>
                                <h6 class="my-0">Shipping estimate</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted">$5.00</span>
                        </li>
                        <li class="py-3 d-flex justify-content-between align-items-center lh-sm border--none bg--none">
                            <div>
                                <h6 class="my-0">Tax estimate</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted">$24.90</span>
                        </li>
                        <li class="py-3 d-flex justify-content-between align-items-center border--none bg--none">
                            <span class="text--order--total">Order total</span>
                            <strong>$276.00</strong>
                        </li>
                    </ul>

                    <div class="py-4">
                        <button type="submit" class="btn btn-secondary btn--confirm--order bg--color w-100">Confirm Order</button>
                    </div>
                </div>
                <div class="">
                    <h2 class="mb-5">Billing address</h2>
                    <form class="needs-validation" novalidate="">
                        <div class="row g-3">
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
                        <hr class="my-4">
                        <h4 class="mb-3">Payment</h4>
                        <div class="my-3">
                            <div class="form-check form--check--payment justify--content--between items-end">
                                <div>
                                    <input id="VNPAY" name="paymentMethod" type="radio" class="form-check-input" checked="" required="">
                                    <label class="form-check-label" for="VNPAY">VNPAY</label>
                                </div>
                                <div>
                                    <img src="{{ url('assets/images/icons/vnpay.png') }}" class="icon--card">
                                    <img src="{{ url('assets/images/icons/bank.png') }}" class="icon--cardBank">
                                </div>
                            </div>
                            <div class="form-check form--check--payment justify--content--between items-end">
                                <div>
                                    <input id="VNPAY" name="paymentMethod" type="radio" class="form-check-input" checked="" required="">
                                    <label class="form-check-label" for="VNPAY">MOMO</label>
                                </div>
                                <img src="{{ url('assets/images/icons/momo.png') }}" class="icon--card">
                            </div>
                            <div class="form-check form--check--payment justify--content--between items-end">
                                <div>
                                    <input id="VNPAY" name="paymentMethod" type="radio" class="form-check-input" checked="" required="">
                                    <label class="form-check-label" for="VNPAY">Beespay</label>
                                </div>
                                <img src="{{ url('assets/images/icons/beespay.png') }}" class="icon--card">
                            </div>
                            <div class="form-check form--check--payment justify--content--between items-end">
                                <div>
                                    <input id="VNPAY" name="paymentMethod" type="radio" class="form-check-input" checked="" required="">
                                    <label class="form-check-label" for="VNPAY">Thanh toán khi nhận hàng</label>
                                </div>
                                <img src="{{ url('assets/images/icons/receive.png') }}" class="icon--card">
                            </div>
                        </div>
                        <!-- <div class="row gy-3">
                            <div class="col-md-6">
                            <label for="cc-name" class="form-label">Name on card</label>
                            <input type="text" class="form-control checkout--input" id="cc-name" placeholder="" required="">
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback">
                                Name on card is required
                            </div>
                            </div>

                            <div class="col-md-6">
                            <label for="cc-number" class="form-label">Credit card number</label>
                            <input type="text" class="form-control checkout--input" id="cc-number" placeholder="" required="">
                            <div class="invalid-feedback">
                                Credit card number is required
                            </div>
                            </div>

                            <div class="col-md-3">
                            <label for="cc-expiration" class="form-label">Expiration</label>
                            <input type="text" class="form-control checkout--input" id="cc-expiration" placeholder="" required="">
                            <div class="invalid-feedback">
                                Expiration date required
                            </div>
                            </div>

                            <div class="col-md-3">
                            <label for="cc-cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control checkout--input" id="cc-cvv" placeholder="" required="">
                            <div class="invalid-feedback">
                                Security code required
                            </div>
                            </div>
                        </div> -->

                        <button class="w-100 mt-4 btn btn-secondary btn--confirm--order bg--color" type="submit">Back To Cart</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- css page--checkout width = var(--max-width) margin auto -->
@endsection