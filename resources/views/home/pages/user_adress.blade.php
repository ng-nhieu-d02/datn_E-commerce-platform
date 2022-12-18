@extends('home.layout.profile')
@section("content")
<style>
    .address-container{
        border-bottom: 1px solid #dedede;
        padding-bottom:5px;
    }
    input, select{
        width: 95% !important;
    }
    .modal-dialog{
        position: absolute;
        top: 10%;
        left: 0;
        right: 0;
    }
    .update-delete button{
        background: transparent;
        border: none;
        color: blue;
        text-decoration: underline;
    }
    .set-defaut span, .set-defaut-2 span{
        border: 1px solid orange;
        padding: 5px;
        margin-top: 10px;
        color: orange;
    }
    .set-defaut-2 span{
        border: 1px solid #6c757d;
        color: #6c757d;
        cursor: pointer;
    }
</style>

<div class="address-container d-flex justify-content-between align-items-center">
    <h1 class="h1_address">Địa chỉ của tôi</h1>
    <button type="button" id="add_new_address" class="btn btn-primary fs-3" data-bs-toggle="modal" data-bs-target="#modal">Thêm địa chỉ mới</button>
</div>
<div class="show-address mt-3">
    <h1 class="fs-2 mb-3">Địa chỉ</h1>
    <div class="list-address">
        @forelse ($address as $adr)
        <div class="item-adress d-flex my-5">
            <div class="col-lg-6 d-flex flex-column">
                <span class="fw-bold fs-3">{{ $adr->name ? $adr->name : $adr->user->name }}</span>
                <span class="text-muted fs-3">{{ $adr->address }}, {{ $adr->district }}, {{ $adr->city }}</span>
                <span class="text-muted fs-3">
                    @if ($adr->phone)
                        {{ $adr->phone }}
                    @else
                    {{ $adr->user->phone }}
                    @endif
                </span>
                <span class="fw-bold fs-3">{{ $adr->email }}</span>
                @if($adr->status == '0')
                <div class="set-defaut mt-2">
                    <span>Mặc định</span>
                </div>    
                @endif
                
            </div>
            <div class="col-lg-6 d-flex flex-column align-items-end">
                <div class="update-delete d-flex">
                    <button class="btn-update-address fs-3 me-3" data-href="{{ route("user.show_address", $adr->id) }}" data-bs-toggle="modal" data-id="{{ $adr->id }}" data-bs-target="#edit" >Cập nhật</button>
                   <form action="{{ route("user.delete_address", $adr->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                        <button class="fs-3">Xoá</button>
                   </form>
                </div>
                @if($adr->status == '1')
                <div class="set-defaut-2 mt-2">
                    <form action="{{ route("user.update_status_address", $adr->id) }}" method="post">
                        @csrf
                        @method('PUT')
                            <button style="background: transparent; border: none"><span>Thiết lập mặc định</span></button>
                       </form>
                    
                </div>
                @endif
            </div>
        </div>
        @empty
            Chưa có địa chỉ nào!
        @endforelse
       
    </div>
</div>

    <!-- Modal -->
