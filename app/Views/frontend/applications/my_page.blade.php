@extends('layouts.frontend.layouts.main')
@section('content')
    <section class="main1" id="user_info">
        @include('frontend.applications.user_info')
    </section>
    <section class="main1 main-content present-myPage">
        <div class="main1-note-bg"></div>
        <div class="album">
            <div class="container">
                <div class="text-center">
                    <h3 class="notosans-cjk-jp-bold-fix">ご希望の景品を<br class="sp">選択してください。</h3>
                </div>
                <ul class="presentTitle presentTitle-1pt">
                    <li><div class="stroke">&nbsp;</div></li>
                    <li><span class="presentTitle-sub presentTitle-sub-1pt">今すぐ応募</span></li>
                    <li><div class="stroke">&nbsp;</div></li>
                </ul>
                <div class="clearfix">&nbsp;</div>
                <div class="row" id="presents_one_pt">
                    @include('frontend.applications.present1', ['presentsOnePt' => $presentsOnePt])
                </div>
                <ul class="presentTitle presentTitle-5pt">
                    <li><div class="stroke pc">&nbsp;</div></li>
                    <li><span class="presentTitle-sub presentTitle-sub-5pt">５ポイント貯めて応募</span></li>
                    <li><div class="stroke pc">&nbsp;</div></li>
                </ul>
                <div class="clearfix">&nbsp;</div>
                <div class="row pt-4" id="presents_five_pt">
                    @include('frontend.applications.present5', ['presentsFivePt' => $presentsFivePt])
                </div>
            </div>
        </div>
    </section>
@stop

