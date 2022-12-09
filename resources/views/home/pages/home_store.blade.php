@extends('home.layout.store')
@section('content')
<div class="page--home--product">
    @foreach($product as $prd)
    <x-cardProduct :data="$prd"></x-cardProduct>
    @endforeach
</div>
@endsection