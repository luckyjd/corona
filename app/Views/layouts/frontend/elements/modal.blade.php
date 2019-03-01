<div class="modal fade" id="note" tabindex="-1" data-keyboard="false" data-backdrop="static">
    <input type="hidden" name="present_id">
    <div class="modal-dialog modal-lg modal-note">
        <div class="modal-content modal-note">
            <div class="modal-header modal-note-fix">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img
                                class="card-img-top card-img-top-x" src="{{public_url('css/frontend/images/x.png')}}"></span>
                </button>
                <h4 class="modal-title noto-sans-cjk-ip-bold modal-note__pc" id="modal-label">以下の景品に応募して<br class="sp">よろしいですか？</h4>
            </div>
            <div class="modal-body col-lg-6 modal-note__body">
                <div class="card-popup">
                    <div id="present_confirm_popup">

                    </div>
                    <div class="text-center rule">
                        <a href="{{route('privacypolicy')}}" target="_blank">
                            <img class="img-link" src="{{public_url('css/frontend/images/link.png')}}" alt="">
                            <span class="link-privacy" style="font-size: 12px">利用規約</span>
                        </a>
                    </div>
                    <div class="gr-ckbox text-center gr-ckbox-fix">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="cb_agreement_play_game[]" class="custom-control-input" id="cb_agreement_play_game">
                            <label class="custom-control-label" for="cb_agreement_play_game">利用規約に同意する </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center modal-footer modal-note__footer  btn-play-game__mb" style="margin: 15px 0 35px">
                    <span>
                        <button class="btn btn-play-game btn-register-user" id="btn-play-game" type="button" onclick="event.preventDefault();" disabled="disabled">
                              <span class="ti-create" aria-hidden="true"> 応募する</span>
                        </button>
                    </span>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="result" tabindex="-1"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-congrate">
        <div class="modal-content result-modal">
            @for($i = 1; $i<= 30; $i++)
                @php
                $rand = rand(1,4);
                @endphp
                <img src="{{public_url('css/frontend/images/star'.$rand.'.png')}}" class="rotate360 star star-{{$rand}}" id="star{{$i}}">
            @endfor
            <div id="overlay-result">
                <img src="{{public_url('css/frontend/images/big-star.png')}}" class="star-success" >
            </div>
            <div id="modal-result-container">
            </div>
        </div>
    </div>
</div>

{{--ship--}}

