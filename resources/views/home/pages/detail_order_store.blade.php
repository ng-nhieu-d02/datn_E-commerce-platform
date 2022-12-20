@extends('home.layout.store')
@section('content')
<div class="page--receipt--detail">
    <div class="container container-page--receipt--detail">
        <table class="table mt-5 table--listl--order--detai">
            <thead>
                <tr>
                    <th>
                        <h2 class="fw-bold" style="margin-bottom: 20px">Liệt kê chi tiết đơn Hàng</h2>
                    </th>

                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>

                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col" class="text-center">Hình ảnh</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giá</th>
                </tr>
            </thead>
            <tbody>


                @foreach($details as $detail)
                <tr>
                    <td style="border-left: 1px;"><span> {{$detail->product->name}} </span></td>
                    <td class="text-center">
                        <span> <img class="image-product" style="max-width: 100px;max-height:100px" src="{{asset('upload/product/'.$detail->product->id_store.'/album/'.$detail->product_detail->url_image)}}" alt=""> </span>
                    </td>
                    <td><span> {{$detail->quantity}} </span></td>
                    <td><span> {{number_format($detail->price)}} </span></td>
                </tr>
                @endforeach



            </tbody>

        </table>

        <table class="table">
            <thead>
                <tr>
                    <th>
                        <h2 class="fw-bold">Thông tin đơn hàng</h2>
                    </th>
                </tr>
            </thead>
            <tbody style="margin-top: 10px;">
                <tr>
                    <td>
                        <p>Tên khách hàng: <span class="text-dark fw-bold mx-4">{{ $detail->order->name }}</span></p>
                        <p>Số điện thoại: <span class="text-dark fw-bold mx-4">{{ $detail->order->phone }}</span></p>
                        <p>Email: <span class="text-dark fw-bold mx-4">{{ $detail->order->email }}</span></p>
                        <p>Địa chỉ: <span class="text-dark fw-bold mx-4">{{ $detail->order->address }}</span></p>
                    </td>
                    <td>
                        <p class="text-end">
                            Giá:
                            <span class="text-danger fw-bolder mx-4"> {{ number_format($detail->orderStores->total_price) }} đ </span>
                        </p>
                        <p class="text-end">
                            Tiền ship:
                            <span class="text-danger fw-bolder mx-4"> {{ number_format($detail->orderStores->ship) }} đ </span>
                        </p>
                        <p class="text-end">
                            Phiếu mua hàng:
                            <span class="text-danger fw-bolder mx-4"> {{ number_format($detail->orderStores->coupons_price + $detail->orderStores->coupons_frs_price) }} đ </span>
                        </p>
                        <p class="text-end">
                            Thành tiền:
                            <span class="text-danger fw-bolder mx-4"> {{ number_format(($detail->orderStores->total_price-$detail->orderStores->coupons_price)+($detail->orderStores->ship-$detail->orderStores->coupons_frs_price)) }} đ </span>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>

        <style>
            .hori-timeline .events {
                border-top: 3px solid #e9ecef;
            }

            .hori-timeline .events .event-list {
                display: block;
                position: relative;
                text-align: center;
                padding-top: 70px;
                margin-right: 0;
            }

            .hori-timeline .events .event-list.hidden {
                opacity: 0.3;
            }

            .hori-timeline .events .event-list:before {
                content: "";
                position: absolute;
                height: 36px;
                border-right: 2px dashed #dee2e6;
                top: 0;
            }

            .hori-timeline .events .event-list .event-date {
                position: absolute;
                top: 38px;
                left: 0;
                right: 0;
                width: 75px;
                margin: 0 auto;
                border-radius: 4px;
                padding: 2px 4px;
            }

            @media (min-width: 1140px) {
                .hori-timeline .events .event-list {
                    display: inline-block;
                    width: 24%;
                    padding-top: 45px;
                }

                .hori-timeline .events .event-list .event-date {
                    top: -12px;
                }
            }

            .bg-soft-primary {
                background-color: rgba(64, 144, 203, .3) !important;
            }

            .bg-soft-success {
                background-color: rgba(71, 189, 154, .3) !important;
            }

            .bg-soft-danger {
                background-color: rgba(231, 76, 94, .3) !important;
            }

            .bg-soft-warning {
                background-color: rgba(249, 213, 112, .3) !important;
            }

            .card {
                border: none;
                margin-top: 100px;
                margin-bottom: 50px;
                -webkit-box-shadow: 0 0 13px 0 rgba(236, 236, 241, .44);
                box-shadow: 0 0 13px 0 rgba(236, 236, 241, .44);
            }
        </style>
        <div class="card">
            <div class="">
                <div class="hori-timeline" dir="ltr">
                    <ul class="list-inline events">
                        <li class="list-inline-item event-list">
                            <div class="px-4">
                                <div class="event-date bg-soft-primary text-primary">1</div>
                                <h5 class="font-size-16">Xác nhận đơn hàng</h5>
                                <p class="text-muted">Xác nhận rằng bạn đã nhận được đơn hàng và đang chuẩn bị sản phẩm.</p>
                                <div>
                                    @if($detail->orderStores->status_order == 0)
                                        <a href="{{route('user.update_order_store', [$store->id, $detail->orderStores->id, 1])}}" class="btn stretched-link btn-outline-primary" style="font-size:1.5rem; padding: 8px 15px">Xác nhận</a>
                                    @endif
                                </div>
                            </div>
                        </li>
                        <li class="list-inline-item event-list {{$detail->orderStores->status_order >= 1 ? '' : 'hidden'}}">
                            <div class="px-4">
                                <div class="event-date bg-soft-success text-success">2</div>
                                <h5 class="font-size-16">Giao hàng</h5>
                                <p class="text-muted">Xác nhận rằng đơn hàng đã được gửi đi và trong quá trình vận chuyển.</p>
                                <div>
                                    @if($detail->orderStores->status_order == 1)
                                        <a href="{{route('user.update_order_store', [$store->id, $detail->orderStores->id, 2])}}" class="btn stretched-link btn-outline-primary" style="font-size:1.5rem; padding: 8px 15px">Xác nhận</a>
                                    @endif
                                </div>
                            </div>
                        </li>
                        <li class="list-inline-item event-list {{$detail->orderStores->status_order >= 2 ? '' : 'hidden'}}">
                            <div class="px-4">
                                <div class="event-date bg-soft-danger text-danger">3</div>
                                <h5 class="font-size-16">Nhận hàng</h5>
                                <p class="text-muted">Đơn hàng đã được vận chuyển tới người mua, người mua tiến hành nhận hàng.</p>
                                <div>
                                    @if($detail->orderStores->status_order == 2)
                                    <a href="{{route('user.update_order_store', [$store->id, $detail->orderStores->id, 4])}}" class="btn btn-outline-primary" style="font-size:1.5rem; padding: 8px 15px">Thất bại</a>
                                        <a href="{{route('user.update_order_store', [$store->id, $detail->orderStores->id, 3])}}" class="btn btn-outline-primary" style="font-size:1.5rem; padding: 8px 15px">Thành công</a>
                                        
                                    @endif
                                </div>
                            </div>
                        </li>
                        <li class="list-inline-item event-list {{$detail->orderStores->status_order >= 3 ? '' : 'hidden'}}">
                            <div class="px-4">
                                <div class="event-date bg-soft-warning text-warning">4</div>
                                @if($detail->orderStores->status_order == 3)
                                <h5 class="font-size-16">Hoàn thành</h5>
                                <p class="text-muted">Đơn hàng thành công. <br> <hr> </p>
                                @else 
                                <h5 class="font-size-16">Thất bại</h5>
                                <p class="text-muted">Đơn hàng bị huỷ bỏ !!. <br> <hr> </p>
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection