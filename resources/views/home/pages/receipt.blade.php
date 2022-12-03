@extends('home.layout.profile')
@section('content')
<div class="page--receipt">
    <div class="container container-page--receipt">
        <ul class="nav nav-pills mb-3 d-flex" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Tất cả</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Đang giao hàng</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Đã giao</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Đã hủy</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                <table class="table--receipt w--full text-dark">
                    <thead>
                        <tr>
                            <th scope="col" colspan="1" class="py-3">
                                <span>
                                    Mã đơn hàng
                                </span>

                            </th>
                            <th class="" scope="col" colspan="2" class="py-3">
                                Thanh toán
                            </th>
                            <th class="text-end" scope="col" colspan="2" class="py-3">
                                Trang thái đơn hàng
                            </th>
                            <th class="text-end" scope="col" colspan="1" class="py-3">
                                Tổng tiền
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $list)
                        <tr>
                            <td colspan="1">
                                <span>
                                    {{$list->id}}
                                </span>
                            </td>
                            <td colspan="2">
                                <p class="text-dark fw-border pe-3">
                                    @if($list->payment_method==0)
                                    Thanh toán trực tiếp
                                    @elseif($list->payment_method==1)
                                    Thanh toán qua userPay
                                    @elseif($list->payment_method==2)
                                    Thanh toán qua VNPay
                                    @elseif($list->payment_method==3)
                                    Thanh toán qua Momo
                                    @endif
                                </p>
                                <p class="text-danger fs-5 fw-border mx-4">
                                    @if($list->payment_status==0)
                                    Chưa thanh toán
                                    @elseif($list->payment_status==1)
                                    Đã thanh toán
                                    @endif
                                </p>
                            </td>
                            <td colspan="1" class="text-end">
                                <p>
                                    @if($list->status_order==0)
                                    Đang chờ xử lý
                                    @elseif($list->status_order==1)
                                    Đã xác nhận - Đang xử lí
                                    @elseif($list->status_order==2)
                                    Đang giao hàng
                                    @elseif($list->status_order==3)
                                    Thành công
                                    @elseif($list->status_order==4)
                                    Thất bại
                                    @endif
                                </p>
                            </td>
                            <td class="text-end py-2" colspan="2">
                                <p class="fs-25">
                                    <span class="text-base">Tổng số tiền: </span>
                                    <span class="text-danger fw-bolder mx-4">{{ number_format(($list->total_price-$list->coupons_price)+($list->ship-$list->coupons_frs_price)) }}
                                        đ</span>
                                </p>
                                <div class="d-flex flex-row justify-content-end">
                                    <a href="{{ URL::to('/order-detail/'.$list->id) }}" class="js-open-modal mx-4">xem chi tiết</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                chờ xác nhận</div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                ...</div>
            <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">...</div>
        </div>
    </div>
</div>
@endsection