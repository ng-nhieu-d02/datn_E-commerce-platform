@props(['data'])
<div class="component--cardProductCart cardProductCartDetail {{$data->detail->id}} {{$data->detail->quantity <= $data->detail->sold ? 'disable' : ''}}" data-warring="Sản phẩm này hiện đã hết hàng">
    <div class="component--cardProductCart--content center">
        <input type="checkbox" data-id="{{$data->id}}" class="required_checkbox" value="{{$data->id}}" required {{$data->detail->quantity <= $data->detail->sold ? 'disabled' : ''}}>
    </div>
    <div class="component--cardProductCart--content">
        <a href="{{route('user.productDetail', ['slug' => $data->product->slug])}}" class="images-content">
            <img class="image-product" src="<?= asset('upload/product/' . $data->id_store . '/album/' . $data->detail->url_image) ?>" alt="">
        </a>
    </div>
    <div class="component--cardProductCart--content">
        <a href="{{route('user.productDetail', ['slug' => $data->product->slug])}}" class="link-content">
            <p style="    max-width: 250px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;">{{$data->product->name}}</p>
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
    <div class="component--cardProductCart--content center">
        <div class="quantity">
            <span class="tru quantity-function-update" data-action="minus" data-id="{{$data->id}}">-</span>
            <input type="number" onKeyUp="if(this.value>999){this.value='999';}else if(this.value<1){this.value='1';}" class="input-quantity-function_{{$data->id}}" value="{{$data->quantity}}">
            <input type="hidden" class="quantity_detail_{{$data->id}}" value="{{$data->detail->quantity - $data->detail->sold}}">
            <span class="cong quantity-function-update" data-action="plus" data-id="{{$data->id}}">+</span>
        </div>
    </div>
    <div class="component--cardProductCart--content center price">
        <p class="mb-0">{{number_format($data->detail->price,0,',','.')}}đ</p>
    </div>
    <div class="component--cardProductCart--content center remove">
        <button data-id="{{$data->id}}" class="remove__item__cart">Remove</button>
    </div>
</div>