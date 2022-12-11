@extends('home.layout.store')
@section('content')
<div class="container--voucher_store">
    <div class="container--voucher_store_head">
        <button type="button" class="btn btn-outline-primary">Voucher</button>
        <button type="button" class="btn btn-primary add_new_voucher">Thêm voucher</button>
    </div>
    <div class="container--voucher_store_table">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Loại</th>
                    <th scope="col">Giá trị</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Còn lại</th>
                    <th scope="col">Public</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $coupon)
                <tr class="table-{{$coupon->status == 0 ? 'success' : 'secondary'}} table-voucher-id">
                    <th scope="row">{{$coupon->name}}</th>
                    <td>{{$coupon->type == 0 ? 'Giảm tiền' : ($coupon->type == 1 ? 'Giảm %' : 'FreeShip')}}</td>
                    <td>{{number_format($coupon->value)}}</td>
                    <td>{{$coupon->quantity}}</td>
                    <td>{{$coupon->quantity - $coupon->remaining_quantity}}</td>
                    <td>
                        @if($coupon->coupon_type == 0)
                        <span class="badge text-bg-success" role="button">Công khai</span>
                        @else
                        <span class="badge text-bg-warning" role="button">Riêng tư</span>
                    </td>
                    @endif

                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input checkbox-update-status-voucher" data-id="{{$coupon->id}}" role="button" type="checkbox" role="switch" {{$coupon->status == 0 ? 'checked' : ''}}>
                        </div>
                    </td>
                    <td style="width: 12%;">
                        <span style="font-size: 1.4rem;" class="badge text-bg-info btn-view-code-voucher" role="button" data-code='{{$coupon->code}}' data-action='show'>Xem code</span>
                        @if($coupon->quantity == $coupon->remaining_quantity)
                        <span class="badge text-bg-danger btn-remove-coupon" role="button" data-id="{{$coupon->id}}">Xoá</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$coupons->links('components.pagination')}}
    </div>
</div>


