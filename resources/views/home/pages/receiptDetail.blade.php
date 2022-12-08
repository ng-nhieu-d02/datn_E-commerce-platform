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
                </tr>
                <tr>
                    <th scope="col">Tên cửa hàng</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col" class="text-center">Hình ảnh</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giá</th>
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

                    @foreach($store->orderDetail as $detail)
                    <tr>
                        <td style="border-left: 1px;"><span> {{$detail->product->name}} </span></td>
                        <td class="text-center">
                            <span> <img class="image-product" style="max-width: 100px;max-height:100px" src="{{asset('upload/product/'.$detail->product_detail->url_image)}}" alt=""> </span>
                        </td>
                        <td><span> {{$detail->quantity}} </span></td>
                        <td><span> {{number_format($detail->price)}} </span></td>
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
    </div>
</div>
@endsection