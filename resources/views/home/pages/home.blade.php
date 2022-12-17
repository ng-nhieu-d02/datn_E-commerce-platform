@extends('home.layout.main')

@section('content')

<div class="page--home">

    <div class="banner-voucher">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach($coupons as $key => $coupon)
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}" aria-current="{{$key == 0 ? 'true' : 'false'}}" aria-label="Slide 1"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach($coupons as $coupon)
                <div class="carousel-item active" data-bs-interval="5000">
                    <img src="{{asset('upload/voucher/'.$coupon->avatar)}}" style="width: 100%; height: 300px; object-fit:cover" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block" style="color:white">

                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div style="display: grid;grid-template-rows: 48% 48%; height:300px;align-content: space-between">
            <div class="img" style="width: 100%;height:100%">
                <img src="{{asset('assets/images/voucher-event1.png')}}" style="width: 100%;height:100%; object-fit:cover" alt="...">
            </div>
            <div class="img" style="width: 100%;height:100%">
                <img src="{{asset('assets/images/voucher-event.png')}}" style="width: 100%;height:100%; object-fit:cover" alt="...">
            </div>
        </div>
    </div>
</div>
<div class="line-title">
    <div class="content-title">
        <h2>Mua theo danh mục</h2>
    </div>
    <div class="page--home--category">
        @foreach($categories as $category)
        <div class="category-content">
            <a href="">
                <img src="{{asset('upload/category/'.$category->avatar)}}" alt="">
                <p>{{$category->name}}</p>
            </a>
        </div>
        @endforeach
    </div>
</div>
<div class="line-title">
    <div class="content-title">
        <h2>Sản phẩm bán chạy nhất</h2>
    </div>
    <div class="page--home--product">
        @foreach($products_sold as $prd)
        <x-cardProduct :data="$prd"></x-cardProduct>
        @endforeach
    </div>
</div>

<div class="line-title">
    <div class="content-title">
        <h2>Sản phẩm được quan tâm nhất</h2>
    </div>
    <div class="page--home--product">
        @foreach($products_view as $prd)
        <x-cardProduct :data="$prd"></x-cardProduct>
        @endforeach
    </div>
</div>

@endsection