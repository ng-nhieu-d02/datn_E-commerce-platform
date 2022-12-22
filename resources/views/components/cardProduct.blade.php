@props(['data'])
@props(['top'])
<div class="component--cardProduct {{isset($top) ? $top : 'none'}} top_{{$data->id}}">
    <div class="component--cardProduct--img">
        <a href="{{route('user.productDetail', ['slug' => $data->slug])}}">
            <img class="image-product" src="<?= asset('upload/product/' . $data->thumb) ?>" alt="">
        </a>
        <i class="fa-regular fa-heart btn-add-wishlist {{!Auth::check() ? 'true' : (Auth::user()->wishlist($data->id) == 1 ? 'wishlist__add' : '')}}" data-id="{{$data->id}}"></i>
    </div>
    <div class="component--cardProduct--content">
        <a href="{{route('user.productDetail', ['slug' => $data->slug])}}">
            <p class="title"> {{$data->name}} </p>
            <p class="der"> {{$data->description}} </p>
            <div class="d-flex justify-content-between div--content">
                <div class="left">
                    <i class="fa-solid fa-star"></i>
                    <span>
                        @if($data->comment()->exists())
                        {{number_format($data->comment()->sum('rate') / $data->comment()->count(), 2,',', '.',)}} ({{$data->comment()->count()}})
                        @else
                        0 (0)
                        @endif

                    </span>
                </div>
                <p class="m-0">Đã bán {{number_format($data->detail->sum('sold'),0,',','.')}}</p>
            </div>
            <p class="price"><span>{{number_format($data->price_minmax($data->id)->min_price, 0, ',', '.')}}đ</span> 
            @if($data->price_minmax($data->id)->min_price == 0)
            <span>0%</span>
            @else
            <span>-{{number_format($data->price_minmax($data->id)->max_sale / ($data->price_minmax($data->id)->min_price / 100), 0)}}%</span>
            @endif
        </p>
        </a>
    </div>
</div>