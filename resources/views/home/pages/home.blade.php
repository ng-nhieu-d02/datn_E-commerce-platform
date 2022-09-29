@extends('home.layout.main')

@section('content')

<div class="page--home">

    <div class="page--home--product">
        @foreach($product as $prd)
            <x-cardProduct :data="$prd"></x-cardProduct>
        @endforeach
    </div>

</div>

@endsection