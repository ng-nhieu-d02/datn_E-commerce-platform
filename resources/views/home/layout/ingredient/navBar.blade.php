<div class="ingredient--navBar">
    <div class="ingredient--navBar--logo">
        <div class="img--logo">
            <a href="{{ route('user.home') }}"><img src="/assets/images/logo.png" alt=""></a>
        </div>
        <div class="word--logo">
            <h2>
                <a href="{{ route('user.home') }}">
                    <span>F</span>
                    <span>F</span>
                    <span>BEES</span>
                </a>
            </h2>
        </div>
    </div>
    <div class="ingredient--navBar--menu">
        <ul class="menu--li">
            <li>
                <a href="">Trang chủ</a>
            </li>
            <li class="@if (request()->routeIs('user.pageSearch')) active @endif">
                <a href="{{route('user.pageSearch')}}">Sản phẩm</a>
            </li>
            <li>
                <a href="{{route('user.cart')}}">Giỏ hàng</a>
            </li>
            <li>
                <a href="">Về chúng tôi</a>
            </li>
            <li>
                <a href="">Liên hệ</a>
            </li>
        </ul>
    </div>
    <div class="ingredient--navBar--action">

        <li>
            <a href="{{route('user.pageSearch')}}">
                <i class="fa fa-magnifying-glass"></i>
            </a>
        </li>
        @if (Auth::check())
        <li class="ingredient--navBar--action--modals">
            <i class="fa-regular fa-bell"></i>
            <span class="tip">0</span>
        </li>
        @endif
        @if (Auth::check())
        <li class="ingredient--navBar--action--modals">
            <a href="{{ route('user.profile') }}">
                <i class="fa-regular fa-user"></i>
                <span class="tip">2</span>
            </a>
        </li>
        @else
        <a href="{{ route('login') }}">
            <li class="ingredient--navBar--action--modals">
                <i class="fa-regular fa-user"></i>
            </li>
        </a>
        @endif
        <li class="ingredient--navBar--action--modals">
            <i class="fa fa-cart-shopping" id="toggle-modals" data-modals="shopping-cart"></i>
            @if(Auth::check())
            <span class="tip tip__cartBar">{{Auth::user()->cart()->count()}}</span>
            @endif
            <div class="div--modals div--shopping-cart">
                @include('home.layout.ingredient.cartBar')
            </div>

        </li>

    </div>

</div>