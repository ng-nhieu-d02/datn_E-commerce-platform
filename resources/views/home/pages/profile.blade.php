@extends('home.layout.profile')
@section('content')
    <form action="{{ route('user.update_profile') }}" method="POST" enctype="multipart/form-data" class="show-profile col-md-12 d-flex justify-content-between">
        @csrf
        
        <div class="d-flex gap-5 flex-wrap col-md-9">
            <div class="col-md-5">
                <x-input-label for="name" :value="__('Full name')" />

                <x-text-input id="name" class="form-control fs-2" type="text" name="name" :value="auth()->user()->name" required autofocus />
            </div>
            <div class="col-md-5">
                <x-input-label for="username" :value="__('Username')" />

                <x-text-input id="username" class="form-control fs-2" type="text" name="username" :value="auth()->user()->username" required autofocus />
            </div>
            <div class="col-md-5">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="form-control fs-2 " type="email" name="email" :value="auth()->user()->email" required autofocus />
            </div>
            <div class="col-md-5">
                <x-input-label for="phone" :value="__('phone')" />

                <x-text-input id="phone" class="form-control fs-2 " type="text" name="phone" :value="auth()->user()->phone" required autofocus />
            </div>
            <div class="gender col-md-12">
                <x-input-label for="gender" :value="__('Gender')" />
                <div class="col-md-5 form-check">

                    <input type="radio" class="form-check-input" name="gender" id="" value="man" {{ auth()->user()->gender === 'man' ? 'checked' : '' }}>
                    <span>Man</span>
                </div>

                <div class="col-md-5 form-check">

                    <p></p>
                    <input type="radio" class="form-check-input" name="gender" id="" value="women" {{ auth()->user()->gender === 'women' ? 'checked' : '' }}>
                    <span>Women</span>
                </div>
                <div class="col-md-5 form-check">


                    <input type="radio" class="form-check-input" name="gender" id="" value="other" {{ auth()->user()->gender === 'other' ? 'checked' : '' }}>
                    <span>Other</span>
                </div>
            </div>
            <div class="col-md-12">
                <x-primary-button class="btn btn-primary fs-3">
                    Update
                </x-primary-button>
            </div>
        </div>
        <div class="col-md-2 change-avatar">
            <div class="avatar d-flex justify-content-center align-items-center bg-dark rounded-circle" style="--bs-bg-opacity: .3;">
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="" class="img-fluid file_image" style="z-index: -1;" />
                <div class="text-change-image text-white img-fluid text-center d-flex flex-column align-items-center justify-content-center">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5 5H7.5C6.83696 5 6.20107 5.26339 5.73223 5.73223C5.26339 6.20107 5 6.83696 5 7.5V20M5 20V22.5C5 23.163 5.26339 23.7989 5.73223 24.2678C6.20107 24.7366 6.83696 25 7.5 25H22.5C23.163 25 23.7989 24.7366 24.2678 24.2678C24.7366 23.7989 25 23.163 25 22.5V17.5M5 20L10.7325 14.2675C11.2013 13.7988 11.8371 13.5355 12.5 13.5355C13.1629 13.5355 13.7987 13.7988 14.2675 14.2675L17.5 17.5M25 12.5V17.5M25 17.5L23.0175 15.5175C22.5487 15.0488 21.9129 14.7855 21.25 14.7855C20.5871 14.7855 19.9513 15.0488 19.4825 15.5175L17.5 17.5M17.5 17.5L20 20M22.5 5H27.5M25 2.5V7.5M17.5 10H17.5125" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <span>Change Image</span>
                </div>

                <input type="file" name="file_image" id="" class="form-control file-upload opacity-0" accept="image/*">

            </div>
            <P class="badge bg-primary text-wrap text-center mt-2">Chỉ chấp nhận file JPG,JPEG,PNG</P>
        </div>
    </form>
@endsection