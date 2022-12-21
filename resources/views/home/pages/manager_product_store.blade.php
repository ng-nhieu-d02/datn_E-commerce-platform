@extends('home.layout.store')
@section('content')
<style>
    .btn-color {
        height: 25px;
        width: 25px;
        outline: 2px solid #333;
    }

    input.btn-color-input:checked+label::after {
        font-family: "FontAwesome";
        content: "\f00c";
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn-color:hover {
        cursor: pointer;
    }
</style>
@if ($checkPermissionStore)
<div class="col-lg-12 d-flex mb-4">
    <a href="{{ route("user.create-product-store", $checkPermissionStore->id_store) }}" class="btn btn-primary fs-4 d-inline">Thêm sản phẩm</a>
</div>
@endif


<div>

    {{-- @if (!is_null($store))
        @forelse($store->product as $prd)
        <x-cardProduct :data="$prd"></x-cardProduct>

        @empty

        Chưa có sản phẩm nào
        
        @endforelse
    @else
        Bạn chưa đăng ký gian hàng của mình.
    @endif --}}
    <div class="container--voucher_store_table">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Tên</th>
                    <th scope="col">Loại</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Public</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Đã bán</th>
                    <th scope="col">Lượt xem</th>
                    <th scope="col">View top</th>
                    <th scope="col" style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($products as $prd)

                <tr class="table-success table-voucher-id">
                    <th scope="row" style="display: table-cell;vertical-align: middle;white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 250px;">{{ $prd->name }}</th>
                    <td style="display: table-cell;vertical-align: middle;">{{ $prd->categoryProduct->name }}</td>
                    <td style="display: table-cell;vertical-align: middle;">
                        <img style="width:50px" src="{{ asset('upload/product/'.$prd->thumb) }}" alt="Đường dẫn ảnh sai">
                    </td>
                    <td style="display: table-cell;vertical-align: middle;">

                        @if ($prd->status == '0')
                        <span class="badge text-bg-success" role="button">Công khai</span>
                        @else
                        <span class="badge text-bg-danger" role="button">Ẩn</span>
                        @endif

                    </td>

                    <td style="display: table-cell;vertical-align: middle">
                        <div class="form-check form-switch d-flex justify-content-center">
                            <input class="form-check-input checkbox-update-status-voucher" data-id="{{ $prd->id }}" role="button" type="checkbox" role="switch" @if($prd->status == 0) checked @endif>
                        </div>
                    </td>
                    <td style="display: table-cell;vertical-align: middle; text-align:center">
                        {{number_format($prd->detail->sum('sold'))}}
                    </td>
                    <td style="display: table-cell;vertical-align: middle; text-align:center">
                        {{number_format($prd->view)}}
                    </td>
                    <td style="display: table-cell;vertical-align: middle; text-align:center">
                        {{number_format($prd->view_prioritized)}}
                    </td>
                    <td style="display: table-cell;vertical-align: middle;">
                        <div style="display:flex; gap: 5px;justify-content: flex-end;">
                            <a href="" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route("user.delete_product", [$store->id,$prd->id]) }}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                            <button type="button" id="add_new_address" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{$prd->id}}">Quảng cáo</button>
                        </div>
                    </td>

                </tr>

                <div class="modal fade" style="z-index: 9999 ; margin-top:15vh" id="modal{{$prd->id}}" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fs-3" id="modal">Đặt quảng cáo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('user.marketing', [$store->id, $prd->id])}}" method="post">
                                <div class="modal-body">
                                    @csrf
                                    <div class=" mb-3 col-lg-12">
                                        <label for="" class="form-label">Số tiền muốn quảng cáo:</label>
                                    </div>
                                    <div class="input-group mb-3" style="flex-wrap: nowrap">
                                        <span class="input-group-text" style="font-size:1.5rem">$</span>
                                        <input type="money" class="form-control amount_marketing" name="amount" style="font-size:1.5rem" aria-label="Amount (to the nearest dollar)" required>
                                        <span class="input-group-text" style="font-size:1.5rem">VND</span>
                                    </div>
                                    <div class=" mb-3 col-lg-12">
                                        <label for="" class="form-label">Số view nhận được:</label>
                                    </div>
                                    <div class="input-group mb-3" style="flex-wrap: nowrap">
                                        <span class="input-group-text" style="font-size:1.5rem">1 x 2</span>
                                        <input type="text" class="form-control view_marketing" readonly style="font-size:1.5rem" aria-label="Amount (to the nearest dollar)" required>
                                        <span class="input-group-text" style="font-size:1.5rem">View</span>
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
                @endforeach


            </tbody>
        </table>
        {{$products->links('components.pagination')}}
    </div>

</div>


@endsection
@section("scripts")

<script>
    $(document).ready(function() {
        $(".checkbox-update-status-voucher").each((i, obj) => {
            obj.onclick = function() {
                let id = $(this).data("id");
                let route = '{{ route("user.update-status-product", ":id") }}';
                let url = route.replace(":id", id);

                $.ajax({
                    url: url,
                    type: "PUT",
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response) {
                            alert("Cập nhật thành công")
                            window.location.reload()
                        } else {
                            alert("Hệ thống đang có lỗi")
                        }
                    }
                })
            }
        });
        $('.amount_marketing').keyup(function() {
            const amount = $(this).val();
            $('.view_marketing').val(amount * 2);
        });
    })
</script>
@endsection