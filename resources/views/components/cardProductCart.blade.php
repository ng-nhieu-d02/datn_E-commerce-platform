@props(['data'])
<div class="component--cardProductCart">
    <div class="component--cardProductCart--content">
        <a href="{{route('user.productDetail', ['slug' => $data->product->slug])}}" class="images-content">
            <img class="image-product" src="<?= asset('upload/product/'.$data->detail->url_image) ?>" alt="">
        </a>
    </div>
    <div class="component--cardProductCart--content">
        <a href="{{route('user.productDetail', ['slug' => $data->product->slug])}}" class="link-content">
            <p>{{$data->product->name}}</p>
            <div>
                @if ($data->product->type == 0)
                <p>Color: <ion-icon name="color-palette-outline"></ion-icon> <span class="color" style="color: <?= $data->detail->color_value ?>"></span></p>
                <p>{{$data->detail->attribute}}: <span>{{$data->detail->attribute_value}}</span></p>
                @elseif ($data->product->type == 1)
                <p>Color: <ion-icon name="color-palette-outline"></ion-icon> <span class="color" style="color: <?= $data->detail->color_value ?>"></span></p>
                @else 
                <p>{{$data->detail->attribute}}: <span>{{$data->detail->attribute_value}}</span></p>
                @endif
            </div>
        </a>
    </div>
    <div class="component--cardProductCart--content">
        <p>{{number_format($data->detail->price,0,',','.')}}đ</p>
        <p>Quantity: <span class="quantity__change__for_update_{{$data->id}}">{{$data->quantity}}</span></p>
    </div>
</div>