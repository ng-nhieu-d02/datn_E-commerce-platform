@extends('home.layout.store')
@section('content')
<div class="container--voucher_store">
    <div class="container--voucher_store_head">
        <button type="button" class="btn btn-outline-primary">Hoá đơn</button>

    </div>
    <div class="container--voucher_store_table">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID hoá đơn</th>
                    <th scope="col">Người tạo</th>
                    <th scope="col">Giá trị</th>
                    <th scope="col">Kiểu thanh toán</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="table-{{$order->status_order == 4 ? 'secondary' : 'success'}} table-voucher-id">
                    <th scope="row">{{$order->orderStore->id}}</th>
                    <td>{{$order->orderStore->user->name}}</td>
                    <td>{{number_format(($order->total_price-$order->coupons_price) + ($order->ship - $order->coupon_frs_price))}}</td>
                    <td>{{$order->orderStore->payment_method == 0 ? 'Thánh toán khi nhận hàng' : ($order->orderStore->payment_method == 1 ? 'Thánh toán qua Beespay' : ($order->orderStore->payment_method == 2 ? 'Thánh toán qua vnpay' : 'Thanh toán qua momo'))}}</td>
                    <td>{{$order->status_payment_store == 0 ? 'Đợi xác nhận' : ($order->status_payment_store	== 1 ? 'Đã thanh toán' : 'Giao dịch lỗi')}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>
                        @if($order->status_order == 0)
                        <span class="badge text-bg-warning" role="button">Chờ xử lý</span>
                        @elseif($order->status_order == 1)
                        <span class="badge text-bg-primary" role="button">Đã xác nhận</span>
                        @elseif($order->status_order == 2)
                        <span class="badge text-bg-light" role="button">Đang giao hàng</span>
                        @elseif($order->status_order == 3)
                        <span class="badge text-bg-success" role="button">Thành công</span>
                        @elseif($order->status_order == 4)
                        <span class="badge text-bg-danger" role="button">Thất bại</span>
                        @endif
                        
                    </td>
                    <td>
                        <a href="{{route('user.order_detail_store', [$store->id,$order->id])}}">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$orders->links('components.pagination')}}
    </div>
</div>

@endsection