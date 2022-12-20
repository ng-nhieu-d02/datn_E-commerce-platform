@extends('home.layout.profile')
@section('content')
<div class="page--receipt--detail">
    <div class="container container-page--receipt--detail">

        <table class="table mt-5 table--listl--order--detai">
            <thead>
                <tr>
                    <th>
                        <h2 class="fw-bold">Liệt kê chi tiết đơn Hàng</h2>
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th scope="col">Tên cửa hàng</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col" class="text-center">Hình ảnh</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giá</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderStore as $store)
                <tr>
                    <td rowspan="{{$store->orderDetail->count() + 1}}">
                        <p class="fw-bolder">
                            {{$store->store->name}}
                        </p>
                        <button type="button" class="btn btn-warning">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                    <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                    <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z" />
                                </svg>
                                Chat
                            </span>
                        </button>
                        <button type="button" class="btn btn-light">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z" />
                                </svg>
                                Xem shop
                            </span>
                        </button>
                    </td>
                    <td rowspan="{{$store->orderDetail->count() + 1}}">
                        {{$store->status_order == 0 ? 'Chờ xử lí' : (
                            $store->status_order == 1 ? 'Đã xác nhận - đang xử lí' : (
                                $store->status_order == 2 ? 'Đang giao hàng' : (
                                    $store->status_order == 3 ? 'Thành công' : 'Thất bại'
                                )
                            )
                        )}}
                    </td>

                    @foreach($store->orderDetail as $detail)
                <tr>
                    <td style="border-left: 1px;"><span> {{$detail->product->name}} </span></td>
                    <td class="text-center">
                        <span> <img class="image-product" style="max-width: 100px;max-height:100px" src="{{asset('upload/product/'.$detail->product->id_store.'/album/'.$detail->product_detail->url_image)}}" alt=""> </span>
                    </td>
                    <td><span> {{$detail->quantity}} </span></td>
                    <td><span> {{number_format($detail->price)}} </span></td>
                    <td>
                        @if($order->status_order >= 3)
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{$detail->id}}">Đánh giá</button>
                        @endif
                    </td>
                    <div class="modal fade" style="z-index: 9999" id="modal{{$detail->id}}" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
                        <div class="modal-dialog modal-lg" style="height:100%; display: flex;margin: auto;align-items: center;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fs-3" id="modal">Đánh giá sản phẩm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('user.comment', [$detail->id_product, $store->store->id]) }}" method="post">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="form-floating mb-3" style="display: flex;">
                                            <textarea class="form-control" name="message" style="font-size: 1.5rem;height: 100px; padding-top: 25px" placeholder="Leave a comment here" id="floatingTextarea2"></textarea>
                                            <label for="floatingTextarea2" style="font-size: 1.5rem;">Đánh giá</label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="inputGroupSelect01" style="font-size: 1.5rem;">Số sao</label>
                                            <select class="form-select" name="rate" id="inputGroupSelect01" style="font-size: 1.5rem;">
                                                <option selected>Chọn số sao...</option>
                                                <option value="1">1 sao</option>
                                                <option value="2">2 sao</option>
                                                <option value="3">3 sao</option>
                                                <option value="4">4 sao</option>
                                                <option value="5">5 sao</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary fs-3" data-bs-dismiss="modal">Huỷ</button>
                                        <button type="submit" class="btn btn-primary fs-3">Xác nhận</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </tr>
                @endforeach

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
            <tbody>
                <tr>
                    <td>
                        <p>Tên khách hàng: <span class="text-dark fw-bold mx-4">{{ $order->name }}</span></p>
                        <p>Số điện thoại: <span class="text-dark fw-bold mx-4">{{ $order->phone }}</span></p>
                        <p>Email: <span class="text-dark fw-bold mx-4">{{ $order->email }}</span></p>
                        <p>Địa chỉ: <span class="text-dark fw-bold mx-4">{{ $order->address }}</span></p>
                    </td>
                    <td>
                        <p class="text-end">
                            Giá:
                            <span class="text-danger fw-bolder mx-4"> {{ number_format($order->total_price) }} đ </span>
                        </p>
                        <p class="text-end">
                            Tiền ship:
                            <span class="text-danger fw-bolder mx-4"> {{ number_format($order->ship) }} đ </span>
                        </p>
                        <p class="text-end">
                            Phiếu mua hàng:
                            <span class="text-danger fw-bolder mx-4"> {{ number_format($order->coupons_price + $order->coupons_frs_price) }} đ </span>
                        </p>
                        <p class="text-end">
                            Thành tiền:
                            <span class="text-danger fw-bolder mx-4"> {{ number_format(($order->total_price-$order->coupons_price)+($order->ship-$order->coupons_frs_price)) }} đ </span>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>

        <style>
            .timeline {
                border-left: 3px solid #727cf5;
                border-bottom-right-radius: 4px;
                border-top-right-radius: 4px;
                background: rgba(114, 124, 245, 0.09);
                margin: 0 auto;
                letter-spacing: 0.2px;
                position: relative;
                line-height: 1.4em;
                font-size: 1.03em;
                padding: 50px;
                list-style: none;
                text-align: left;
                margin-left: 15%;
            }

            @media (max-width: 767px) {
                .timeline {
                    max-width: 98%;
                    padding: 25px;
                }
            }

            .timeline h1 {
                font-weight: 300;
                font-size: 1.4em;
            }

            .timeline h2,
            .timeline h3 {
                font-weight: 600;
                font-size: 1rem;
                margin-bottom: 10px;
            }

            .timeline .event {
                border-bottom: 1px dashed #e8ebf1;
                padding-bottom: 25px;
                margin-bottom: 25px;
                position: relative;
            }

            @media (max-width: 767px) {
                .timeline .event {
                    padding-top: 30px;
                }
            }

            .timeline .event:last-of-type {
                padding-bottom: 0;
                margin-bottom: 0;
                border: none;
            }

            .timeline .event:before,
            .timeline .event:after {
                position: absolute;
                display: block;
                top: 0;
            }

            .timeline .event:before {
                left: -207px;
                content: attr(data-date);
                text-align: right;
                font-weight: 100;
                font-size: 0.9em;
                min-width: 120px;
            }

            @media (max-width: 767px) {
                .timeline .event:before {
                    left: 0px;
                    text-align: left;
                }
            }

            .timeline .event:after {
                -webkit-box-shadow: 0 0 0 3px #727cf5;
                box-shadow: 0 0 0 3px #727cf5;
                left: -55.8px;
                background: #fff;
                border-radius: 50%;
                height: 9px;
                width: 9px;
                content: "";
                top: 5px;
            }

            @media (max-width: 767px) {
                .timeline .event:after {
                    left: -31.8px;
                }
            }

            .rtl .timeline {
                border-left: 0;
                text-align: right;
                border-bottom-right-radius: 0;
                border-top-right-radius: 0;
                border-bottom-left-radius: 4px;
                border-top-left-radius: 4px;
                border-right: 3px solid #727cf5;
            }

            .rtl .timeline .event::before {
                left: 0;
                right: -170px;
            }

            .rtl .timeline .event::after {
                left: 0;
                right: -55.8px;
            }
        </style>
        <div class="" style="margin-top: 60px;">
            <div class="">
                <div class="col-md-12">
                    <div class="">
                        <div class="card-body">
                            <h6 class="card-title"></h6>
                            <div id="content">
                                <ul class="timeline">
                                    @foreach($order->order_history as $history)
                                    <li class="event" data-date="{{$history->created_at}}">
                                        <h3>{{$history->create_by}}</h3>
                                        <p>{{$history->content}}.</p>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection