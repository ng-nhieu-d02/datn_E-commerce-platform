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
                        <img class="img-fluid" src="{{ asset('assets/images/profile/cover/cover.jpg') }}" alt="">
                    </div>
                </div>
                <div class="d-flex info-profile col-md-12 align-items-center">
                    <div class="image-avatar">
                        <img class="rounded-circle img-fluid" src="{{ auth()->user()->avatar != 'avatar-default.png' ? asset('/storage/' . auth()->user()->avatar) : asset('assets/images/avatar-default.png') }}" alt="">
                    </div>
                    <div class="name-profile">
                        <h2 class="name-profile-h2">Le Duong Bao Lam</h2>
                        <span class="fs-2" style="opacity: 0.8;">Số dư: <b class="text-danger">1.000.000</b></span> <sup>đ</sup>
                    </div>
                </div>
                <div class="menu-profile">
                    <ul>
                        <li class="active">
                            <a href="">Cập nhật thông tin</a>
                        </li>
                        <li>
                            <a href="">Ưu thích</a>
                        </li>
                        <li>
                            <a href="">Hoá đơn</a>
                        </li>
                        <li>
                            <a href="">Đăng ký gian hàng</a>
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