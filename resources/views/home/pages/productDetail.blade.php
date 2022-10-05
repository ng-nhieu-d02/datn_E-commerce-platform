@extends('home.layout.main')
@section('content')
<div class="pages--productDetail">
    <div class="pages--productDetail--container">
        <div class="productDetail--info justify-content-between">
            <div class="col-md-51">
                <div class="slider-for col-md-12">
                    @foreach ($product->images as $images)
                    <div>
                        <div class="box-image background_image_mouser" style=" background: url(<?= asset('assets/images/image_product/' . $images->url) ?>)" onmousemove="zoom(event)">
                            <img src="{{ asset('assets/images/image_product/' . $images->url) }}" alt="">
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
                    </div>
                    @endforeach
                </div>
                <div class="slider-nav pt-3">
                    @foreach ($product->images as $images)
                    <div class="col-md-31">
                        <img src="{{ asset('assets/images/image_product/' . $images->url) }}" alt="">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-61">
                <div class="list--info--product col-md-12">
                    <div class="name">
                        <span>{{ $product->name }}</span>
                    </div>
                    <div class="price--meta d-flex gap-3 align-items-center flex-wrap">
                        <div class="price">
                            <span class="price_detail">{{ number_format($product->price_minmax($product->id)->min_price, 0, ',', '.') }}đ - {{ number_format($product->price_minmax($product->id)->max_price, 0, ',', '.') }}đ</span>
                        </div>
                        <div class="sale--price">
                            <span class="sale_price_detail">{{number_format($product->price_minmax($product->id)->max_price + $product->price_minmax($product->id)->max_sale, 0, ',', '.')}}đ</span>
                            <span class="percent_detail">-{{number_format($product->price_minmax($product->id)->max_sale / ($product->price_minmax($product->id)->min_price / 100), 0)}}%</span>
                        </div>
                        <div class="meta">
                            <a>
                                <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <span>{{ $product->comment()->sum('rate') / $product->comment()->count()}}</span>
                                </div>
                                <div class="review"><span>{{ $product->comment()->count() }} reviews</span></div>
                            </a>
                            <div class="new-in">
                                <span>New in</span>
                            </div>
                        </div>
                    </div>
                    <div class="color">
                        <span>Color: <b style="padding-left: 10px" id="color_value"></b></span>
                        <div class="list-box-color">
                            @foreach ($product->color as $color)
                            <input label="{{ $color->color_value }}" style="color: <?= $color->color_value ?>" type="radio" class="colors" id="color" name="colors" value="{{ $color->color_value }}">
                            @endforeach
                        </div>
                    </div>
                    <div class="size">
                        <span>{{ $product->attributes[0]->attribute }}: <b style="padding-left: 10px" id="attribute_value"></b></span>
                        <div class="list-sizes-item">
                            @foreach ($product->attribute_values as $attribute)
                            <input label="{{ $attribute->attribute_value }}" type="radio" class="attribute" id="attribute" name="attributes" value="{{ $attribute->attribute_value }}">
                            @endforeach
                        </div>
                    </div>
                    <div class="cart">
                        <div class="form-submit-cart align-items-center flex-wrap">
                            <div class="quantity">
                                <span class="tru quantity-function" data-action="minus">-</span>
                                <input type="number" onKeyUp="if(this.value>999){this.value='999';}else if(this.value<1){this.value='1';}" class="input-quantity-function" value="1">
                                <span class="cong quantity-function" data-action="plus">+</span>
                            </div>
                            <button class="btn-submit-add-cart"><i class="fa-sharp fa-solid fa-cart-shopping"></i> Add to cart</button>
                            <p> <span class="quantity_detail">{{$product->detail->sum('quantity') - $product->detail->sum('sold')}}</span>  sản phẩm trong kho</p>
                        </div>
                    </div>
                    <hr>
                    <div class="faqs">
                        <div class="button-faq">
                            <div class="faq-title">
                                <span>Description</span>
                            </div>
                            <div class="faq-body">
                                {{$product->description}}
                            </div>
                        </div>
                        <div class="button-faq">
                            <div class="faq-title">
                                <span>Fabric + Care</span>
                            </div>
                            <div class="faq-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem unde quam ea quidem
                                consequatur provident tempore cumque beatae voluptates hic rerum, repellendus
                                perferendis repudiandae dolore nesciunt necessitatibus tenetur cupiditate quibusdam.
                            </div>
                        </div>
                        <div class="button-faq">
                            <div class="faq-title">
                                <span>How it Fits</span>
                            </div>
                            <div class="faq-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem unde quam ea quidem
                                consequatur provident tempore cumque beatae voluptates hic rerum, repellendus
                                perferendis repudiandae dolore nesciunt necessitatibus tenetur cupiditate quibusdam.
                            </div>
                        </div>
                        <div class="button-faq">
                            <div class="faq-title">
                                <span>FAQ</span>
                            </div>
                            <div class="faq-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem unde quam ea quidem
                                consequatur provident tempore cumque beatae voluptates hic rerum, repellendus
                                perferendis repudiandae dolore nesciunt necessitatibus tenetur cupiditate quibusdam.
                            </div>
                        </div>
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
    </div>
</div>
<div class="page--productDetail--store">
    <div class="img-background" style="background-image: linear-gradient(to left top, rgba(255, 255, 255, 0.219), rgba(90, 245, 224, 0.267)),
    url(<?= asset('upload/store/' . $product->store->background) ?>);">
    </div>
    <div class="stores-container">
        <div class="list-info-stores col-md-12 d-flex">
            <div class="info-store col-md-9 d-flex align-items-center gap-5">
                <div class="image-store">
                    <img src="<?= asset('upload/store/' . $product->store->avatar) ?>" alt="">
                </div>
                <div class="meta-store">
                    <h2>{{ $product->store->name }}</h2>
                    <ul class="address-store d-flex">
                        <li><i class="fas fa-map-marker-alt"></i>{{ $product->store->city }},
                            {{ $product->store->district }}, {{ $product->store->address }}
                        </li>
                        <li><i class="fas fa-clock"></i> Đăng sản phẩm vài giây trước</li>
                    </ul>
                    <div class="star-store">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>

                        <span> {{number_format($product->store->comment()->sum('rate') / $product->store->comment()->count(), 1, '.', ',') }} &nbsp; ({{$product->store->comment()->count()}} reviews)</span>
                    </div>
                </div>
            </div>
            <div class="contact-store col-md-3 align-items-center">
                <div class="form-contact">
                    <a href="">Nhắn tin</a>
                    <a href="">Xem gian hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pages--productDetail">
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
        <x-productDetailReview :comments="$product
                ->comment()
                ->where('parent_id', 0)
                ->paginate(8)" :product="$product">
        </x-productDetailReview>
        <hr class="line">
    </div>
</div>
</div>
<script>
    const detail = JSON.parse('<?= json_encode($product->detail) ?>');
    const type = '{{ $product->type }}';
</script>
@endsection