<div class="modal fade" style="z-index: 9999" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-3" id="modal">Địa chỉ mới</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route("user.add_address") }}" method="post">
        <div class="modal-body">
            @csrf
            <div class="mb-3 col-lg-12">
                <label for="" class="form-label">Tên người nhận</label>
                <input type="text" class="form-control fs-3" name="name" value="{{ old("name") }}" required placeholder="Nhập tên người nhận">
            </div>
            <div class=" mb-3 col-lg-12">
                <label for="" class="form-label">Thành phố/ Tỉnh</label>
                {{-- <input type="text" name="city" value="{{ old('city') }}" placeholder="Hồ Chí Minh"
                    class="form-control"> --}}
                <select name="city" class="form-control fs-3" required id="city"></select>
            </div>
            <div class=" mb-3 col-lg-12">
                <label for="" class="form-label">Quận/ Huyện</label>
                {{-- <input type="text" name="district" value="{{ old('district') }}" placeholder="Gò Vấp"
                    class="form-control"> --}}

                <select name="district" required class="form-control fs-3" id="district">
                    {{-- <option value="" disabled selected>Chọn tỉnh</option> --}}
                </select>
            </div>
            <div class=" mb-3 col-lg-12">
                <label for="" class="form-label">Địa chỉ</label>
                <input type="text" name="address" value="{{ old('address') }}"
                    placeholder="923/212 đường Dương Đông Kích Tây" id="address" required class="form-control fs-3">
            </div>
            <div class="col-lg-12 mb-3">
                <label for=""  class="form-label">Số điện thoại</label>
                <input type="text" name="phone" value="{{ old("phone") }}" class="form-control fs-3">
                <span id="message"></span>
            </div>
            <div class="col-lg-12 mb-3">
                <label for=""  class="form-label">Email</label>
                <input type="email" name="email" value="{{ old("email") }}" class="form-control fs-3">
                <span id="email"></span>
            </div>
           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary fs-3" data-bs-dismiss="modal">Huỷ</button>
            <button type="submit" class="btn btn-primary fs-3">Thêm mới</button>
        </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" style="z-index: 9999" id="edit" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-3">Sửa địa chỉ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
       
        <form id="form-edit" action=""  method="post">
            <div class="col-lg-12">
                <div class="alert alert-danger" style="display: none">
                    <ul id="ulEl"></ul>
                </div>
            </div>
        <div class="modal-body">
            @csrf
            @method("PUT")
            <div class="mb-3 col-lg-12">
                <label for="" class="form-label">Tên người nhận</label>
                <input type="text" class="form-control fs-3" name="name" id="name" value="" required placeholder="Nhập tên người nhận">
            </div>
            <div class=" mb-3 col-lg-12">
                <label for="" class="form-label">Thành phố/ Tỉnh</label>
                {{-- <input type="text" name="city" value="{{ old('city') }}" placeholder="Hồ Chí Minh"
                    class="form-control"> --}}
                <select name="city" class="form-control fs-3" required id="city-2"></select>
            </div>
            <div class=" mb-3 col-lg-12">
                <label for="" class="form-label">Quận/ Huyện</label>
                {{-- <input type="text" name="district" value="{{ old('district') }}" placeholder="Gò Vấp"
                    class="form-control"> --}}

                <select name="district" required class="form-control fs-3" id="district-2">
                    {{-- <option value="" disabled selected>Chọn tỉnh</option> --}}
                </select>
            </div>
            <div class=" mb-3 col-lg-12">
                <label for="" class="form-label">Địa chỉ</label>
                <input type="text" name="address" value="{{ old('address') }}"
                    placeholder="923/212 đường Dương Đông Kích Tây" id="address-2" required class="form-control fs-3">
            </div>
            <div class="col-lg-12 mb-3">
                <label for=""  class="form-label">Số điện thoại</label>
                <input type="text" name="phone" id="phone-2" class="form-control fs-3">
                <span id="message"></span>
            </div>
            <div class="col-lg-12 mb-3">
                <label for=""  class="form-label">Email</label>
                <input type="text" name="email" id="email-2" class="form-control fs-3">
                <span id="errorEmail"></span>
            </div>
           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary fs-3" data-bs-dismiss="modal">Huỷ</button>
            <button type="submit" class="btn btn-primary fs-3">Cập nhật</button>
        </div>
        </form>
      </div>
    </div>
</div>



@endsection
@section("scripts")
<script>
    $(document).ready(function(){

        function checkPhone(El){
           
            const regexPhoneNumber = /(84|0[3|5|7|8|9])+([0-9]{8})\b/g;
            return El.match(regexPhoneNumber) ? true : false;
        }

        $('input[name="phone"]').keyup(function(e)
                                {
            if (/\D/g.test(this.value))
            {
                // Filter non-digits from input value.
                this.value = this.value.replace(/\D/g, '');
            }
    
            if(checkPhone($(this).val())){
                $("#message").removeClass("text-danger")
                $("#message").html("");

            }else{
                $("#message").addClass("text-danger")
                $("#message").html('Số điện thoại không hợp lệ');
            }
        });
    })
</script>
@endsection