@extends('home.layout.main')

@section('content')
<style>
    .icon{
        position: absolute;
        display: flex;
  align-items: center;
    }
.tabs-box > .category-content{
    white-space: nowrap;
    flex: 0 0 auto;
}
.tabs-box {
  scroll-behavior: smooth;
}
.tabs-box.dragging {
  scroll-behavior: auto;
  cursor: grab;
}
.icon:first-child {
  left: 6%;
  display: none;
 
}
.icon:last-child {
  right: 5%;
  justify-content: flex-end;
 
}
.icon i {
  width: 55px;
  height: 55px;
  cursor: pointer;
  font-size: 1.2rem;
  text-align: center;
  line-height: 55px;
  border-radius: 50%;
}
.icon i:hover {
  background: #efedfb;
}
.icon:first-child i {
 
} 
.icon:last-child i {
 
} 
.tabs-box.dragging .category-content {
  user-select: none;
  pointer-events: none;
}
</style>
<div class="page--home">

    <div class="banner-voucher">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach($coupons as $key => $coupon)
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}" aria-current="{{$key == 0 ? 'true' : 'false'}}" aria-label="Slide 1"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach($coupons as $coupon)
                <div class="carousel-item active" data-bs-interval="5000">
                    <img src="{{asset('upload/voucher/'.$coupon->avatar)}}" style="width: 100%; height: 300px; object-fit:cover" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block" style="color:white">

                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div style="display: grid;grid-template-rows: 48% 48%; height:300px;align-content: space-between">
            <div class="img" style="width: 100%;height:100%">
                <img src="{{asset('assets/images/voucher-event1.png')}}" style="width: 100%;height:100%; object-fit:cover" alt="...">
            </div>
            <div class="img" style="width: 100%;height:100%">
                <img src="{{asset('assets/images/voucher-event.png')}}" style="width: 100%;height:100%; object-fit:cover" alt="...">
            </div>
        </div>
    </div>
</div>
<div class="line-title">
    <div class="content-title">
        <h2>Mua theo danh mục</h2>
    </div>
   <div class="d-flex align-items-center col-lg-12">
        <div class="icon"><i id="left" class="fa-solid fa-angle-left"></i></div>
        <div class="tabs-box page--home--category overflow-hidden col-lg-12">
            @foreach($categories as $category)
            <div class="category-content">
                <a href="{{route('user.pageSearch')}}?category={{$category->slug}}">
                    <img src="{{asset('upload/category/'.$category->avatar)}}" alt="">
                    <p>{{$category->name}}</p>
                </a>
            </div>
            @endforeach
        </div>
        <div class="icon"><i id="right" class="fa-solid fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="line-title">
    <div class="content-title">
        <h2>Sản phẩm bán chạy nhất</h2>
    </div>
    <div class="page--home--product">
        @foreach($products_sold as $prd)
        <x-cardProduct :data="$prd"></x-cardProduct>
        @endforeach
    </div>
</div>

<div class="line-title">
    <div class="content-title">
        <h2>Sản phẩm được quan tâm nhất</h2>
    </div>
    <div class="page--home--product">
        @foreach($products_view as $prd)
        <x-cardProduct :data="$prd"></x-cardProduct>
        @endforeach
    </div>
</div>

@endsection
@section("scripts")
<script>
    $(document).ready(function(){
        const tabsBox = document.querySelector(".tabs-box"),
        allTabs = tabsBox.querySelectorAll(".div"),
        arrowIcons = document.querySelectorAll(".icon i");

        let isDragging = false;

        const handleIcons = (scrollVal) => {
            let maxScrollableWidth = tabsBox.scrollWidth - tabsBox.clientWidth;
            arrowIcons[0].parentElement.style.display = scrollVal <= 0 ? "none" : "flex";
            arrowIcons[1].parentElement.style.display = maxScrollableWidth - scrollVal <= 1 ? "none" : "flex";
        }

        arrowIcons.forEach(icon => {
            icon.addEventListener("click", () => {
                let scrollWidth = tabsBox.scrollLeft += icon.id === "left" ? -340 : 340;
                handleIcons(scrollWidth);
            });
        });
       
        const dragging = (e) => {
            if(!isDragging) return;
            tabsBox.classList.add("dragging");
            tabsBox.scrollLeft -= e.movementX;
            handleIcons(tabsBox.scrollLeft)
        }
        const dragStop = () => {
            isDragging = false;
            tabsBox.classList.remove("dragging");
        }
        tabsBox.addEventListener("mousedown", () => isDragging = true);
        tabsBox.addEventListener("mousemove", dragging);
        document.addEventListener("mouseup", dragStop);
    })
</script>
@endsection