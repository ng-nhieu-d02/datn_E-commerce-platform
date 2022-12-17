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
                        <img class="img-fluid" src="{{ asset('upload/store/backgrounds/' . $store->background) }}" alt="">
                    </div>
                </div>
                <div class="info-profile col-md-12 align-items-center">
                    <div class="image-avatar">
                        <img class="rounded-circle img-fluid" style="width: 100%;" src="{{ asset('upload/store/avatars/' . $store->avatar) }}" alt="">
                    </div>
                    <div class="name-profile" style="flex-grow: 1;">
                        <h2 class="name-profile-h2">{{$store->name}}</h2>
                        <span class="fs-2" style="opacity: 0.8;"><b class="text-danger">{{$store->slogan}}</b></span>
                        <!-- <sup>đ</sup> -->
                    </div>
                    <div style="padding-top:20px; display:flex;align-items: center; gap:20px">
                        <div>
                            <i style="color: #eab308;text-shadow: rgb(255 196 0) 1px 0 5px;" class="fa-solid fa-star"></i>
                            <i style="color: #eab308;text-shadow: rgb(255 196 0) 1px 0 5px;" class="fa-solid fa-star"></i>
                            <i style="color: #eab308;text-shadow: rgb(255 196 0) 1px 0 5px;" class="fa-solid fa-star"></i>
                            <i style="color: #eab308;text-shadow: rgb(255 196 0) 1px 0 5px;" class="fa-solid fa-star"></i>
                            <i style="color: #eab308;text-shadow: rgb(255 196 0) 1px 0 5px;" class="fa-solid fa-star"></i>
                        </div>
                        <p style="margin: 0;">@if($store->comment()->count() > 0)
                            {{ number_format($store->comment()->sum('rate') / $store->comment()->count(), 1, '.', ',') }}
                            @endif
                            &nbsp; ({{$store->comment()->count()}} reviews)
                        </p>
                        <button style="border:none; background-color:#0000003d; padding: 10px 20px;border-radius: 5px; cursor:pointer">Nhắn tin</button>
                    </div>
                </div>
                <div class="menu-profile">
                    <ul>
                        <li class="@if (request()->routeIs('user.store', [$store->id])) active @endif">
                            <a href="{{ route('user.store', [$store->id]) }}">Trang chủ</a>
                        </li>

                        @if($permission == 0)
                        <li>
                            <a href="">Thông tin shop</a>
                        </li>
                        <li>
                            <a href="">Đánh giá shop</a>
                        </li>
                    </ul>
                    @elseif($permission == 1)

                    <li class="@if (request()->routeIs('user.dashboard_store', [$store->id])) active @endif">
                        <a href="{{ route('user.dashboard_store', [$store->id]) }}">Dashboard</a>
                    </li>
                    <li class="@if (request()->routeIs('user.product_store', [$store->id])) active @endif">
                        <a href="{{ route('user.product_store', [$store->id]) }}">Đăng sản phẩm</a>
                    </li>
                    <li class="@if (request()->routeIs('user.store_edit', [$store->id])) active @endif">
                        <a href="{{ route('user.store_edit', [$store->id]) }}">Chỉnh sửa thông tin shop</a>
                    </li>
                    <li class="@if (request()->routeIs('user.order_store', [$store->id])) active @endif">
                        <a href="{{ route('user.order_store', [$store->id]) }} }}">Quản lí hoá đơn</a>
                    </li>
                    <li>
                        <a href="">Đánh giá shop</a>
                    </li>
                    <li class="@if (request()->routeIs('user.voucher_store', [$store->id])) active @endif">
                        <a href="{{ route('user.voucher_store', [$store->id]) }} }}">Voucher</a>
                    </li>
                    <li class="@if (request()->routeIs('user.payment_store', [$store->id])) active @endif">
                        <a href="{{ route('user.payment_store', [$store->id]) }} }}">Nạp rút tiền</a>
                    </li>

                    </ul>
                    @endif
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