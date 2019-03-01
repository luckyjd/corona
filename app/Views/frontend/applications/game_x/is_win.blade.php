<div class="modal-content congrate">
    <div class="modal-content-x">
        <div class="modal-body p-0">
            <div class="container">
                <div class="row congrate-title-fix-padding">
                    <div class="min-max-305">
                    </div>
                    <div class="col-lg-5 col-md-6 congrate-container p-0 min-max-374">
                        <div class="img-comp-container">
                            <div class="img-comp-img congrate-title-fix768" id="con1">
                                <img src="{{public_url('css/frontend/images/con1.svg')}}">
                            </div>
                            <div class="img-comp-img img-comp-overlay" id="con2">
                                <img src="{{public_url('css/frontend/images/con2.svg')}}">
                            </div>
                        </div>
                    </div>
                    <div class="min-max-305">
                    </div>
                </div>
            </div>
        </div>
        <p class="noto-sans-cjk-ip-bold desc-modal congrate-title-fix-padding">ご当選おめでとうございます！</p>
        <div class="row m-0">
            <div class="pc min-max-305"><p class="text-center"><img class="img-link frozen" src="{{public_url('css/frontend/images/frozen.png')}}" alt=""></p></div>
            <div class="col-lg-4 col-md-6 p-0 min-max-339">
                <div class="card-popup__congrate">
                    @include('frontend.applications.game_x.present')
                </div>
                <div class="modal-footer p-0">
                    <p class="congrate-btn"><a href="javascript:void(0)" onclick="showShipForm()"><img class="img-congrate"
                                                            src="{{public_url('css/frontend/images/congrate-popup.png')}}"
                                                            alt=""></a></p>
                </div>
            </div>
            <div class="min-max-305 pc frozen2"><p class="text-center"><img class="img-link frozen" src="{{public_url('css/frontend/images/frozen.png')}}" alt=""></p></div>
        </div>
    </div>

</div>