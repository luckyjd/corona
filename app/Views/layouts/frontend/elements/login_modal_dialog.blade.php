@if(isset($_isShowLoginDialog) && $_isShowLoginDialog)
    <script>
        $(function () {
            $('#login_dialog').modal('show');
        })
    </script>
@endif
<div class="modal auto-reset fade" id="login_dialog" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-login">
        <div class="modal-content modal-login">
            <div class="modal-header">
                <h4 class="modal-title noto-sans-cjk-ip-bold" id="modal-label"></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true"><img class="card-img-top login-modal__x" src="{{public_url('css/frontend/images/x.png')}}"></span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="modal-title text-center corona-headlinen-semi-bold">LOGIN</h3>
                <div class="ajax_msg auto-reset">
                    {{-- msg default from social login --}}
                    @include('layouts.frontend.elements.messages')
                    {{-- msg show by ajax response --}}

                </div>
                <div class="wrapper row">
                    <div class="col-md-5 login-modal__fb">
                        <div class="form-group">
                            <div class="box-title box-title-fix-center">ソーシャルアカウントでログイン </div>
                            <a href="{{route('auth.login.facebook')}}" class="btn btn-lg btn-block btn-fb" type="button" style="border: 0" onclick="showLoading();"></a>
                            {{--<a href="{{route('auth.login.google')}}" class="btn btn-lg btn-danger btn-block" type="button">{{trans('actions.login_with_google')}}</a>--}}
                            {{--<a href="{{route('auth.login.twitter')}}" class="btn btn-lg btn-info btn-block" type="button">{{trans('actions.login_with_twitter')}}</a>--}}
                        </div>
                    </div>
                    <div class="col-md-2 socials"></div>
                    <div class="col-md-5 box-login login-modal__input">
                        <div class="box-title box-title-fix-center">メールアドレスでログインする </div>
                        {{MyForm::open(['route'=>'frontend.login','class'=>'form-login custom-submit', 'id' => 'form_login'])}}
                        <div class="form-group">

                        </div>
                        <div class="form-group">
                            {!! MyForm::email('email', '', ['placeholder' => 'メールアドレス', 'autocomplete' => 'off']) !!}
                        </div>

                        <div class="form-group">
                            {!! MyForm::password('password', ['placeholder' => 'パスワード', 'autocomplete' => 'off']) !!}
                        </div>

                        <div class="form-group">
                            <button class="btn btn-lg btn-block btn-login" type="submit">
                            </button>
                        </div>
                        <div class="col-md-12 gr-link">
                            <div class="row">
                                <div class="rg-gr form-group col-md-6 text-center p-0">
                                    <a href="#" data-toggle="modal" data-target="#register_user_dialog" onclick="$('#login_dialog').removeClass('fade').modal('hide');">
                                        新規で会員登録する
                                    </a>
                                </div>
                                <div class="rs-gr form-group col-md-6 text-center p-0">
                                    <a href="#" data-toggle="modal" data-target="#request_reset_password_dialog" onclick="$('#login_dialog').removeClass('fade').modal('hide');">パスワードを忘れた方</a>
                                </div>
                            </div>
                        </div>

                        {!! MyForm::hidden('return_url') !!}
                        {!! MyForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>