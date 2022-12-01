<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard.layout.ingredient.head')
</head>

<body class="dark-mode">
    <div class="container--layout">
        <div class="container--sideBar">
            @include('dashboard.layout.ingredient.sideBar')
        </div>
        <div class="container--content">
            @include('dashboard.layout.ingredient.navBar')

            <!-- Content -->

            @yield('content')
            
            <!-- End Content -->

            @include('dashboard.layout.ingredient.footer')
        </div>
    </div>

    @include('dashboard.layout.ingredient.errorFunction')
    @include('dashboard.layout.ingredient.scripts')
</body>

</html>