@props(['data'])
<div class="component--cardProduct">
    <div class="component--cardProduct--img">
        <a href="{{route('user.productDetail', ['slug' => $data->slug])}}">
            <img class="image-product" src="<?= asset('upload/product/'. $data->thumb) ?>" alt="">
        </a>
        <i class="fa-regular fa-heart" data-id="{{$data->id}}"></i>
    </div>
    <div class="component--cardProduct--content">
        <a href="{{route('user.productDetail', ['slug' => $data->slug])}}">
            <p class="title"> {{$data->name}} </p>
            <p class="der"> {{$data->description}} </p>
            <div class="d-flex justify-content-between div--content">
                <div class="left">
                    <i class="fa-solid fa-star"></i>
                    <span> {{$data->comment()->sum('rate') / $data->comment()->count()}} ({{$data->comment()->count()}})</span>
                </div>
                <p class="m-0">Đã bán {{number_format($data->detail->sum('sold'),0,',','.')}}</p>
            </div>
            <p class="price"><span>{{number_format($data->price_minmax($data->id)->min_price, 0, ',', '.')}}đ</span> <span>-{{number_format($data->price_minmax($data->id)->max_sale / ($data->price_minmax($data->id)->min_price / 100), 0)}}%</span></p>
        </a>
    </div>
</div>