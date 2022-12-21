@extends('home.layout.store')
@section('content')
<div class="line-title" style="padding-top: 0;">
    <div class="content-title">
        <h2>Sản phẩm</h2>
    </div>
    <div class="page--home--product">
        @foreach($product as $prd)
        <x-cardProduct :data="$prd"></x-cardProduct>
        @endforeach
    </div>
    {{$product->links('components.pagination')}}
</div>
@if($product_sold->count() > 0)
<div class="line-title">
    <div class="content-title">
        <h2>Sản phẩm bán chạy nhất</h2>
    </div>
    <div class="page--home--product">
        @foreach($product_sold as $prd)
        <x-cardProduct :data="$prd"></x-cardProduct>
        @endforeach
    </div>
</div>
@endif
@if($products_view->count() > 0)
<div class="line-title">
    <div class="content-title">
        <h2>Sản phẩm tiêu biểu</h2>
    </div>
    <div class="page--home--product">
        @foreach($products_view as $prd)
        <x-cardProduct :data="$prd"></x-cardProduct>
        @endforeach
    </div>
</div>
@endif

@endsection