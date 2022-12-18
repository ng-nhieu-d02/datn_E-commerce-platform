<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.layout.ingredient.head')
</head>

<body class="dark-mode1">
    <div class="container--layout">
        <div class="container--navBar">
            @include('home.layout.ingredient.navBar')

        </div>

        <div class="container--content">
            <!-- Content -->
            <div class="pages--profile">
                <div class="background-container col-md-12">
                    <div class="image-cover">
                        <img class="img-fluid" src="{{ asset('upload\profile\background/' . Auth::user()->background) }}" alt="">
                    </div>
                </div>
                <div class="d-flex info-profile col-md-12 align-items-center">
                    <div class="image-avatar">
                        <img class="rounded-circle img-fluid" style="width:100%; height: 100%; object-fit:cover"
                            src="{{ asset('upload/profile/avatar/' . Auth::user()->avatar) }}"
                            alt="">
                    </div>
                    <div class="name-profile" style="flex-grow: 1;">
                        <h2 class="name-profile-h2">{{Auth::user()->name}}</h2>
                        <span class="fs-2" style="opacity: 0.8;">Số dư: <b class="text-danger">{{number_format(Auth::user()->money,0,',','.')}}</b></span>
                        <sup>đ</sup>
                    </div>
                    <div style="padding-top:20px">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" style="border:none; background-color:#0000003d; padding: 10px 20px;border-radius: 5px; cursor:pointer">Đăng xuất</button>
                        </form>
                    </div>
                </div>
                <div class="menu-profile">
                    <ul>
                        <li class="@if (request()->routeIs('user.profile')) active @endif">
                            <a href="{{ route('user.profile') }}">Cập nhật thông tin</a>
                        </li>
                        <li class="@if (request()->routeIs('user.wishlist')) active @endif">
                            <a href="{{route('user.wishlist')}}">Ưu thích</a>
                        </li>
                        <li class="@if (request()->routeIs('user.manage-order')) active @endif @if (request()->routeIs('user.manager-orderDetail')) active @endif">
                            <a href="{{ route('user.manage-order') }}">Hoá đơn</a>
                        </li>
                        @if(Auth::user()->permission_store()->count() == 0)
                        <li class="@if (request()->routeIs('user.register_booth')) active @endif">
                            <a href="{{ route('user.register_booth') }}">Đăng ký gian hàng</a>
                        </li>
                        @else 
                        <li class="@if (request()->routeIs('user.register_booth')) active @endif">
                            <a href="{{ route('user.store', [Auth::user()->permission_store[0]->id_store]) }}">Quản lí gian hàng</a>
                        </li>
                        @endif
                        <li class="@if (request()->routeIs('user.payment_user')) active @endif">
                            <a href="{{route('user.payment_user')}}">Nạp tiền</a>
                        </li>
                        <li class="@if (request()->routeIs('user.address')) active @endif">
                            <a href="{{ route('user.address') }}">Địa chỉ giao hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-profile">
                @yield('content')
            </div>
            <!-- End Content -->
        </div>

        <div class="container--footer">
            @include('home.layout.ingredient.footer')
        </div>
    </div>

    @include('home.layout.ingredient.errorFunction')
    @include('home.layout.ingredient.scripts')
</body>

</html>
