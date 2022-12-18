@extends('home.layout.store')
@section("content")
<div class="d-flex flex-wrap">
    <div class="col-md-12 mb-5">
        <h1 class="text-uppercase">Thông tin Shop</h1>
    </div>
    <div class="col-md-9">
        <div class="row mb-3">
            <div class="col-md-3">
                <i class="fa-solid fa-user-check"></i>
                <span>Tham gia 15 ngày</span>
            </div>
            <div class="col-md-3">
                <i class="fa-solid fa-house"></i>
                <span>Có {{ $store->product->count() }} sản phẩm</span>
            </div>
            <div class="col-md-3">
                <i class="fa-regular fa-star"></i>
                <span>4.4 (98K Đánh giá)</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <span>Chuyên về: </span>
                @foreach ($store->store_cate as $storeCate)
                <span>{{ $storeCate->name }}</span>
                @endforeach
            </div>
            <div class="col-md-12">
                <span>Địa chỉ: </span>
            </div>
            <div class="col-md-12">
                <span>Với tiêu chí: </span>
            </div>
        </div>
    </div>
    <div class="col-md-3">2</div>
</div>
@endsection