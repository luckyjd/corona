@if(isset($_tokenShowResetPasswordDialog) && $_tokenShowResetPasswordDialog)
    <div class="modal " id="reset_password_dialog" tabindex="-1" role="dialog">
        <div class="modal-dialog " style="z-index: inherit;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title noto-sans-cjk-ip-bold" id="modal-label"></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true"><img class="card-img-top" src="{{public_url('css/frontend/images/x.png')}}"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2 class="text-center"><span>{{tf('password.reset.reset_password')}}</span></h2>
                    <hr class="hr">
                    <div class="container noto-sans-cjk-ip-medium">
                        <div class="wrap-in mypage-login col-md-10" style="margin: 0 auto">
                            {{MyForm::open(['url'=> route('frontend.password.reset', ['token'=>$_tokenShowResetPasswordDialog]), 'pb-autologin'=> 'true','autocomplete'=>'off', 'id' => 'form_reset_password', 'class'=>'custom-submit'])}}
                            <div class="col-md-12">
                                <p>{{tf('password.reset.please_enter_the_new_password')}}</p>
                                <p> {{tf('password.request.email_half_width_characters')}}</p>

                                <div class="ajax_msg auto-reset">
                                    {{-- show by ajax response --}}
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="usr">{{tf('password.reset.password')}}</label>
                                    {!! MyForm::showError(false)->password('password', ['placeholder'=>trans('frontend.password.reset.password'), 'class' => 'sizeM', 'maxlength' => 128]) !!}
                                </div>
                                <div class="form-group">
                                    <label for="usr">{{tf('password.reset.password_confirm')}}</label>
                                    {!! MyForm::showError(false)->password('password_confirmation', ['placeholder'=>trans('frontend.password.reset.password_confirm'), 'class' => 'sizeM', 'maxlength' => 128]) !!}
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-block bg-btn-dark">{{tf('password.reset.confirm')}}</button>
                                </div>
                            </div>
                            {!! MyForm::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(function () {
                $('#reset_password_dialog').modal('show');
            })
        </script>
    </div>

@endif
