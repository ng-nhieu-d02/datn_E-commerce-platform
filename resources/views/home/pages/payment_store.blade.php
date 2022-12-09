@extends('home.layout.store')
@section('content')
<div class="container--voucher_store">
    <div class="container--voucher_store_head">
        <button type="button" class="btn btn-outline-primary">Số dư hiện tại: {{number_format($store->money)}}</button>
        <div>
            <button type="button" id="add_new_address" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">Nạp tiền</button>
            <button type="button" id="add_new_address" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">Rút tiền</button>
        </div>
    </div>
    @if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <div class="container--voucher_store_table">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Người tạo</th>
                    <th scope="col">Số tiền</th>
                    <th scope="col">Loại</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payment as $pay)
                <tr class="table-{{$pay->status == 1 ? 'success' : 'secondary'}} table-voucher-id">
                    <th scope="row">{{$pay->created_at}}</th>
                    <td>{{$pay->user->name}}</td>
                    <td>{{number_format($pay->amount)}}</td>
                    <td>{{$pay->type == 0 ? '+ tiền' : '- tiền'}}</td>
                    <td>{{$pay->description}}</td>
                    <td>
                        @if($pay->status == 0)
                        <span class="badge text-bg-warning" role="button">Chờ xử lí</span>
                        @elseif($pay->status == 1)
                        <span class="badge text-bg-success" role="button">Thành công</span>
                        @else
                        <span class="badge text-bg-danger" role="button">Thất bại</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$payment->links('components.pagination')}}
    </div>
</div>


<div class="modal fade" style="z-index: 9999 ; margin-top:15vh" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-3" id="modal">Nạp tiền</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.payment_store_post', [$store->id]) }}" method="post">
                <div class="modal-body">
                    @csrf

                    <div class=" mb-3 col-lg-12">
                        <label for="" class="form-label">Số tiền muốn nạp:</label>
                    </div>
                    <div class="input-group mb-3" style="flex-wrap: nowrap">
                        <span class="input-group-text" style="font-size:1.5rem">$</span>
                        <input type="money" class="form-control" name="amount" style="font-size:1.5rem" aria-label="Amount (to the nearest dollar)" required>
                        <span class="input-group-text" style="font-size:1.5rem">VND</span>
                    </div>
                    <input type="hidden" name="type" value="0">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fs-3" data-bs-dismiss="modal">Huỷ</button>
                    <button type="submit" class="btn btn-primary fs-3">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" style="z-index: 9999 ; margin-top:15vh" id="modal1" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-3" id="modal">Rút tiền</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.payment_store_post', [$store->id]) }}" method="post">
                <div class="modal-body">
                    @csrf

                    <div class=" mb-3 col-lg-12">
                        <label for="" class="form-label">Số tiền muốn rút:</label>
                    </div>
                    <div class="input-group mb-3" style="flex-wrap: nowrap">
                        <span class="input-group-text" style="font-size:1.5rem">$</span>
                        <input type="money" class="form-control" name="amount" style="font-size:1.5rem" aria-label="Amount (to the nearest dollar)" required>
                        <span class="input-group-text" style="font-size:1.5rem">VND</span>
                    </div>
                    <div class=" mb-3 col-lg-12">
                        <label for="" class="form-label">Số TK ngân hàng:</label>
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping" style="font-size:1.5rem">STK</span>
                        <input type="text" name="stk" class="form-control" style="font-size:1.5rem" placeholder="số tải khoản" aria-label="Username" aria-describedby="addon-wrapping">
                    </div>
                    <div class=" mb-3 col-lg-12">
                        <label for="" class="form-label">Tên ngân hàng:</label>
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping" style="font-size:1.5rem">Ngân hàng</span>
                        <input type="text" name="bank_name" class="form-control" style="font-size:1.5rem" placeholder="Tên ngân hàng" aria-label="Username" aria-describedby="addon-wrapping">
                    </div>
                    <div class=" mb-3 col-lg-12">
                        <label for="" class="form-label">Chủ tài khoản:</label>
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping" style="font-size:1.5rem">Chủ tài khoản</span>
                        <input type="text" name="chu_tk" class="form-control" style="font-size:1.5rem" placeholder="Chủ tài khoản" aria-label="Username" aria-describedby="addon-wrapping">
                    </div>
                    <input type="hidden" name="type" value="1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fs-3" data-bs-dismiss="modal">Huỷ</button>
                    <button type="submit" class="btn btn-primary fs-3">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection