<div class="col-12 banner-container banner">
    @php $point = $currentUser->point; @endphp
    <div class=infor-user>
        <p class="user-name">{{$currentUser->last_name . ' ' .  $currentUser->first_name}} さん <br><a class="lbl-logout" href="/logout">LOGOUT</a></p>
        <p class="user-point">
            <span class="number-point corona-headlinen-semi-bold" id="user_point">{{ $point ? rjust($point, 2, 0) : '00' }}</span>
            <span class="text-point corona-headlinen-semi-bold">PT</span>
        </p>
    </div>
    <div class="row">
        <ul class="beers">
            @php
                $img = isIE() ? public_url('css/frontend/images/my-page/icon-beer-active-ie.png') : public_url('css/frontend/images/my-page/icon-beer-active.png');
                $imgHidden = isIE() ? public_url('css/frontend/images/my-page/icon-beer-hidden.png') : public_url('css/frontend/images/my-page/icon-beer-hidden.svg');
                $max = $point > 5 ? 10 : 5;
            @endphp
            @if($point < $max)
                @for($i=0; $i<$point; $i++)
                    <li><img class="" src="<?php echo $img; ?>"></li>
                @endfor
                @for($i=0; $i<$max-$point; $i++)
                    <li><img class="" src="<?php echo $imgHidden; ?>"></li>
                @endfor
            @elseif ($point>=$max)
                @for($i=0; $i<$max; $i++)
                    <li><img class="" src="<?php echo $img; ?>"></li>
                @endfor
            @endif
        </ul>
    </div>
    <a href="/" style="display: block">
        <div class="navbar campain-icon bg-trans  montserrat-semi-bold text-center">
            <span class="corona-headlinen-semi-bold campain-fix-corona">CAMPAIGN</span>
            <span class="corona-headlinen-semi-bold campain-fix-top">TOP</span>
        </div>
    </a>
</div>