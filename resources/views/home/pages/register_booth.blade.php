@extends('home.layout.profile')
@section('content')
    <style>
        .w-95 {
            width: 95%;
        }

        .form-control {
            width: 95%;
            height: 20px;
            font-size: 1.5rem;
            padding: 10px;
        }

        .file-upload {
            background-color: #ffffff;
            width: 100%;
            margin: 0 auto;
            padding: 10px 0px;
        }

        .file-upload-btn {
            width: 95%;
            margin: 0;
            color: #fff;
            background: #1FB264;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #15824B;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .file-upload-btn:hover {
            background: #1AA059;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .file-upload-btn:active {
            border: 0;
            transition: all .2s ease;
        }

        .file-upload-content {
            display: none;
            text-align: center;
        }

        .file-upload-input {
            position: absolute;
            margin: 0;
            padding: 0;
            width: 95%;
            height: 100%;
            outline: none;
            opacity: 0;
            cursor: pointer;
        }

        .image-upload-wrap {
            margin-top: 20px;
            border: 3px dashed #1FB264;
            position: relative;
            width: 95%;
        }

        .image-dropping,
        .image-upload-wrap:hover {
            background-color: #1FB264;
            border: 3px dashed #ffffff;

        }

        .image-title-wrap {
            padding: 0 15px 15px 15px;
            color: #222;
        }

        .drag-text {
            text-align: center;
        }

        .file-upload-input:hover~.drag-text h3 {
            color: #fff;
        }

        .drag-text h3 {
            font-weight: 100;
            text-transform: uppercase;
            color: #15824B;
            padding: 60px 0;
        }

        .file-upload-image {

            max-width: 95%;
            margin: auto;
            padding: 20px;
        }

        .remove-image {
            width: 95%;
            margin: 0;
            color: #fff;
            background: #cd4535;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #b02818;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .remove-image:hover {
            background: #c13b2a;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .remove-image:active {
            border: 0;
            transition: all .2s ease;
        }

        .bootstrap-tagsinput .tag {
            padding: 1px 10px;
            border-radius: 5px;
            color: #fff;
            background: lightblue;
        }

        .bootstrap-tagsinput {
            width: 96%;
            height: 30px;
            display: flex;
        }
    </style>
    @if(is_null($checkStore))
    <h1>Đăng ký gian hàng của bạn</h1>

    <div class="d-flex">
        <form action="{{ route('user.store_booth') }}" method="POST" enctype="multipart/form-data"
            class="show-profile col-lg-8 d-flex">
            @csrf
            <div class="d-flex flex-column col-lg-12">
                <div class=" mb-3">
                    <label for="" class="form-label">Tên gian hàng</label>
                    <input class="form-control" type="text" placeholder="Tên shop của bạn" name="name"
                        value="{{ old('name') }}">
                </div>
                <div class=" mb-3">
                    <label for="" class="form-label">Danh mục cửa hàng</label>
                    <input type="text" data-role="tagsinput" name="name_cate" value="{{ old('name_cate') }}"
                        id="category" placeholder="Danh mục cửa hàng" class="form-control">
                </div>
                <div class=" mb-3">
                    <label for="" class="form-label">Châm ngôn</label>
                    <input type="text" name="slogan" placeholder="Slogan" value="{{ old('slogan') }}"
                        class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Thông điêp</label>
                    <input type="text" class="form-control" value="{{ old('message') }}"
                        placeholder="Muốn ghi gì thì ghi" name="message">
                </div>
                <div class=" mb-3">
                    <label for="" class="form-label">Thành phố/ Tỉnh</label>
                    {{-- <input type="text" name="city" value="{{ old('city') }}" placeholder="Hồ Chí Minh"
                        class="form-control"> --}}
                    <select name="city" class="form-control" id="city"></select>
                </div>
                <div class=" mb-3">
                    <label for="" class="form-label">Quận/ Huyện</label>
                    {{-- <input type="text" name="district" value="{{ old('district') }}" placeholder="Gò Vấp"
                        class="form-control"> --}}

                    <select name="district" class="form-control" id="district"></select>
                </div>
                <div class=" mb-3">
                    <label for="" class="form-label">Địa chỉ</label>
                    <input type="text" name="address" value="{{ old('address') }}"
                        placeholder="923/212 đường Dương Đông Kích Tây" class="form-control">
                </div>
                <div class="avatar-upload  mb-3">
                    <label for="">Ảnh đại diện</label>
                    <div class="col-md-2 change-avatar">
                        <div class="avatar d-flex justify-content-center align-items-center bg-dark rounded-circle col-lg-12"
                            style="--bs-bg-opacity: .3; width: 204px;">
                            <img src="{{ asset('upload/profile/avatar/' . auth()->user()->avatar) }}" alt=""
                                class="img-fluid file_image" style="z-index: -1;" />
                            <div
                                class="text-change-image text-white img-fluid text-center d-flex flex-column align-items-center justify-content-center">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.5 5H7.5C6.83696 5 6.20107 5.26339 5.73223 5.73223C5.26339 6.20107 5 6.83696 5 7.5V20M5 20V22.5C5 23.163 5.26339 23.7989 5.73223 24.2678C6.20107 24.7366 6.83696 25 7.5 25H22.5C23.163 25 23.7989 24.7366 24.2678 24.2678C24.7366 23.7989 25 23.163 25 22.5V17.5M5 20L10.7325 14.2675C11.2013 13.7988 11.8371 13.5355 12.5 13.5355C13.1629 13.5355 13.7987 13.7988 14.2675 14.2675L17.5 17.5M25 12.5V17.5M25 17.5L23.0175 15.5175C22.5487 15.0488 21.9129 14.7855 21.25 14.7855C20.5871 14.7855 19.9513 15.0488 19.4825 15.5175L17.5 17.5M17.5 17.5L20 20M22.5 5H27.5M25 2.5V7.5M17.5 10H17.5125"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                </svg>
                                <span>Change Image</span>
                            </div>

                            <input type="file" name="avatar" id=""
                                class="form-control file-upload opacity-0" accept="image/*">

                        </div>
                    </div>
                </div>
                <div class="avatar-upload  mb-3">
                    <label for="">Ảnh bìa</label>
                    <div class="file-upload">
                        <button class="file-upload-btn" type="button"
                            onclick="$('.file-upload-input').trigger( 'click' )">Thêm
                            hình ảnh</button>

                        <div class="image-upload-wrap">
                            <input class="file-upload-input" type='file' name="background"
                                onchange="readURL(this);" accept="image/*" />
                            <div class="drag-text">
                                <h3>Kéo và thả ảnh bạn vào tại đây</h3>
                            </div>
                        </div>
                        <div class="file-upload-content">
                            <img class="file-upload-image" src="#" alt="your image" />
                            <div class="image-title-wrap">
                                <button type="button" onclick="removeUpload()" class="remove-image">Xoá <span
                                        class="image-title">Uploaded Image</span></button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary fs-3 w-95">Đăng ký</button>
            </div>

        </form>
        <div class="col-lg-4">
            Lưu ý
        </div>
    </div>
    @else
    <div class="alert alert-success">
        Chúng tôi đang xem xét gian hàng của bạn, hãy kiên nhẫn đợi.
    </div>
    @endif
       
  
@endsection
