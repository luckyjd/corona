@if(isset($_isShowRequestResetPasswordDialog) && $_isShowRequestResetPasswordDialog)
    <script>
        $(function () {
            $('#request_reset_password_dialog').modal('show');
        })
    </script>
@endif

<div class="modal" id="request_reset_password_dialog" tabindex="-1" role="dialog">
    <div class="modal-dialog reset-pass-modal" style="z-index: inherit;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title noto-sans-cjk-ip-bold" id="modal-label"></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true"><img class="card-img-top" src="{{public_url('css/frontend/images/x.png')}}"></span>
                </button>
            </div>
            <div class="modal-body col-md-10">
                <h2 class="title-rs text-center corona-headlinen-semi-bold"><span>{{tf('password.reset.request_reset_password')}}</span></h2>
                <hr class="hr">
                <div class="container noto-sans-cjk-ip-medium">
                    <div class="wrapper row ">
                        <div class="col-12 p-0" style="margin: 0 auto">
                            {{MyForm::open(['route'=>'frontend.password.email', 'pb-autologin'=> 'true','autocomplete'=>'off', 'id' => 'form_request_reset_password', 'class'=>'custom-submit'])}}
                            <div class="loginBox-in form loginform">
                                <div class="col-md-12">
                                    <div class="ajax_msg auto-reset">
                                        {{-- show by ajax response --}}
                                    </div>
                                    <p>{{tf('password.request.please_enter_your_email')}}
                                        <br>{{tf('password.request.we_will_send_an_email_to_reset_password')}}</p>
                                    <p><i class="ls-icon ls-icon-user text-info"></i> {{tf('password.request.email_half_width_characters')}}</p>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! MyForm::email('email', '', ['placeholder'=> trans('frontend.password.request.email'), 'class' => 'sizeL', 'maxlength' => 128, 'autocomplete' => 'off']) !!}
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-lg btn-block bg-btn-dark" >{{tf('password.request.send')}}</button>
                                    </div>
                                </div>
                            </div>
                            {!! MyForm::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>