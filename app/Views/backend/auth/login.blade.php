@extends('layouts.backend.layouts.auth')
@section('content')
    @php MyForm::setForeShowError(false) @endphp
    <div class="container">
        <div class="wrapper">
            {{MyForm::open(['route'=>'backend.login','class'=>'form-signin'])}}
            <h3 class="form-signin-heading">
                <img src="{{public_url('/css/backend/img/logo-login.png')}}" height="104" alt="Management">
            </h3>
            <hr class="hr">
            <br>
            @include('layouts.backend.elements.messages')
            <p>
                <span class="ls-icon ls-icon-user text-info"
                      aria-hidden="true">{{$entity->getAttributeName('email')}}</span>
                {!! MyForm::email('email', $entity->email, ['placeholder' => $entity->getAttributeName('email'), 'required'=>'required']) !!}
            </p>
            <p>
                <span class="ls-icon ls-icon-key text-info" aria-hidden="true">{{$entity->getAttributeName('password')}}</span>
                {!! MyForm::password('password', ['placeholder' => $entity->getAttributeName('password'), 'required'=>'required']) !!}
            </p>
            <button class="btn btn-lg btn-main-color btn-block" name="Submit" value="Login" type="Submit">
                <span class="ls-icon ls-icon-login" aria-hidden="true">{{trans('actions.login')}}</span>
            </button>
            <p class="text-center">
                <br/>
                <a href="{{backUrl('backend.password.request')}}">{{trans('actions.reset_password')}}</a>
            </p>

            {!! MyForm::hidden('return_url') !!}
            {!! MyForm::close() !!}
        </div>
    </div>
@stop