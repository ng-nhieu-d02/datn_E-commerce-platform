@extends('home.layout.store')
@section('content')
<style>
    .btn-color{
        height: 25px;
        width: 25px;
        outline: 2px solid #333;
    }
    input.btn-color-input:checked + label::after{
    font-family: "FontAwesome";
    content: "\f00c";
    display: flex;
    justify-content: center;
    align-items: center;
    }
    .btn-color:hover{
        cursor: pointer;
    }
</style>
@if ($checkPermissionStore)
    
<div class="col-lg-12 d-flex mb-4">
    <a href="{{ route("user.create-product-store", $checkPermissionStore->id_store) }}" class="btn btn-primary fs-4 d-inline">Thêm sản phẩm</a>
</div>
@endif
@if($message = session("error"))
<div class="alert alert-danger" role="alert">
    {{ $message }}
  </div>
@endif

@if($message = session("success"))
<div class="alert alert-success" role="alert">
    {{ $message }}
  </div>
@endif
<div class="page--home--product">
    
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
                    <th scope="col">Tên thuộc tính</th>
                    <th scope="col">Giá trị thuộc tính</th>
                    <th scope="col">Màu sắc</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Public</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($store->product as $prd)
                <tr class="table-success table-voucher-id">
                    <th scope="row">{{ $prd->name }}</th>
                    <td>{{ $prd->categoryProduct->name }}</td>
                    <td>{{ $prd->attributes[0]->attribute }}</td>
                    <td>
                        @foreach ($prd->attribute_values as $value)
                            {{ $value->attribute_value }}
                        @endforeach
                    </td>
                    <td>
                        <div class="d-flex" id="template-color">
                            <div class="checkbox-color">
                                <label style="background: #0000ff;" class="rounded-circle btn-color" for="color-#0000ff"></label>
                            </div>
                            <div class="checkbox-color">
                                <label style="background: #ff0000;" class="rounded-circle btn-color" for="color-#ff0000"></label>
                            </div>
                            <div class="checkbox-color">
                                <label style="background: #ffc0cb;" class="rounded-circle btn-color" for="color-#ffc0cb"></label>
                            </div>
                            <div class="checkbox-color">
                                <label style="background: #ffffff;" class="rounded-circle btn-color" for="color-#ffffff"></label>
                            </div>
                        </div>
                    </td>
                    <td>
                        <img style="height: 50px;width: 120px; " src="{{ $prd->images[0]->url }}" alt="Đường dẫn ảnh sai">
                    </td>
                    <td>
                       
                        @if ($prd->status == '0')
                            <span class="badge text-bg-success" role="button">Công khai</span>
                        @else
                        <span class="badge text-bg-danger" role="button">Ẩn</span>
                        @endif
                       
                    </td>
                   
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input checkbox-update-status-voucher" data-id="{{ $prd->id }}" role="button" type="checkbox" role="switch" @if($prd->status == 0) checked @endif>
                        </div>
                    <td style="width: 12%;">
                        <a href="" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route("user.delete_product", $prd->id) }}" method="post">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        
                    </td>
                    
                </tr>
                @endforeach
                
                
            </tbody>
        </table>
       
    </div>
    
</div>
@endsection
@section("scripts")
<script>
    $(document).ready(function(){
        $(".checkbox-update-status-voucher").each((i, obj) => {
            obj.onclick = function(){
                let id = $(this).data("id");
                let route = '{{ route("user.update-status-product", ":id") }}';
                let url = route.replace(":id", id);
                
                $.ajax({
                    url : url,
                    type: "PUT",
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if(response){
                            alert("Cập nhật thành công")
                            window.location.reload()
                        }else{
                            alert("Hệ thống đang có lỗi")
                        }
                    }
                })
            }
        })
    })
</script>
@endsection