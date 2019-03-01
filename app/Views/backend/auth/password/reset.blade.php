@extends('layouts.backend.layouts.auth')
@section('content')
    <div class="wrap-in mypage-login">
        <div class="loginBox">
            {{MyForm::open(['url'=> route('backend.password.reset', ['token'=>$token]), 'pb-autologin'=> 'true','autocomplete'=>'off', 'id' => 'form-reset-pass', 'class'=>'form-signin'])}}
            <h3 class="form-signin-heading">
                <img src="{{public_url('/css/backend/img/logo-login.png')}}" height="104" alt="Management">
            </h3>
            <hr class="hr">
            <h2 class="text-center"><span>{{tb('password.reset.reset_password')}}</span></h2>

            <p>{{tb('password.reset.please_enter_the_new_password')}}</p>
            <p> {{tb('password.request.email_half_width_characters')}}</p>
            @include('layouts.backend.elements.messages')
            <div class="form-group">
                <label for="usr">{{tb('password.reset.password')}}</label>
                {!! MyForm::showError(false)->password('password', ['placeholder'=>trans('backend.password.reset.password'), 'required'=> true, 'class' => 'sizeM', 'maxlength' => 128]) !!}
            </div>
            <div class="form-group">
                <label for="usr">{{tb('password.reset.password_confirm')}}</label>
                {!! MyForm::showError(false)->password('password_confirmation', ['placeholder'=>trans('backend.password.reset.password_confirm'), 'required'=> true, 'class' => 'sizeM', 'maxlength' => 128]) !!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-main-color btn-lg btn-block">{{tb('password.reset.confirm')}}</button>
            </div>
            {!! MyForm::close() !!}
        </div>
    </div>
@stop