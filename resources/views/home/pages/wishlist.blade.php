@extends('home.layout.profile')
@section('content')

<div class="page--home">

    <div class="page--home--product">
        @foreach($product as $prd)
        <x-cardProduct :data="$prd"></x-cardProduct>
        @endforeach
    </div>
    {{$product->links('components.pagination')}}
</div>
@endsection