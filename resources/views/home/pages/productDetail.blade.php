@extends('home.layout.main')
@section('content')
<div class="pages--productDetail">
    <div class="pages--productDetail--container">
        <div class="productDetail--info justify-content-between">
            <div class="col-md-51">
                <div class="slider-for col-md-12">
                    @foreach ($product->images as $images)
                    <div>
                        <div class="box-image background_image_mouser" style=" background: url(<?= asset('upload/product/' . $product->id_store . '/album/' . $images->url) ?>)" onmousemove="zoom(event)">
                            <img src="{{ asset('upload/product/'.$product->id_store.'/album/' . $images->url) }}" alt="">
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
                        <img src="{{ asset('upload/product/'.$product->id_store.'/album/' . $images->url) }}" alt="">
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
                            <span class="price_detail">
                                @if($product->price_minmax($product->id)->min_price < $product->price_minmax($product->id)->max_price)
                                    {{ number_format($product->price_minmax($product->id)->min_price, 0, ',', '.') }}đ - {{ number_format($product->price_minmax($product->id)->max_price, 0, ',', '.') }}đ
                                    @else
                                    {{ number_format($product->price_minmax($product->id)->min_price, 0, ',', '.') }}đ
                                    @endif
                            </span>
                        </div>
                        <div class="sale--price">
                            <span class="sale_price_detail">{{number_format($product->price_minmax($product->id)->max_price + $product->price_minmax($product->id)->max_sale, 0, ',', '.')}}đ</span>
                            <span class="percent_detail">-{{number_format($product->price_minmax($product->id)->max_sale / ($product->price_minmax($product->id)->min_price / 100), 0)}}%</span>
                        </div>
                        <div class="meta">
                            <a>
                                <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <span>
                                        @if($product->comment()->count() > 0)

                                        {{ number_format($product->comment()->sum('rate') / $product->comment()->count() , 2, '.', ',')}}</span>
                                    @endif
                                </div>
                                <div class="review"><span>
                                        @if ($product->comment()->count() > 0)
                                        {{ $product->comment()->count() }}
                                        reviews

                                        @else
                                        Chưa có nhận xét nào
                                        @endif
                                    </span></div>
                            </a>
                            <div class="new-in">
                                <span>New in</span>
                            </div>
                        </div>
                    </div>
                    @if($product->type != 2)
                    <div class="color">
                        <span>Color: <b style="padding-left: 10px" id="color_value"></b></span>
                        <div class="list-box-color">
                            @foreach ($product->color as $color)
                            <input label="{{ $color->color_value }}" style="color: <?= $color->color_value ?>" type="radio" class="colors" id="color" name="colors" value="{{ $color->color_value }}">
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if($product->type != 1)
                    <div class="size">
                        <span>{{ $product->attributes[0]->attribute }}: <b style="padding-left: 10px" id="attribute_value"></b></span>
                        <div class="list-sizes-item">
                            @foreach ($product->attribute_values as $attribute)

                            <div>
                                <input type="radio" id="attribute_{{ $attribute->attribute_value }}" name="attributes" class="attribute" value="{{ $attribute->attribute_value }}">
                                <label for="attribute_{{ $attribute->attribute_value }}">{{ $attribute->attribute_value }}</label>
                            </div>

                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="cart" style="margin-top:20px">
                        <div class="form-submit-cart align-items-center flex-wrap">
                            <div class="quantity">
                                <span class="tru quantity-function" data-action="minus">-</span>
                                <input type="number" onKeyUp="if(this.value>999){this.value='999';}else if(this.value<1){this.value='1';}" class="input-quantity-function" value="1">
                                <span class="cong quantity-function" data-action="plus">+</span>
                            </div>
                            <button class="btn-submit-add-cart" data-status="{{$product->store->status == 1 ? 'true' : ''}}"><i class="fa-sharp fa-solid fa-cart-shopping"></i> Add to cart</button>
                            <p style="word-wrap: normal;"> <span class="quantity_detail">{{$product->detail->sum('quantity') - $product->detail->sum('sold')}}</span> sản phẩm trong kho</p>
                        </div>
                    </div>
                    <hr>
                    <div class="faqs">
                        <div class="button-faq">
                            <div class="faq-title">
                                <span>Description</span>
                            </div>
                            <div class="faq-body">
                                {!!$product->description!!}
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
                    <div class="list-benefit-items col-md-12 justify-content-between div-benefit-detail">
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
    url(<?= asset('upload/store/backgrounds/' . $product->store->background) ?>);">
    </div>
    <div class="stores-container">
        <div class="list-info-stores col-md-12 d-flex">
            <div class="info-store col-md-9 d-flex align-items-center gap-5">
                <div class="image-store">
                    <img src="{{ asset('upload/store/avatars/' . $product->store->avatar) }}" alt="">
                </div>
                <div class="meta-store">
                    <h2><a href="{{route('user.store', [$product->store->id])}}" style="color:var(--text-default-color);text-decoration: none;"> {{ $product->store->name }} </a></h2>
                    <ul class="address-store d-flex" style="flex-wrap: wrap; gap: 10px; justify-content: center">
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

                        <span>
                            @if($product->store->comment()->count() > 0)
                            {{ number_format($product->store->comment()->sum('rate') / $product->store->comment()->count(), 1, '.', ',') }}
                            @endif
                            &nbsp; @if ($product->store->comment()->count() > 0)
                            ({{$product->store->comment()->count()}} reviews)
                            @else
                            Chưa có nhận xét nào
                            @endif</span>
                    </div>
                </div>
            </div>
            <div class="contact-store col-md-3 align-items-center">
                <div class="form-contact">
                    <a href="{{route('user.chat', $product->store->id)}}">Nhắn tin</a>
                    <a href="{{route('user.store', [$product->store->id])}}">Xem gian hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .productDetail--text_detail {
        width: 100%;
    }

    .productDetail--text_detail .text_detail .text p {
        text-align: left;
    }

    .productDetail--text_detail .text_detail .text p img {
        width: 50%;
    }
