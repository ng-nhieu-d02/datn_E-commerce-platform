<div class="ingredent--cartBar">
    <div class="ingredent--cartBar--table_cart">
        <div class="ingredent--cartBar--list_cart">
            <!-- <h3 class="list_cart--title">
                Shopping Cart
            </h3> -->
            <div class="list_cart--items list__product__cart__bar">
                @if(Auth::check())
                    @foreach(Auth::user()->cart()->orderBy('id','desc')->get() as $card_product)
                        <x-cardProductCart :data="$card_product"></x-cardProductCart>
                    @endforeach
                @else
                    <p>Giỏ hàng trống</p>
                @endif
            </div>

        </div>
        <div class="list_cart--subtotal">
            <!-- <div class="subtotal">
                <span>Subtotal</span>
                <span>$299.00</span>
            </div>
            <p>Shipping and taxes calculated at checkout.
            </p> -->
            <div class="button--cart">
                <button>View cart</button>
            </div>
        </div>
    </div>
</div>
