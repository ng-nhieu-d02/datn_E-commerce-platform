@extends('home.layout.main')

@section('content')

    <div class="page--checkout">
        <div class="container ">
            <main>
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 order-md-last">
                        <h2>Order summary</h2>
                        <form class="card p-2 bg--none border--none">
                            <label class="form-check-label" for="discount-code">Discount Code</label>
                            <div class="input-group">
                                <input type="text" class="form-control discode--input rounded--1r" id="discount-code" placeholder="Discount Code">
                                <button type="submit" class="btn btn-secondary rounded--1r ml--10 btn--apply">Apply</button>
                            </div>
                        </form>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-sm border--none bg--none">
                                <div>
                                <h6 class="my-0">Product name</h6>
                                <small class="text-muted">Subtotal</small>
                                </div>
                                <span class="text-muted">$249.00</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-sm border--none bg--none">
                                <div>
                                <h6 class="my-0">Shipping estimate</h6>
                                <small class="text-muted">Brief description</small>
                                </div>
                                <span class="text-muted">$5.00</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-sm border--none bg--none">
                                <div>
                                <h6 class="my-0">Tax estimate</h6>
                                <small class="text-muted">Brief description</small>
                                </div>
                                <span class="text-muted">$24.90</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between border--none bg--none">
                                <span class="text--order--total">Order total</span>
                                <strong>$276.00</strong>
                            </li>
                        </ul>
                        
                        <div class="row p-4">
                            <button type="submit" class="btn btn-secondary btn--confirm--order bg--color" onclick="ToastSuccess()">Confirm Order</button>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <h2>Billing address</h2>
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
                                <select class="form-select checkout--select rounded--1r fs--12" id="country" required="">
                                    <option class="fs--12" value="">Choose...</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid Tỉnh / Thành Phố.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="state" class="form-label">Quận / Huyện</label>
                                <select class="form-select checkout--select rounded--1r fs--12" id="state" required="">
                                <option class="fs--12" value="">Choose...</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid Quận / Huyện.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="state" class="form-label">Phường / Xã</label>
                                <select class="form-select checkout--select rounded--1r fs--12" id="state" required="">
                                <option class="fs--12" value="">Choose...</option>
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
                                <img src="{{ url('assets/images/icons/vnpay.png') }}" class="icon--card">
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

                        <button class="w-100 btn btn-secondary btn--confirm--order bg--color" type="submit">Back To Cart</button>
                        </form>
                    </div>
                </div>
            </main>
            <!-- success -->
            <div id="toast">
            </div>
        </div>
    </div>
    <!-- css page--checkout width = var(--max-width) margin auto -->
@endsection