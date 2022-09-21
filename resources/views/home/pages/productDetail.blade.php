@extends('home.layout.main')
@section('content')
    <div class="pages--productDetail">
        <div class="pages--productDetail--container">
            <div class="productDetail--info row">
                <div class="col-md-5">
                    <div class="box-image col-md-12">
                        <img src="{{ asset('assets/images/image_product/detail1.f45e3a4d9bfeafd2f70b.jpg') }}" alt="">
                        <div class="icon-heart">
                            <form class="form--heart" action="">
                                <button><i class="fa-regular fa-heart"></i></button>
                            </form>
                        </div>
                        <div class="icon-spakles">
                            <i class="fa-duotone fa-sparkles"></i>
                            <span>New in </span>
                        </div>
                    </div>
                    <div class="box-image-gallery col-md-12">
                        <div class="col-md-3">
                            <img src="{{ asset('assets/images/image_product/detail2.15a523b16c02d0246953.jpg') }}"
                                alt="">
                        </div>
                        <div class="col-md-3">
                            <img src="{{ asset('assets/images/image_product/detail2.15a523b16c02d0246953.jpg') }}"
                                alt="">
                        </div>
                        <div class="col-md-3">
                            <img src="{{ asset('assets/images/image_product/detail2.15a523b16c02d0246953.jpg') }}"
                                alt="">
                        </div>
                        <div class="col-md-3">
                            <img src="{{ asset('assets/images/image_product/detail2.15a523b16c02d0246953.jpg') }}"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 px-5">
                    <div class="list--info--product col-md-12">
                        <div class="name"><span>Heavy Weight Shoes</span></div>
                        <div class="price--meta row">
                            <div class="price col-md-2">
                                <span>$112.00</span>
                            </div>
                            <div class="meta col-md-9">
                                <a href="">
                                    <div class="star">
                                        <i class="fa-solid fa-star"></i>
                                        <span>4.9</span>
                                    </div>
                                    <div class="review"><span>142 reviews</span></div>
                                </a>
                                <div class="new-in">
                                    <span>New in</span>
                                </div>
                            </div>
                        </div>
                        <div class="color">
                            <span>Color: <b>Black</b></span>
                            <div class="list-box-color">
                                <div class="box-color-image active col-md-2">
                                    <img src="{{ asset('assets/images/image_product/download.jfif') }}" alt="">
                                </div>
                                <div class="box-color-image col-md-2">
                                    <img src="{{ asset('assets/images/image_product/download.jfif') }}" alt="">
                                </div>
                                <div class="box-color-image col-md-2">
                                    <img src="{{ asset('assets/images/image_product/download.jfif') }}" alt="">
                                </div>
                                <div class="box-color-image col-md-2">
                                    <img src="{{ asset('assets/images/image_product/download.jfif') }}" alt="">
                                </div>
                                <div class="box-color-image col-md-2">
                                    <img src="{{ asset('assets/images/image_product/download.jfif') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="size">
                            <span>Size: <b>XS</b></span>
                            <div class="list-sizes-item">
                                <div class="item-size active">XS</div>
                                <div class="item-size">S</div>
                                <div class="item-size">M</div>
                                <div class="item-size">L</div>
                                <div class="item-size">XL</div>
                                <div class="item-size">2XL</div>
                                <div class="item-size">3XL</div>
                            </div>
                        </div>
                        <div class="cart">
                            <form action="" class="form-submit-cart">
                                <div class="quantity col-md-2">
                                    <span class="tru">-</span>
                                    <input type="number" value="1">
                                    <span class="cong">+</span>
                                </div>
                                <button><i class="fa-sharp fa-solid fa-cart-shopping"></i> Add to cart</button>
                            </form>
                        </div>
                        <hr>
                        <div class="faqs">
                            <button class="button-faq"><span>Description</span><i class="fa-solid fa-plus"></i></button>
                            <button class="button-faq"><span>Fabric + Care</span><i class="fa-solid fa-plus"></i></button>
                            <button class="button-faq"><span>How it Fits</span><i class="fa-solid fa-plus"></i></button>
                            <button class="button-faq"><span>FAQ</span><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <div class="list-benefit-items col-md-12 d-flex justify-content-between">
                            <div class="benefit-item col-lg-2">
                                <div class="icon-car">
                                    <i class="fa-solid fa-car-side"></i>
                                </div>
                                <div class="text-benefit">
                                    <p>Free Shipping</p>
                                    <p>On orders over $50.00</p>
                                </div>
                            </div>
                            <div class="benefit-item col-lg-2">
                                <div class="icon-car">
                                    <i class="fa-solid fa-car-side"></i>
                                </div>
                                <div class="text-benefit">
                                    <p>Free Shipping</p>
                                    <p>On orders over $50.00</p>
                                </div>
                            </div>
                            <div class="benefit-item col-lg-2">
                                <div class="icon-car">
                                    <i class="fa-solid fa-car-side"></i>
                                </div>
                                <div class="text-benefit">
                                    <p>Free Shipping</p>
                                    <p>On orders over $50.00</p>
                                </div>
                            </div>
                            <div class="benefit-item col-lg-2">
                                <div class="icon-car">
                                    <i class="fa-solid fa-car-side"></i>
                                </div>
                                <div class="text-benefit">
                                    <p>Free Shipping</p>
                                    <p>On orders over $50.00</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="productDetail--text_detail">
                <div class="text_detail">
                    <h2>Product Details</h2>
                    <div class="text">
                        <p>The patented eighteen-inch hardwood Arrowhead deck --- finely mortised in, makes this the
                            strongest and most rigid canoe ever built. You cannot buy a canoe that will afford greater
                            satisfaction.</p>
                        <p>The St. Louis Meramec Canoe Company was founded by Alfred Wickett in 1922. Wickett had previously
                            worked for the Old Town Canoe Co from 1900 to 1914. Manufacturing of the classic wooden canoes
                            in Valley Park, Missouri ceased in 1978.</p>
                        <ul>
                            <li>Regular fit, mid-weight t-shirt</li>
                            <li>Natural color, 100% premium combed organic cotton</li>
                            <li>Quality cotton grown without the use of herbicides or pesticides - GOTS certified</li>
                            <li>Soft touch water based printed in the USA</li>
                        </ul>
                    </div>
                </div>
                <hr class="line">
                <div class="user_review">
                    <h2>
                        <i class="fa-solid fa-star"></i>
                        <span>4,87 · 142 Reviews</span>
                    </h2>
                    <div class="user_review-container">
                        <div class="list-review-items col-md-12 d-flex flex-wrap justify-content-between">
                            <div class="review-item col-md-5 mb-5">
                                <div class="box-info-user d-flex align-items-center">
                                    <div class="box-image-review">
                                        <img src="{{ asset('assets/images/image_product/Image-8.5ae85a64aab1965e33a5.png') }}"
                                            alt="">
                                    </div>
                                    <div class="box-text-meta d-flex justify-content-between align-items-center">
                                        <div class="name_user d-flex flex-column">
                                            <span class="full_name">Cody Fisher</span>
                                            <span>May 20, 2021
                                            </span>
                                        </div>
                                        <div class="review_star">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="text_review">
                                    <p>Very nice feeling sweater. I like it better than a regular hoody because it is
                                        tailored to be a slimmer fit. Perfect for going out when you want to stay comfy. The
                                        head opening is a little tight which makes it a little.</p>
                                </div>
                            </div>
                            <div class="review-item col-md-5">
                                <div class="box-info-user d-flex align-items-center">
                                    <div class="box-image-review">
                                        <img src="{{ asset('assets/images/image_product/Image-8.5ae85a64aab1965e33a5.png') }}"
                                            alt="">
                                    </div>
                                    <div class="box-text-meta d-flex justify-content-between align-items-center">
                                        <div class="name_user d-flex flex-column">
                                            <span class="full_name">Cody Fisher</span>
                                            <span>May 20, 2021
                                            </span>
                                        </div>
                                        <div class="review_star">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="text_review">
                                    <p>Very nice feeling sweater. I like it better than a regular hoody because it is
                                        tailored to be a slimmer fit. Perfect for going out when you want to stay comfy. The
                                        head opening is a little tight which makes it a little.</p>
                                </div>
                            </div>
                            <div class="review-item col-md-5">
                                <div class="box-info-user d-flex align-items-center">
                                    <div class="box-image-review">
                                        <img src="{{ asset('assets/images/image_product/Image-8.5ae85a64aab1965e33a5.png') }}"
                                            alt="">
                                    </div>
                                    <div class="box-text-meta d-flex justify-content-between align-items-center">
                                        <div class="name_user d-flex flex-column">
                                            <span class="full_name">Cody Fisher</span>
                                            <span>May 20, 2021
                                            </span>
                                        </div>
                                        <div class="review_star">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="text_review">
                                    <p>Very nice feeling sweater. I like it better than a regular hoody because it is
                                        tailored to be a slimmer fit. Perfect for going out when you want to stay comfy. The
                                        head opening is a little tight which makes it a little.</p>
                                </div>
                            </div>
                            <div class="review-item col-md-5">
                                <div class="box-info-user d-flex align-items-center">
                                    <div class="box-image-review">
                                        <img src="{{ asset('assets/images/image_product/Image-8.5ae85a64aab1965e33a5.png') }}"
                                            alt="">
                                    </div>
                                    <div class="box-text-meta d-flex justify-content-between align-items-center">
                                        <div class="name_user d-flex flex-column">
                                            <span class="full_name">Cody Fisher</span>
                                            <span>May 20, 2021
                                            </span>
                                        </div>
                                        <div class="review_star">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="text_review">
                                    <p>Very nice feeling sweater. I like it better than a regular hoody because it is
                                        tailored to be a slimmer fit. Perfect for going out when you want to stay comfy. The
                                        head opening is a little tight which makes it a little.</p>
                                </div>
                            </div>
                        </div>
                        <form action="" class="form-show-more">
                            <button class="form-button">Show me all 142 reviews</button>
                        </form>
                    </div>
                </div>
                <hr class="line">
            </div>
        </div>
    </div>
@endsection
