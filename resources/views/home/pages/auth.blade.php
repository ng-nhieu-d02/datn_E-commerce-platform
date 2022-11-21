@extends('home.layout.main')

@section('content')

<div class="pages--auth">
    <div class="pages--auth--content">
        <div class="pages--auth--content__grid">
            <div class="pages--auth--content__grid__box">
                <div class="pages--auth--content__grid__box__head">
                    <p>start for free</p>
                    <h2>Create new account <span>.</span></h2>
                    <p>Already A Member? <a href="">Login</a></p>
                </div>
                <div class="pages--auth--content__grid__box__content">
                    <div class="input__group">
                        <div class="input__content">
                            <div>
                                <label for="first_name">First name</label>
                                <input type="text" class="input_auth" name="" id="first_name">
                            </div>
                            <ion-icon name="person-circle-outline"></ion-icon>
                        </div>
                        <div class="input__content">
                            <div>
                                <label for="last_name">Last name</label>
                                <input type="text" class="input_auth" name="" id="last_name">
                            </div>
                            <ion-icon name="person-circle-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="input__content">
                        <div>
                            <label for="email">Email</label>
                            <input type="email" class="input_auth" name="" id="email">
                        </div>
                        <ion-icon name="mail-outline"></ion-icon>
                    </div>
                    <div class="input__content">
                        <div>
                            <label for="phone">Phone number</label>
                            <input type="text" class="input_auth" name="" id="phone">
                        </div>
                        <ion-icon name="call-outline"></ion-icon>
                    </div>
                    <div class="input__content">
                        <div>
                            <label for="password">Password</label>
                            <input type="password" class="input_auth" name="" id="password">
                        </div>
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                    <div class="input__content">
                        <div>
                            <label for="password_confirm">Password Confirm</label>
                            <input type="password" class="input_auth" name="" id="password_confirm">
                        </div>
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                    <div class="button__group">
                        <button>Reset</button>
                        <button>Create account</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection