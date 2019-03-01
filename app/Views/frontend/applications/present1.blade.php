@foreach($presentsOnePt as $present)
    <div class="col-md-4 col-lg-3 product-box present-box">
        <div class="card box-shadow product-container product-1-point product-container-fix product-1point-mypage-fix present-wrapper">
            <div class="present-body">
                <div class="present-quantity">
                    <div class="presentQty-container">
                        <img class="present_qty_bg" src="{{public_url('css/frontend/images/present_qty_bg.png')}}" alt="{{$present->name}}">
                        <p class="present-qty-numb"><span>{{$present->quantity}}</span><br><span class="present_qty_text">名様</span></p>
                    </div>
                </div>
                <div class="present-flex-small">
                    <div class="present-thumb">
                        <img class="presentThumbImg" src="{{$present->image}}" alt="{{$present->name}}">
                    </div>
                </div>
                <div class="present-body-info">
                    <div class="present-name-wrapper">
                        <div class="present-name">
                            {{$present->name}}
                        </div>
                    </div>
                    <div class="present-introduction-wrapper">
                        <div class="present-introduction">
                            <p>{!! ebr($present->introduction) !!}</p>
                        </div>
                    </div>
                    <div class="present-bottom">
                        @if($currentUser->point >= getConstant('SCORE_PRESENT_1_PT'))
                            <a href="javascript:void(0)" class="card-button-link btn-present" data-disable="1"
                               data-id="{{$present->getKey()}}" style="text-decoration: none">
                                <p class="point-button-fix">
                                    <span class="corona-headlinen-semi-bold point-button-fix-jp__pt">1PT</span>
                                    <span class="noto-sans-cjk-ip-bold point-button-fix-jp__text">で応募する</span>
                                </p>
                            </a>
                        @else
                            <a href="javascript:void(0)" class="card-button-link btn-present not-active" data-disable="1"
                               data-id="{{$present->getKey()}}">
                                <p class="point-button-fix">
                                    <span class="corona-headlinen-semi-bold point-button-fix-jp__pt">1PT</span>
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