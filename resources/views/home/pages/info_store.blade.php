@extends('home.layout.store')
@section("content")
<style>
    .item{
        line-height: 45px;
        background: lightblue;
        border-radius: 5px;
    }
    .coupon .kanan {
    border-left: 1px dashed #ddd;
    width: 40% !important;
    position:relative;
}

.coupon .kanan .info::after, .coupon .kanan .info::before {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    background: #CC7722;
    border-radius: 100%;
}
.coupon .kanan .info::before {
    top: -10px;
    left: -10px;
}

.coupon .kanan .info::after {
    bottom: -10px;
    left: -10px;
}
.coupon .time {
    font-size: 1.6rem;
}
.bg-custom{
    background-color: #FFA500;
}
.btn-coupon{
    background-color: #CC7722;
     color: #fff;
      text-transform: uppercase;
}
.apply-coupon{
    position: absolute;
    bottom: 15px;
    left: 10px;
    text-decoration: none;
}
.apply-coupon:hover{
    color: #fff !important;
}
.link-muted { color: #aaa; } .link-muted:hover { color: #1266f1; }
.page-item .page-link{
    font-size: 1.5rem;
}
.star-rating > .fa-star{
    color: #dedede;
}
.fa-star.rating-color{
    color: #FFA500;
}
</style>
<div class="d-flex flex-wrap">
    <div class="col-md-12 mb-5">
        <h1 class="text-uppercase">Thông tin Shop</h1>
    </div>
    <div class="col-md-9">
        <div class="row mb-3 gap-2">
            <div class="col-md-3 item">
                <i class="fa-solid fa-user-check"></i>
                <span>Tham gia {{  $store->created_at->diffForHumans() }}</span>
            </div>
            <div class="col-md-3 item">
                <i class="fa-solid fa-house"></i>
                @if ($store->product->count() > 0)
                <span>Có {{ $store->product->count() }} sản phẩm</span>
                  @else
                  <span>Chưa đăng sản phẩm nào</span>  
                @endif
            </div>
            <div class="col-md-3 item">
                <i class="fa-regular fa-star"></i>
                @if ($store->comment->count() > 0)
                <span>{{ round($store->comment->sum("rate") / $store->comment->count(), 1)  }} ({{ $store->comment->count() }} Đánh giá)</span>
                @else
                <span>Chưa có đánh giá nào</span>
                @endif
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <span>Chuyên về: </span>
                @foreach ($store->store_cate as $storeCate)
                <span class="badge bg-primary">{{ $storeCate->name }}</span>
                @endforeach
            </div>
            <div class="col-md-12 mb-3">
                <span>Địa chỉ: {{ $store->address }} {{ $store->district }} {{ $store->city }}</span>
            </div>
            <div class="col-md-12 mb-3">
                <span>Với tiêu chí: {{ $store->slogan }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <p>Chú ý: </p>
        <div class="text-danger">
            Nghiêm cấm các Shop đăng ký gian hàng với từ ngữ thô tục, sản phẩm vi phạm pháp luật, nếu thấy liên hệ ngay vào Email: <b>nguyennhieu1507@gmail.com</b>
        </div>
    </div>
</div>
<div class="d-flex flex-column col-lg-12 gap-5 border-top pt-3">
    <h1>Đánh giá của khách hàng</h1>
    @if ($comments->isEmpty())
        <div class="col-lg-12 mb-3">
            Chưa có đánh giá nào
        </div>
    @else
    <div class="d-flex">
        <div class="col-md-12 col-lg-12">
          <div class="card text-dark">
            @foreach ($comments as $comment)
            <div class="card-body">
                <div class="d-flex flex-start">
                    <img class="rounded-circle shadow-1-strong me-3"
                    src="{{ asset("upload/profile/avatar").'/'.$comment->user->avatar }}" alt="avatar" width="60"
                    height="60" />
                    <div>
                    <h3 class="fw-bold mb-1">{{ $comment->user->name }}</h3>
                    <div class="d-flex align-items-center mb-1">
                        <p class="mb-0">
                        {{ $comment->created_at->format("d-m-Y") }}
                        {{-- <span class="badge bg-primary">Pending</span> --}}
                        </p>
                        {{-- <a href="#!" class="link-muted"><i class="fas fa-pencil-alt ms-2"></i></a>
                        <a href="#!" class="link-muted"><i class="fas fa-redo-alt ms-2"></i></a>
                        <a href="#!" class="link-muted"><i class="fas fa-heart ms-2"></i></a> --}}
                    </div>
                    <div class="star-rating mb-2">
                        {!! str_repeat('<i class="fa fa-star rating-color" aria-hidden="true"></i>', $comment->rate) !!}
                        {!! str_repeat('<i class="fa fa-star" aria-hidden="true"></i>', 5 - $comment->rate) !!}
                    </div>
                    <p class="mb-0">
                        {{ $comment->message }}
                    </p>
                    </div>
                </div>
            </div>
            <hr class="my-0" />
            @endforeach
          </div>
        </div>
    </div>
    <div class="paginate">
        {{ $comments->links() }}
    </div>
    @endif
</div>
<div class="d-flex flex-wrap col-lg-12 gap-5 border-top pt-3">
    <h1 class="col-lg-12 mt-3">Ưu đãi của Shop dành cho khách hàng</h1>
    @forelse ($store->boss[0]->user->coupons as $coupon)
    <div class="col-lg-3 position-relative">
        <div class="coupon bg-custom rounded mb-3 d-flex justify-content-between">
            <div class="kiri p-3">
                <div class="icon-container ">
                    <div class="icon-container_box">
                        <img src="/assets/images/logo.png" alt="" width="75px">
                    </div>
                </div>
               
            </div>
            <div class="tengah py-3 d-flex w-100 justify-content-start">
                <div>
                    <span class="badge bg-success">Còn hạn</span>
                    <h3>{{ $coupon->name }} </h3>
                    <p class="mb-0">Số lượng: {{ $coupon->quantity }}</p>
                </div>
            </div>
            <div class="kanan">
                <div class="info m-3 d-flex align-items-center">
                    <div class="w-100">
                        <div class="block">
                            <span class="time font-weight-light">
                                <span>{{ Carbon\Carbon::parse($coupon->stop_time)->diffForHumans() }}</span>
                            </span>
                        </div>
                       <button class="btn btn-coupon" data-code="{{ $coupon->code }}">Lấy code</button>
                       <span class="copyCoupon d-none text-success">Đã sao chép!</span>
                    </div>
                </div>
            </div>
        </div>
        {{-- <a href="#" class="apply-coupon badge bg-dark">Điều kiện áp dụng</a> --}}
    </div>
    @empty
    Hiện chưa có ưu đãi nào!!!
    @endforelse
</div>
@endsection
@section("scripts")
<script>
    $(document).ready(function(){
        $(".btn-coupon").click(function(){
            
            let code = $(this).attr("data-code")

            let textCode = document.createElement("textarea");
            textCode.textContent = code;
            textCode.style.position = "fixed";
            document.body.appendChild(textCode);
            textCode.select();
            document.execCommand("copy"); 
           
            $(this).next().removeClass("d-none");
            $(this).addClass("d-none");


            setTimeout(() => {
                $(this).removeClass("d-none");
                $(this).next().addClass("d-none");
            }, 1000);
            
            document.body.removeChild(textCode);
        })
        $(".apply-coupon").click(function(e){
            e.preventDefault();
            alert("Sài rồi biết");
        })
    })
</script>
@endsection