@extends('home.layout.main')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="pages--auth">
        <div class="pages--auth--content">
            <div class="pages--auth--content__grid">
                <div class="pages--auth--content__grid__box">
                    <div class="pages--auth--content__grid__box__head">
                        <p>start for free</p>
                        <h2>Login now for start <span>.</span></h2>
                        <p>I dont't Account? <a href="{{ route('register') }}">Register</a></p>
                    </div>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="pages--auth--content__grid__box__content">

                            <div class="input__content">
                                <div>
                                    <label for="email">Email</label>
                                    <input type="email" class="input_auth" name="email" id="email"
                                        value="{{ old('email') }}">
                                </div>
                                <ion-icon name="mail-outline"></ion-icon>
                            </div>

                            <div class="input__content">
                                <div>
                                    <label for="password">Password</label>
                                    <input type="password" class="input_auth" name="password" id="password">
                                </div>
                                <ion-icon name="eye-outline"></ion-icon>
                            </div>
                            <div class="input-form">
                                <input type="checkbox" name="remember" id="remember"><label for="remember">Ghi nhớ tôi?</label>
                            </div>
                            <div class="button__group">
                                <button><a href="{{ route('password.request') }}">Forgot password</a></button>
                                
                                <button type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
