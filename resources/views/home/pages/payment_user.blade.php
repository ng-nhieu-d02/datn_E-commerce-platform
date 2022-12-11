@extends('home.layout.profile')
@section("content")
<style>
    .address-container {
        border-bottom: 1px solid #dedede;
        padding-bottom: 5px;
    }

    input,
    select {
        width: 95% !important;
    }

    .modal-dialog {
        position: absolute;
        top: 10%;
        left: 0;
        right: 0;
    }

    .update-delete button {
        background: transparent;
        border: none;
        color: blue;
        text-decoration: underline;
    }

    .set-defaut span,
    .set-defaut-2 span {
        border: 1px solid orange;
        padding: 5px;
        margin-top: 10px;
        color: orange;
    }

    .set-defaut-2 span {
        border: 1px solid #6c757d;
        color: #6c757d;
        cursor: pointer;
    }
</style>

<div class="address-container d-flex justify-content-between align-items-center">
    <h1 class="h1_address">Lịch sử nạp tiền</h1>
    <button type="button" id="add_new_address" class="btn btn-primary fs-3" data-bs-toggle="modal" data-bs-target="#modal">Tạo đơn nạp</button>
</div>
<div class="show-address mt-3">
    <h1 class="fs-2 mb-3"></h1>
    <div class="container--voucher_store_table">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Ngày tạo</th>
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
                    <th scope="row">{{number_format($pay->amount)}}</th>
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

<!-- Modal -->
<div class="modal fade" style="z-index: 9999" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-3" id="modal">Nạp tiền</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.payment_user_checkout') }}" method="post">
                <div class="modal-body">
                    @csrf

                    <div class=" mb-3 col-lg-12">
                        <label for="" class="form-label">Số tiền muốn nạp:</label>
                    </div>
                    <div class="input-group mb-3" style="flex-wrap: nowrap">
                        <span class="input-group-text" style="font-size:1.5rem">$</span>
                        <input type="money" class="form-control" name="amount" style="font-size:1.5rem" aria-label="Amount (to the nearest dollar)">
                        <span class="input-group-text" style="font-size:1.5rem">VND</span>
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

@endsection