@foreach($presentsFivePt as $present)
    <div class="col-md-4 product-box present-box">
        <div class="card box-shadow product-container product-5-point product-container-fix product-5point-mypage-fix present-wrapper">
            <div class="present5pt-body">
                <div class="present-quantity">
                    <div class="presentQty-container">
                        <img class="present_qty_bg" src="{{public_url('css/frontend/images/present_qty_bg.png')}}" alt="{{$present->name}}">
                        <p class="present-qty-numb"><span>{{$present->quantity}}</span><br><span class="present_qty_text">名様</span></p>
                    </div>
                </div>
                <div class="present5pt-flex-small">
                    <div class="present5pt-thumb">
                        <img class="presentThumbImg" src="{{$present->image}}" alt="{{$present->name}}">
                    </div>
                </div>
                <div class="present5pt-body-info">
                    <div class="present5pt-name-wrapper">
                        <div class="present5pt-name">
                            {{$present->name}}
                        </div>
                    </div>
                    <div class="present5pt-introduction-wrapper">
                        <div class="present5pt-introduction">
                            <p>{!! ebr($present->introduction) !!}</p>
                        </div>
                    </div>
                    <div class="present5pt-bottom">
                        @if($currentUser->point >= getConstant('SCORE_PRESENT_5_PT'))
                            <a href="javascript:void(0)" class="card-button-link btn-present" data-disable="5"
                               data-id="{{$present->getKey()}}">
                                <p class="point-button-fix">
                                    <span class="corona-headlinen-semi-bold point-button-fix-jp__pt">5PT</span>
                                    <span class="noto-sans-cjk-ip-bold point-button-fix-jp__text">で応募する</span>
                                </p>
                            </a>
                        @else
                            <a href="javascript:void(0)" class="card-button-link btn-present not-active" data-disable="5"
                               data-id="{{$present->getKey()}}">
                                <p class="point-button-fix">
                                    <span class="corona-headlinen-semi-bold point-button-fix-jp__pt">5PT</span>
                                    <span class="noto-sans-cjk-ip-bold point-button-fix-jp__text">で応募する</span>
                                </p>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