<div class="container__modal modals--add--voucher" style="display: none;">
    <div class="container__modal--header">
        <div>

        </div>
        <div class="container__modal--header__title">
            <p>Thêm voucher</p>
        </div>
        <div class="container__modal--header__icon_close">
            <ion-icon name="close-circle-outline"></ion-icon>
        </div>
    </div>
    <form class="container__modal--main modals--add--voucher--main" method="POST" enctype="multipart/form-data" action="{{route('user.add_voucher', [$store->id])}}">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Tên voucher</span>
            <input type="text" class="form-control py-3" required name="name" value="{{ old('name') }}" required placeholder="enter voucher name" aria-label="Username" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Code</span>
            <input type="password" class="form-control py-3 input_code_voucher" value="{{ old('code') }}" required name="code" aria-label="Amount (to the nearest dollar)">
            <span class="input-group-text button_make_code_random" role="button">Tạo ngẫu nhiên</span>
        </div>

        <div class="input-group mb-4 mt-4">
            <label class="input-group-text" for="inputGroupFile01">Ảnh mô tả</label>
            <input type="file" value="{{ old('avatar') }}" name="avatar" required class="form-control" id="inputGroupFile01">
        </div>

        <input type="radio" class="btn-check" value="0" name="type" required id="success-outlined-1" autocomplete="off" checked>
        <label class="btn btn-outline-success py-3 px-4 mb-3 button-radio-form-add-voucher" for="success-outlined-1">Giảm tiền</label>

        <input type="radio" class="btn-check" value="1" name="type" required id="success-outlined-2" autocomplete="off">
        <label class="btn btn-outline-success py-3 px-4 mb-3 button-radio-form-add-voucher" for="success-outlined-2">Giảm %</label>

        <input type="radio" class="btn-check" value="2" name="type" required id="success-outlined-3" autocomplete="off">
        <label class="btn btn-outline-success py-3 px-4 mb-3 button-radio-form-add-voucher" for="success-outlined-3">freeShip</label>

        <div class="input-group mb-3">
            <span class="input-group-text">Mô tả: </span>
            <input class="form-control py-3" type="text" value="{{ old('description') }}" required name="description" aria-label="With textarea" placeholder="Description"></input>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Bắt đầu: </span>
            <input type="datetime-local" name="day_start" value="{{ old('day_start') }}" required class="form-control py-3" placeholder="Username" aria-label="Username">
            <span class="input-group-text">Kết thúc: </span>
            <input type="datetime-local" name="day_end" value="{{ old('day_end') }}" required class="form-control py-3" placeholder="Server" aria-label="Server">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Hoá đơn từ: </span>
            <input type="text" name="money_start" value="{{ old('money_start') }}" required class="form-control py-3" placeholder="VNĐ" aria-label="Username">
            <span class="input-group-text">Đến: </span>
            <input type="text" name="money_end" value="{{ old('money_end') }}" required class="form-control py-3" placeholder="VNĐ" aria-label="Server">
        </div>

        <div class="input-group mb-3 gi__am__ti__en">
            <span class="input-group-text">Trị giá: </span>
            <input type="text" name="value" value="{{ old('value') }}" required class="form-control py-3" placeholder="exg: 10000" aria-label="Username">
            <span class="input-group-text">Max trị giá: </span>
            <input type="text" name="max_value" value="{{ old('max_value') }}" required class="form-control py-3" placeholder="VNĐ" aria-label="Server">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Số lượng: </span>
            <input type="text" name="quantity" value="{{ old('quantity') }}" required class="form-control py-3" placeholder="Quantity" aria-label="Server">
        </div>

        <div>
            <input type="radio" class="btn-check" value="0" name="coupon_type" required id="success-outlined-4" autocomplete="off" checked>
            <label class="btn btn-outline-success py-3 px-4 mb-3 button-radio-form-add-voucher" for="success-outlined-4">Sự kiện</label>

            <input type="radio" class="btn-check" value="1" name="coupon_type" required id="success-outlined-5" autocomplete="off">
            <label class="btn btn-outline-success py-3 px-4 mb-3 button-radio-form-add-voucher" for="success-outlined-5">Chỉ những ai có code</label>
        </div>
    </form>
    <div class="container__modal--footer">
        <button type="button" class="btn btn-primary btn-submit-form-add-voucher">Tạo voucher</button>
    </div>
</div>
@endsection

@section('scripts')

<script>
    $('.btn-remove-coupon').click(function() {
        const id = $(this).attr('data-id');
        const parentElement = $(this).parents('.table-voucher-id');
        const url__submit = '{{route("user.delete_voucher", $store->id)}}';
        const _csrf = '{{ csrf_token() }}';
        const question = confirm('you are deleting voucher, are you sure ?');
        if (question == false) {
            return;
        }
        const data = {
            id: id,
            _token: _csrf
        };
        $.ajax({
            url: url__submit,
            type: 'POST',
            data: data,
            success: function() {
                parentElement.remove();
                alert('remove success')
            }
        });
    });
    $('.checkbox-update-status-voucher').click(function() {
        const check = $(this).is(":checked");
        const id = $(this).attr('data-id');
        const parentElement = $(this).parents('.table-voucher-id');
        let status = 0;
        if (!check) {
            status = 1;
        }
        const url__submit = '{{route("user.update_voucher", $store->id)}}';
        const _csrf = '{{ csrf_token() }}';
        const data = {
            id: id,
            status: status,
            _token: _csrf
        };
        $.ajax({
            url: url__submit,
            type: 'POST',
            data: data,
            success: function() {
                if (status == 1) {
                    parentElement.removeClass('table-success');
                    parentElement.addClass('table-secondary');
                } else {
                    parentElement.addClass('table-success');
                    parentElement.removeClass('table-secondary');
                }
                alert('update success')
            }
        });
    });
</script>

@endsection