<div class="modal fade" id="ship" tabindex="-1" data-keyboard="false" data-backdrop="static">
    @php
    $user = frontendGuard()->user();
    $user  = $user ? $user : getModelFromTable(\App\Model\Entities\User::getTableName());
    @endphp
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-body ship-title p-0">
                <p class="noto-sans-cjk-ip-bold ship-popup__title">配送先をご記入ください</p>
                <div class="form-ship ship__sub-title">
                    <div class="helvetica-neue-medium require-icon-title">
                        <p class="require-before">印のついた入力項目は全て必須となっておりますので、必ずご入力をお願いいたします。</p>
                    </div>
                </div>
            </div>
            <form action="" class="form-ship">
                <div class="form-group">
                    <div id="update_address_ship_user_error_msg" class="auto-reset">
                        {{-- show by ajax response --}}
                    </div>
                </div>
                <div class="row m-0">
                    <div class="col-6 col-md-3 p-0">
                        <p></p>
                        <span class="name-col">姓</span><span class="helvetica-neue-medium require-icon">&nbsp;*</span>
                        <input type="text" class="input-text1" name="last_name" value="{{$user->last_name ? $user->last_name : ''}}">
                    </div>
                    <div class="col-6 col-md-3 pr-0">
                        <p></p>
                        <span class="name-col">名</span><span class="helvetica-neue-medium require-icon">&nbsp;*</span>
                        <input type="text" class="input-text1" name="first_name" value="{{$user->first_name ? $user->first_name : ''}}">
                    </div>
                    <div class="col-12 col-md-6 p-0">
                        <p></p>
                        <span class="name-col">Emailアドレス</span><span class="helvetica-neue-medium require-icon">&nbsp;*</span>
                        <input type="text" class="input-text" name="email" value="{{$user->email ? $user->email : ''}}">
                    </div>
                </div>
                <div class="div-zip  mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="div">
                                <div>
                                    <span class="name-col">郵便番号</span><span class="helvetica-neue-medium require-icon">&nbsp;*</span>
                                </div>
                                <input type="text" class="zip1" id="zip1" maxlength="3" name="zip1" value="{{ $user->zip_code ? convertZipcodeUser($user->zip_code)['zip1'] : '' }}"> -
                                <input type="text" class="zip2" id="zip2" maxlength="4" name="zip2" value="{{ $user->zip_code ? convertZipcodeUser($user->zip_code)['zip2'] : '' }}">
                            </div>
                        </div>
                        <p class="sp">&nbsp;</p>
                        <div class="col-md-8">
                            <div class="div-select">
                                <div>
                                    <span class="name-col">都道府県</span><span class="helvetica-neue-medium require-icon">&nbsp;*</span>
                                </div>

                                {!! MyForm::dropdown('pref_id', $user->pref_id, getConfig('prefs')) !!}
                                <input type="hidden" name="tmp_zip_code" id="tmp_zip_code">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="address mt-4">
                    <span class="name-col">ご住所</span><span class="helvetica-neue-medium require-icon">&nbsp;*</span><br>
                    <input type="text" class="input-address" name="address" value="{{$user->address ? $user->address : ''}}">
                </div>

                <div class="div-phone mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="div">
                                <div>
                                    <span class="name-col">お電話番号</span><span class="helvetica-neue-medium require-icon">&nbsp;*</span>
                                </div>
                                <input type="text" class="phone1" maxlength="4" name="phone1" value="{{ $user->tel ? convertTelUser($user->tel)['phone1'] : '' }}"> -
                                <input type="text" class="phone2" maxlength="4" name="phone2" value="{{ $user->tel ? convertTelUser($user->tel)['phone2'] : '' }}"> -
                                <input type="text" class="phone3" maxlength="4" name="phone3" value="{{ $user->tel ? convertTelUser($user->tel)['phone3'] : '' }}">
                            </div>
                        </div>
                        <p class="sp">&nbsp;</p>
                        <div class="col-md-6">
                            <div class="div-store">
                                <div>
                                    <span class="name-col">キャンペーンに参加した店舗</span>
                                </div>
                                <input type="text" class="store" name="store_list" value="{{$user->store_list ? $user->store_list : ''}}">
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <p class="text-center helvetica-neue-medium " style="font-size: 10px; width:100%; margin: 0 auto">
                    個人情報の取り扱いについては、以下に記載されているプライバシーポリシーを遵守します。 <br>
                    同意いただける場合は、「同意する」にチェックを付け、確認画面へお進みください。</p>
                <div class="text-center rule">
                    <a href="{{route('privacypolicy')}}" target="_blank">
                        <img class="img-link" src="{{public_url('css/frontend/images/link.png')}}" alt="">
                        <span class="link-privacy" style="font-size: 12px">プライバシーポリシー</span>
                    </a>
                </div>

                <div class="gr-ckbox text-center">
                    <div class="custom-control custom-checkbox width225">
                        <input type="checkbox" name="cb_agreement_address_ship[]" class="custom-control-input" id="cb_agreement_address_ship">
                        <label class="custom-control-label" for="cb_agreement_address_ship">プライバシーポリシーに同意する </label>
                    </div>
                </div>

                <div class="gr-ckbox text-center mb-3">
                    <div class="custom-control custom-checkbox width225">
                        <input type="checkbox" name="cb_agreement_recieve_email[]" checked="checked" class="custom-control-input" id="cb_agreement_recieve_email">
                        <label class="custom-control-label" for="cb_agreement_recieve_email">Coronaのメルマガ配信を希望する </label>
                    </div>
                </div>

                <div class="text-center" style="margin-bottom: 35px">
                    <span>
                        <button class="btn btn-register-address-ship btn-register-user ship-fix" type="button" onclick="event.preventDefault();" disabled="disabled">
                            <span class="ti-create sp" aria-hidden="true"> 入力内容を確認する</span>
                            <span class="ti-create pc" aria-hidden="true"> 入力内容を確認</span>
                        </button>
                    </span>
                </div>
            </form>

        </div>
    </div>
</div>


<div class="auth">
    @include('layouts.frontend.elements.login_modal_dialog')
    @include('layouts.frontend.elements.register_user_modal_dialog')
    @include('layouts.frontend.elements.request_reset_password_modal_dialog')
    @include('layouts.frontend.elements.reset_password_modal_dialog')
</div>