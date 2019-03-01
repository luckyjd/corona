@if(isset($_isShowRegisterDialog) && $_isShowRegisterDialog)
    <script>
        $(function () {
            $('#register_user_dialog').modal('show');
        })
    </script>
@endif
<div class="modal " id="register_user_dialog" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-login ">
        <div class="modal-content modal-newAcount">
            <div class="modal-header">
                <h4 class="modal-title noto-sans-cjk-ip-bold" id="modal-label"></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true"><img class="card-img-top" src="{{public_url('css/frontend/images/x.png')}}"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-10 noto-sans-cjk-ip-medium p-0">
                    <h3 class="modal-title text-center">NEW ACCOUNT</h3>
                    <p class="note-rq text-center"> <span class=""><img class="img-link img-req" src="{{public_url('css/frontend/images/require.png')}}" alt=""></span>印のついた入力項目は全て必須となっておりますので、必ずご入力をお願いいたします。</span></p>
                    <div class="row gap-20" >
                        <div class="col-md-12">
                            <div class="bgc-white p-20 bd">
                                <div class="mT-30">
                                    {!! MyForm::open(array('route' => array('register_user.ajaxRegisterUser', ''), 'id' => 'form_register_user', 'class' => 'custom-submit' ))!!}
                                    <div class="form-group">
                                        <div class="ajax_msg auto-reset">
                                            {{-- show by ajax response --}}
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label class="col-md-12 col-form-label" for="InputName">姓 <img class="img-link img-req" src="{{public_url('css/frontend/images/require.png')}}" alt=""></span></label>
                                            <div class="col-md-12">
                                                {!! MyForm::text('last_name', '',['placeholder'=> '姓', 'maxlength' => 64]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="col-md-12 col-form-label" for="InputName">名 <img class="img-link img-req" src="{{public_url('css/frontend/images/require.png')}}" alt=""></span></label>
                                            <div class="col-md-12">
                                                {!! MyForm::text('first_name', '',['placeholder'=> '名', 'maxlength' => 64]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="col-md-12 col-form-label" for="InputName">Emailアドレス <img class="img-link img-req" src="{{public_url('css/frontend/images/require.png')}}" alt=""></span></label>
                                            <div class="col-md-12">
                                                {!! MyForm::email('email', '',['placeholder'=> 'メールアドレス', 'autocomplete' => 'off']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6 ">
                                            <label class="col-md-12 col-form-label" for="InputName">パスワード <img class="img-link img-req" src="{{public_url('css/frontend/images/require.png')}}" alt=""></span></label>
                                            <div class="col-md-12">
                                                {!! MyForm::password('password', ['placeholder'=> '8文字以上', 'maxlength' => 64, 'autocomplete' => 'off']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label class="col-md-12 col-form-label" for="InputName">都道府県 <img class="img-link img-req" src="{{public_url('css/frontend/images/require.png')}}" alt=""></span></label>
                                            <div class="col-md-6 province-name">
                                                {!! MyForm::dropdown('pref_id', '', getConfig('prefs')) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center" style="margin: 0 auto">
                                        <div class="priva_des">
                                            個人情報の取り扱いについては、以下に記載されているプライバシーポリシーを遵守します。
                                            同意いただける場合は、「同意する」にチェックを付け、確認画面へお進みください。
                                        </div>
                                        <a class="privacy_policy" target="_blank" href="{{route('privacypolicy')}}" style="text-decoration: underline">プライバシーポリシー </a>
                                        <div class="gr-ckbox text-center">
                                            <div class="custom-control custom-checkbox" style="margin-bottom: 15px">
                                                <input type="checkbox" class="custom-control-input" id="cb_agreement">
                                                <label class="custom-control-label" for="cb_agreement">プライバシーポリシーに同意する </label>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <span>
                                                <button class="btn btn-register-user" type="submit" disabled>
                                                    <span class="ti-create" aria-hidden="true"> {{trans('actions.register_user')}}</span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>

                                    <div id="data_social">{!! MyForm::hidden('from_social', '',[]) !!}</div>
                                    {!! MyForm::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>