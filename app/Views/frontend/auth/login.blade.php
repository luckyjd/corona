@extends('layouts.frontend.layouts.auth')
@section('content')
    @php MyForm::setForeShowError(false) @endphp
    <div class="row col-md-3" style="margin: 0 auto;padding: 5px">

        @if(!frontendGuard()->user())
            <div class="text-center" style="margin-right: 10px">
                <a class="btn btn-primary" href="" data-toggle="modal" data-target="#login_dialog">
                    <span class="ls-icon ls-icon-check" aria-hidden="true">Show Popup Login</span>
                </a>
            </div>

        @else
            <div class="text-center" style="margin-right: 10px">
                <a class="btn btn-default" href="{{route('frontend.logout')}}">
                    <span class="ls-icon ls-icon-check" aria-hidden="true">Logout</span>
                </a>
            </div>
        @endif
        <div class="text-center" >
            <a class="btn btn-primary" href="" data-toggle="modal" data-target="#register_user_dialog">
                <span class="ls-icon ls-icon-check" aria-hidden="true">Show Popup Register</span>
            </a>
        </div>

    </div>
    @if($isShowRegisterDialog)
        <script>
            $(function () {
                $('#register_user_dialog').modal('show');
            })
        </script>
    @endif

@stop