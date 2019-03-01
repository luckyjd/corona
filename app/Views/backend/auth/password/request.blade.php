@extends('layouts.backend.layouts.auth')
@section('content')
    @php MyForm::setForeShowError(true) @endphp
    <div class="container">
        <div class="wrapper">
            {{MyForm::open(['route'=>'backend.password.email', 'pb-autologin'=> 'true','autocomplete'=>'off', 'id' => 'form-reset-pass', 'class'=>'form-signin'])}}
            <h3 class="form-signin-heading">
                <img src="{{public_url('/css/backend/img/logo-login.png')}}" height="104" alt="Management">
            </h3>
            <hr class="hr">
            <h2 class="text-center"><span>パスワードを忘れた場合</span></h2>
            <div class="loginBox-in form loginform">
                @include('layouts.backend.elements.messages')
                <p>{{tb('password.request.please_enter_your_email')}}
                    <br>{{tb('password.request.we_will_send_an_email_to_reset_password')}}</p>
                <p><i
                            class="ls-icon ls-icon-user text-info"></i> {{tb('password.request.email_half_width_characters')}}
                </p>
                <div class="form-group">
                    <i class="ls-icon ls-icon-mail text-info"></i><label>{{tb('password.request.email')}}</label>
                    {!! MyForm::email('email', '', ['placeholder'=> trans('backend.password.request.email'), 'required'=> true, 'class' => 'sizeL', 'maxlength' => 128]) !!}
                </div>

                <div class="form-group">
                    <a class="btn btn-lg btn-main-color btn-block" href="javascript:void(0)"
                       onclick="document.getElementById('form-reset-pass').submit()">{{tb('password.request.send')}}</a>
                </div>
                <p class="text-center">
                    <a class="btn btn-lg btn-block btn-primary" href="{{getBackUrl()}}">{{trans('actions.back')}}</a>
                </p>
            </div>
        </div>
        {!! MyForm::close() !!}

    </div>
@stop