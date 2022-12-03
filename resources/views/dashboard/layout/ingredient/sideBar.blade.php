<div class="sideBar">
    <div class="sideBar--header">
        <!-- <div class="sideBar--header--logo">
            <img src="/assets/images/dashboard-favicon.png" alt="">
        </div> -->
        <div class="sideBar--header--title">
            <a href="#">Dashboard PRO V1</a>
        </div>
        <!-- <div class="sideBar--header--logo">
            <img src="/assets/images/dashboard-favicon.png" alt="">
        </div> -->
    </div>
    <div class="sideBar--content">
        <div class="sideBar--menu">
            <a href="{{route('admin.dashboard')}}">
                <div class="sideBar--menu--content dashboard @if (request()->routeIs('admin.dashboard')) active @endif">
                    <div class="sideBar--menu--content--icon">
                        <i class="fa fa-tv"></i>
                    </div>
                    <div class="sideBar--menu--content--title">
                        <p>Dashboard</p>
                    </div>
                </div>
            </a>

            <a href="{{route('admin.category')}}">
                <div class="sideBar--menu--content profile @if (request()->routeIs('admin.category')) active @endif">
                    <div class="sideBar--menu--content--icon">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </div>
                    <div class="sideBar--menu--content--title">
                        <p>Category</p>
                    </div>
                </div>
            </a>

            <a href="{{route('admin.voucher')}}">
                <div class="sideBar--menu--content table @if (request()->routeIs('admin.voucher')) active @endif">
                    <div class="sideBar--menu--content--icon">
                        <i class="fa fa-table"></i>
                    </div>
                    <div class="sideBar--menu--content--title">
                        <p>Voucher</p>
                    </div>
                </div>
            </a>
            <a href="{{route('admin.member')}}">
                <div class="sideBar--menu--content member @if (request()->routeIs('admin.member')) active @endif">
                    <div class="sideBar--menu--content--icon">
                        <i class="fa fa-user-group"></i>
                    </div>
                    <div class="sideBar--menu--content--title">
                        <p>Member</p>
                    </div>
                </div>
            </a>

            <a href="{{route('admin.store')}}">
                <div class="sideBar--menu--content billing @if (request()->routeIs('admin.store')) active @endif">
                    <div class="sideBar--menu--content--icon">
                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    </div>
                    <div class="sideBar--menu--content--title">
                        <p>Store</p>
                    </div>
                </div>
            </a>

            <a href="#">
                <div class="sideBar--menu--content table">
                    <div class="sideBar--menu--content--icon">
                        <i class="fa fa-table"></i>
                    </div>
                    <div class="sideBar--menu--content--title">
                        <p>Component</p>
                    </div>
                </div>
            </a>

            <a href="#">
                <div class="sideBar--menu--content billing">
                    <div class="sideBar--menu--content--icon">
                        <i class="fa fa-wallet"></i>
                    </div>
                    <div class="sideBar--menu--content--title">
                        <p>Billing</p>
                    </div>
                </div>
            </a>

            <a href="#">
                <div class="sideBar--menu--content product">
                    <div class="sideBar--menu--content--icon">
                        <i class="fa fa-building-shield"></i>
                    </div>
                    <div class="sideBar--menu--content--title">
                        <p>Product</p>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="sideBar--menu--content post">
                    <div class="sideBar--menu--content--icon">
                        <i class="fa fa-newspaper"></i>
                    </div>
                    <div class="sideBar--menu--content--title">
                        <p>Post</p>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="sideBar--menu--content payment">
                    <div class="sideBar--menu--content--icon">
                        <i class="fa fa-money-check"></i>
                    </div>
                    <div class="sideBar--menu--content--title">
                        <p>Payment</p>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="sideBar--menu--content mail">
                    <div class="sideBar--menu--content--icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="sideBar--menu--content--title">
                        <p>Mail</p>
                    </div>
                </div>
            </a>
            

            <a href="#">
                <div class="sideBar--menu--content setting">
                    <div class="sideBar--menu--content--icon">
                        <i class="fa fa-gear"></i>
                    </div>
                    <div class="sideBar--menu--content--title">
                        <p>Setting</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="sideBar--footer">
        <div class="sideBar--footer--avatar">
            <img src="/assetsadmin/images/avatar-default.png" alt="">
        </div>
        <div class="sideBar--footer--title">
            <i class="fa-regular fa-star"></i>
            <p>Rosé - On The Ground</p>
            <i class="fa-regular fa-star"></i>
        </div>
        <div class="sideBar--footer--button">
            <div class="sideBar--footer--button__logout">
                <i class="fa fa-right-from-bracket"></i>
                <p>Logout manager</p>

            </div>
            <div class="sideBar--footer--button__logout no2">
                <i class="fa fa-wrench"></i>
                <p>Update profile</p>

            </div>
        </div>
    </div>
</div>