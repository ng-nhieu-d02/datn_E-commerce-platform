<div class="ingredient--navBar">
    <div class="ingredient--navBar--logo">
        <div class="img--logo">
            <a href=""><img src="/assets/images/logo.png" alt=""></a>
        </div>
        <div class="word--logo">
            <h2>
                <a href="">
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
                <a href="">Cart</a>
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
        <li class="ingredient--navBar--action--modals">
            <i class="fa-regular fa-bell"></i>
            <span class="tip">1</span>
        </li>
        <li class="ingredient--navBar--action--modals">
            <i class="fa-regular fa-user"></i>
            <span class="tip">2</span>
        </li>
        <li class="ingredient--navBar--action--modals" >
            <i class="fa fa-cart-shopping" id="toggle-modals" data-modals="shopping-cart"></i>
            <span class="tip">3</span>

            <div class="div--modals div--shopping-cart">
                @include('home.layout.ingredient.cartBar')
            </div>
            
        </li>

    </div>
    
</div>