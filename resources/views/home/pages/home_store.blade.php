@extends('home.layout.store')
@section('content')
@if ($checkPermissionStore)
    
<div class="col-lg-12 d-flex mb-4">
    <a href="{{ route("user.create-product-store", $checkPermissionStore->id_store) }}" class="btn btn-primary fs-4 d-inline">Thêm sản phẩm</a>
</div>
@endif
<div class="page--home--product">
    
    @if (!is_null($store))
        @forelse($store->product as $prd)
        <x-cardProduct :data="$prd"></x-cardProduct>

        @empty

        Chưa có sản phẩm nào
        
        @endforelse
    @else
        Bạn chưa đăng ký gian hàng của mình.
    @endif
    
</div>
@endsection