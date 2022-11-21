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
                <div class="d-flex info-profile col-md-12 align-items-center">
                    <div class="image-avatar">
                        <img class="rounded-circle img-fluid" src="{{ asset('upload/store/avatars/' . $store->avatar) }}" alt="">
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
                        <li>
                            <a href="">Hoá đơn</a>
                        </li>
                        <li class="@if (request()->routeIs('user.register_booth')) active @endif">
                            <a href="{{ route('user.register_booth') }}">Đăng ký gian hàng</a>
                        </li>
                        <li>
                            <a href="">Quản lí gian hàng</a>
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