@extends('layouts.frontend.layouts.main')
@section('content')
    <section class="js-first-section">
        <div class="jumbotron text-center top-banner js-bg top-banner-fix__sp" {!! isMobile() ? 'style="opacity: 0.8"' : '' !!}>
        </div>
        <div class="top-text wow fadeIn" data-wow-duration="2s" data-wow-delay="{{isMobile() ? '1.8' : '2.5'}}s">
            <p class="title-top__list">WINTER ESCAPE CAMPAIGN</p>
            <p class="content-top__list notosans-cjk-jp-bold-fix">参加店舗一覧</p>
        </div>
    </section>
    <div class="container">
        @foreach($listShop as $pref => $shopsByAddress)
            <ul class="presentTitle presentTitle-1pt">
                <li>
                    <div class="stroke">&nbsp;</div>
                </li>
                <li>
                    <span class="presentTitle-sub presentTitle-sub-1pt">{!!$pref !!}</span>
                </li>
                <li>
                    <div class="stroke">&nbsp;</div>
                </li>
            </ul>
            <div class="row list-store-container">
                @foreach($shopsByAddress as $shopsByAddress1)
                    @foreach($shopsByAddress1 as $shops)
                            @foreach($shops as $shop)
                            <div class="col-xs-12 col-md-5 list-store__title">
                                <div class="title-store">{{ $shop->name }}</div>
                                <br>
                                <p class="noto-sans-cjk-ip-medium shop_address">{!! $shop->addressText() !!}</p>
                                <p class="noto-sans-cjk-ip-medium shop_tel">TEL： {!! $shop->telText() !!}</p>
                            </div>
                            <div class="col-md-1"></div>
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        @endforeach
    </div>
    </section>
@stop