</style>
<div class="pages--productDetail">
    <div class="productDetail--text_detail">
        <div class="text_detail">
            <h2>Product Details</h2>
            <div class="text">
                {!!$product->long_description!!}
            </div>
        </div>
        <hr class="line">
        <x-productDetailReview :comments="$product
                ->comment()
                ->where('parent_id', 0)
                ->orderBy('id', 'DESC')
                ->paginate(8)" :product="$product">
        </x-productDetailReview>
        <hr class="line">
    </div>
</div>
<div class="line-title">
    <div class="content-title">
        <h2>Sản phẩm tương tự</h2>
    </div>
    <div class="page--home--product">
        @foreach($product_related as $prd_related)
        <x-cardProduct :data="$prd_related"></x-cardProduct>
        @endforeach
    </div>
</div>
</div>
<script>
    const detail = JSON.parse('<?= json_encode($product->detail) ?>');
    const type = '{{ $product->type }}';
</script>
@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        const url__submit = '{{route("user.update_view", $product->id)}}';

        const myTimeout = setTimeout(() => {
            update_view(url__submit)
        }, 60000);


        function update_view(url__submit) {
            $.ajax({
                url: url__submit,
                type: 'GET',
            });
        }
    });
    // click attribute
    $(document).ready(function() {

        let first = false;
        let data_detail = [];

        function changeDetail(data_detail) {
            if (first == true) {
                $('.slider-for').slick('slickRemove', 0);
            }
            $('.price_detail').html(new Intl.NumberFormat(['ban', 'id']).format(data_detail[0].price) + 'đ');
            $('.sale_price_detail').html(new Intl.NumberFormat(['ban', 'id']).format(Number(data_detail[0].price) +
                Number(data_detail[0].sale)) + 'đ');
            $('.percent_detail').html('-' + new Intl.NumberFormat(['ban', 'id']).format((data_detail[0].sale / (
                data_detail[0].price / 100)).toFixed(0)) + '%');
            $('.quantity_detail').html(new Intl.NumberFormat(['ban', 'id']).format(data_detail[0].quantity -
                data_detail[0].sold));
            const element =
                `<div>
                <div class="box-image" style="background: linear-gradient(180deg, rgba(231, 231, 236, 0.3), rgba(109, 225, 230, 0.2)), url('<?= asset('upload/product/' . $product->id_store . '/album/') ?>/` +
                data_detail[0].url_image + `') no-repeat" onmousemove="zoom(event)">
                    <img src="<?= asset('upload/product/' . $product->id_store . '/album/') ?>/` + data_detail[0].url_image + `" alt="">
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
            </div>`;
            $('.slider-for').slick('slickAdd', element, 0, true).slick('slickGoTo', 0, true);
            if (first == false) {
                first = true;
            }
        }

        $('.attribute').click(function(e) {
            $('#attribute_value').html($(this).val());
            if (type == 0) {
                const radio = document.querySelector('input[name="colors"]:checked');
                if (radio) {
                    const color = radio.value;

                    data_detail = detail.filter(({
                        attribute_value,
                        color_value
                    }) => attribute_value == $(this).val() && color_value == color);
                    changeDetail(data_detail);
                }
            } else {
                data_detail = detail.filter(({
                    attribute_value
                }) => attribute_value == $(this).val());
                changeDetail(data_detail);
            }
        });
        $('.colors').click(function(e) {
            $('#color_value').html($(this).val());
            if (type == 0) {
                const radio = document.querySelector('input[name="attributes"]:checked');
                if (radio) {
                    const attribute = radio.value;
                    data_detail = detail.filter(({
                        attribute_value,
                        color_value
                    }) => attribute_value == attribute && color_value == $(this).val());
                    changeDetail(data_detail);
                }
            } else {
                data_detail = detail.filter(({
                    color_value
                }) => color_value == $(this).val());
                changeDetail(data_detail);
            }
        });
        $('.quantity-function').click(function(e) {
            const action = $(this).attr('data-action');
            let input = $('.input-quantity-function').val();
            if (action == 'plus') {
                $('.input-quantity-function').val(Number(input) + 1);
            } else {
                if (input == 1) {
                    return;
                }
                $('.input-quantity-function').val(Number(input) - 1);
            }
        });
        $('.btn-submit-add-cart').click(function(e) {
            let _storeCartUrl = "{{ route('user.store_cart') }}";
            let _csrf = '{{ csrf_token() }}';
            let quantity = $('.input-quantity-function').val();
            let isLogin = '{{ Auth::check() }}';
            let urlLogin = "{{ route('login') }}";
            e.preventDefault();

            const status = $(this).attr('data-status');
            if (!status) {
                return Swal.fire(
                    'Lỗi',
                    'Không thể thực hiện thao tác này ! <br> Cửa hàng này đang bị khoá',
                    'error'
                );
            }

            if (!isLogin) {
                return window.location = urlLogin;
            }

            if (data_detail.length == 1) {
                $.ajax({
                    url: _storeCartUrl,
                    type: 'POST',
                    data: {
                        'detail': data_detail[0].id,
                        'quantity': quantity,
                        _token: _csrf
                    },
                    success: function(res) {
                        const response = JSON.parse(res);
                        if (response.status == 200) {
                            Swal.fire(
                                'Thành công',
                                'Đã cập nhật sản phẩm trong giỏ hàng',
                                'success'
                            );
                            $(`.quantity__change__for_update_${response.data.id}`).html(
                                response.data.quantity);
                        } else if (response.status == 201) {
                            Swal.fire(
                                'Thành công',
                                'Đã cập nhật sản phẩm trong giỏ hàng',
                                'success'
                            )
                            $('.tip__cartBar').text(Number($('.tip__cartBar').text()) + 1);
                            $('.list__product__cart__bar').prepend(`
                        <div class="component--cardProductCart">
                            <div class="component--cardProductCart--content">
                                <a href="/product/${response.data.product.slug}" class="images-content">
                                    <img class="image-product" src="<?= asset('upload/product') ?>/${response.data.product.id_store}/album/${response.data.detail.url_image}" alt="">
                                </a>
                            </div>
                            <div class="component--cardProductCart--content">
                                <a href="/product/${response.data.product.slug}" class="link-content">
                                    <p style="max-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;">${response.data.product.name}</p>
                                    <div>
                                        <p>Color: <ion-icon name="color-palette-outline"></ion-icon> <span class="color" style="color: ${response.data.detail.color_value}"></span></p>
                                        <p>${response.data.detail.attribute}: <span>${response.data.detail.attribute_value}</span></p>
                                    </div>
                                </a>
                            </div>
                            <div class="component--cardProductCart--content price">
                                <p>${new Intl.NumberFormat(['ban', 'id']).format(response.data.detail.price)}đ</p>
                                <p>Qty: <span class="quantity__change__for_update_${response.data.id}">${response.data.quantity}</span></p>
                            </div>
                        </div>`);
                        } else {
                            Swal.fire(
                                'Thất bại',
                                'Số lượng sản phẩm không đủ.<br> Vui lòng kiếm tra lại.',
                                'error'
                            )
                        }
                    }
                });
            } else {
                Swal.fire(
                    'Thất bại',
                    'Vui lòng chọn loại sản phẩm',
                    'error'
                )
            }
        });
    })
</script>

@endsection