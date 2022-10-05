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
                <a href="">Store</a>
            </li>
            <li>
                <a href="">Component</a>
            </li>
            <li>
                <a href="{{route('user.cart')}}">Cart</a>
            </li>
            <li>
                <a href="">Privacy Policy</a>
            </li>
            <li>
                <a href="">About</a>
            </li>
            <li>
                <a href="">Contact</a>
            </li>
        </ul>
    </div>
    <div class="ingredient--navBar--action">

        <li>
            <i class="fa fa-magnifying-glass"></i>
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
                    <!-- Authentication -->
                    <!-- @if (Auth::check())
<form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button>Đăng xuất</button>
                </form>
@endif -->
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
