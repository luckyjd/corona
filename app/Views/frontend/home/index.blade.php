@extends('layouts.frontend.layouts.main')
@section('content')
    <section class="js-first-section">
        <div class="jumbotron text-center top-banner js-bg top-banner-fix__sp" {!! isMobile() ? 'style="opacity: 0.8"' : '' !!}></div>
        <div class="top-text wow fadeIn" data-wow-duration="2s" data-wow-delay="{{isMobile() ? '1.8' : '2.5'}}s">
            <p class="top-banner-content-img">
                <a href="javascript:void(0)">
                    <img class="img pc" width="400" alt="corona" src="{{public_url('css/frontend/images/top_banner.png')}}">
                    <img class="img sp" width="265" alt="corona" src="{{public_url('css/frontend/images/top_banner.png')}}">
                </a>
            </p>
        </div>
        <div class="navbar login-my-page bg-trans  montserrat-semi-bold text-center login-my-page-fix__bottom hide-ip-5">
            @if(frontendGuard()->user())
                <a href="{{route('my_page')}}" class="text-uppercase corona-headlinen-semi-bold text-bold">
                </a>
            @else
                <a href="javascript:void(0)" class="text-uppercase corona-headlinen-semi-bold text-bold"
                   data-toggle="modal" data-target="#login_dialog">
                </a>
            @endif

        </div>
    </section>

    <section class="main-content">
        <div class="show-ip-5" style="position: relative;display: none">
            <div class="navbar login-my-page bg-trans  montserrat-semi-bold text-center login-my-page-fix__bottom">
                @if(frontendGuard()->user())
                    <a href="{{route('my_page')}}" class="text-uppercase corona-headlinen-semi-bold text-bold">
                    </a>
                @else
                    <a href="javascript:void(0)" class="text-uppercase corona-headlinen-semi-bold text-bold"
                       data-toggle="modal" data-target="#login_dialog">
                    </a>
                @endif

            </div>
        </div>
        <div class="container">
            <div class="text-center">
                <h2 class="text-uppercase big-title main-color wow fadeInUp text-bold corona-headlinen-semi-bold big-title-1-fix__sp"  data-wow-duration="2s" data-wow-delay="{{ isMobile()? '0.2' : '3' }}s"> winter escape campaign</h2>
                <div class="noto-sans-cjk-ip-bold  wow fadeInUp"  data-wow-duration="2s" data-wow-delay="0.2s" >
                    <p class="note note-fix__sp">
                        合計1,000名に当たる！<br class="sp">コロナを飲んでこの冬を楽しもう！
                    </p>
                    <p class="pt-5 small-title mb-0">
                        キャンペーン期間
                    </p>
                    <p class="big-title mb-0 big-title-fix__sp">
                        2018年12月3日（月）～ 2019年2月28日（木）
                    </p>
                </div>
            </div>
            <div class="noto-sans-cjk-ip-medium pt-5">
                <p class="desc">
                    「CORONA ESCAPE CAMPAIGN」ではコロナを飲むともらえるカードのQRコードからサイトへ訪問すると、すぐ応募できる「すぐ当てる」かポイント
                    を貯めて応募する「ためて当てる」の二通りの方法でプレゼントに応募することができます。1ポイントですぐに応募するもよし、5ポイント貯めてさらに豪華な景品に挑戦するのもよし。こ
                    の冬はコロナを飲んでプレゼントを当てよう！
                </p>
            </div>
            <div class="step step-fix pt-5">
                <div class="step-1">
                    <div class="text-center wow fadeInUp" data-wow-duration="1s">
                        <img src="{{public_url('css/frontend/images/beer-qr-code.png')}}" class="img"
                             alt="corona">
                        <div class="pd-box">
                            <div class="pd-content text-left">

                                <img src="{{public_url('css/frontend/images/step1.png')}}" class="img img-step1 step1-fixcss" alt="corona">
                                <p class="step-desc noto-sans-cjk-ip-medium">
                                    本キャンペーン参加店にてコロナを購入。<br>1本につき1枚ついてくるQRコードからサイトへアクセス！
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <br class="sp"> <br class="sp">
                <div class="step-2 pt-5">
                    <p class="text-left mb-1 step2-fixcss">
                        <img src="{{public_url('css/frontend/images/step2.png')}}" class="img img-step2" alt="corona">
                    </p>
                    <div class="row">
                        <div class="col-md-6 wow fadeIn" data-wow-duration="2s">
                            <div class="card mb-4 box-shadow product-container step-box width-step">
                                <div class="card-header  bg-trans card-header-fix__step">
                                    <img class="card-img-top img"
                                         src="{{public_url('css/frontend/images/step1-bg.png')}}">
                                </div>
                                <div class="card-body card-body__content">
                                    <p class="card-text noto-sans-cjk-ip-medium">
                                        1ポイントの応募でスグに抽選！お好みの景品を選んで即時に当選したかが分かります。当たったらお届け先をフォームで送信。景品が後日お手元に届きます。</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s">
                            <div class="card mb-4 box-shadow product-container step-box width-step">
                                <div class="card-header bg-trans card-header-fix__step">
                                    <img class="card-img-top img"
                                         src="{{public_url('css/frontend/images/step2-bg.png')}}">
                                </div>
                                <div class="card-body card-body__content">
                                    <p class="card-text noto-sans-cjk-ip-medium">
                                        5本コロナを飲んでポイント貯めると、さらに豪華な景品が選べるようになります。当たったらお届け先をフォームに記入し、後日景品がお手元に届きます。
                                        <br/>
                                        <span class="pc">※1ポイント景品に5回応募することもできます。</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="question wow fadeInUp link-store"  data-wow-duration="1s">
                    <p class="text-center pt-4">
                        <a href="{{route('list-store')}}" class="text-uppercase corona-headlinen-semi-bold text-bold">
                            <img class="img img-question pc-inline img-link-store" src="{{public_url('css/frontend/images/btn-list-store_pc.png')}}">
                            <img class="img img-question sp-inline" src="{{public_url('css/frontend/images/btn-list-store_sp.png')}}">
                        </a>
                    </p>
                </div>
                <div class="question wow fadeInUp"  data-wow-duration="1s"  data-wow-delay="0.2s">
                    <p class="text-center pt-4">
                        @if(frontendGuard()->user())
                            <a href="{{route('my_page')}}" class="text-uppercase corona-headlinen-semi-bold text-bold">
                                <img class="img img-question pc-inline" src="{{public_url('css/frontend/images/question.png')}}">
                                <img class="img img-question sp-inline" src="{{public_url('css/frontend/images/question-sp.png')}}">
                            </a>
                        @else
                            <a href="javascript:void(0)" class="text-uppercase corona-headlinen-semi-bold text-bold" data-toggle="modal" data-target="#login_dialog">
                                <img class="img img-question pc-inline" src="{{public_url('css/frontend/images/question.png')}}">
                                <img class="img img-question sp-inline" src="{{public_url('css/frontend/images/question-sp.png')}}">
                            </a>
                        @endif
                    </p>
                </div>
            </div>
            <p class="pt-3"></p>
        </div>
    {{--</section>--}}
    {{--<section class="main-content">--}}
        <div class="album">
            <div class="container">
                <ul class="presentTitle presentTitle-1pt">
                    <li><div class="stroke">&nbsp;</div></li>
                    <li><span class="presentTitle-sub presentTitle-sub-1pt">今すぐ応募</span></li>
                    <li><div class="stroke">&nbsp;</div></li>
                </ul>
                <div class="clearfix">&nbsp;</div>
                <div class="row">
                    @foreach($presentsOnePt as $present)
                        <div class="col-md-4 col-lg-3 product-box present-box">
                            <div class="card box-shadow product-container product-1-point product-container-fix present-wrapper">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <ul class="presentTitle presentTitle-5pt">
                    <li><div class="stroke pc">&nbsp;</div></li>
                    <li><span class="presentTitle-sub presentTitle-sub-5pt">５ポイント貯めて応募</span></li>
                    <li><div class="stroke pc">&nbsp;</div></li>
                </ul>
                <div class="clearfix">&nbsp;</div>
                <p class="mt-10 sp"></p>
                <div class="row">
                    @foreach($presentsFivePt as $present)
                        <div class="col-md-4 product-box present-box">
                            <div class="card box-shadow product-container product-5-point product-container-fix present-wrapper">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <p class="present-mt166 pc"></p>
                <p class="present-mt60 sp"></p>
                <div class="question wow fadeInUp"  data-wow-duration="1s">
                    <p class="text-center pt-2 pb-2">
                        @if(frontendGuard()->user())
                            <a href="{{route('my_page')}}" class="text-uppercase corona-headlinen-semi-bold text-bold">
                                <img class="img img-question pc-inline" src="{{public_url('css/frontend/images/question.png')}}">
                                <img class="img img-question sp-inline" src="{{public_url('css/frontend/images/question-sp.png')}}">
                            </a>
                        @else
                            <a href="javascript:void(0)" class="text-uppercase corona-headlinen-semi-bold text-bold" data-toggle="modal"
                               data-target="#login_dialog">
                                <img class="img img-question pc-inline" src="{{public_url('css/frontend/images/question.png')}}">
                                <img class="img img-question sp-inline" src="{{public_url('css/frontend/images/question-sp.png')}}">
                            </a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <p class="pt-3"></p>
    </section>
    <section class="application-note pt-5 application-note-fix">
        <div class="application-note-bg">
        </div>
        <div class="container">
            <p class="noto-sans-cjk-ip-bold title-product title-product-fix">応募要項・注意事項</p>
            <div class="application-box noto-sans-cjk-ip-medium wow fadeIn"  data-wow-duration="3s">
                ■キャンペーン期間<br/>
                2018年12月3日（月）0:00 ～ 2019年2月28日（木）23:59<br/>
                ■応募方法<br/>
                ・キャンペーン期間中に対象商品購入して配布されたカードのQRコードから本キャンペーンサイトにアクセスし、ログインして本キャンペーンへご応募できます。<br/>
                ・対象商品購入で配布されるカードのQRコードから本サイトへアクセスしてログインすると1PTが貯まり、その場で応募、抽選結果がわかります。<br/>
                ・お一人様何口でもご応募いただけますが、1つのQRコードでのアクセスで1PT貯まります。同じQRコードで重複してポイントは貯まりません。<br/>
                ■賞品と発送<br/>
                ＊ご当選された賞品の譲渡または交換、換金、返品などには応じかねますので、あらかじめご了承ください。<br/>
                ＊ご当選された賞品は、2019年1月上旬より順次発送いたします。<br/>
                ※“1月上旬”は暫定的な日程として記載しております。<br/>
                ■対象商品<br/>
                コロナ・エキストラボトル（355ml）<br/>
                ■応募資格<br/>
                日本国内にお住まいの20歳以上の方<br/>
                ■推奨環境<br/>
                パソコンまたはスマートフォンよりご参加いただけます。<br/>
                ※QRを読み込める環境（カメラやスキャナの機能がある、QR読込に対応したアプリがインストールされている等）を要します。<br/>
                【PC】<br/>
                ●Windows<br/>
                Internet Explorer IE11以上<br/>
                Google Chrome　最新版<br/>
                Firefox　最新版<br/>
                ●Macintosh<br/>
                Safari　最新版<br/>
                <br/>
                <p class="wow fadeIn">
                    【スマートフォン】<br/>
                    ●iPhone<br/>
                    iOS 12.1以上<br/>
                <p class="wow fadeIn">
                    ●Android<br/>
                    Android 9以上<br/>
                    ＊端末標準のブラウザをご利用ください。<br/>
                    ＊OSのバージョンアップ方法などにつきましては、各端末メーカー、または携帯電話会社へお問合せください。<br/>
                    ＊携帯電話、PHS、PDA、mopera U等ではご応募いただけません。<br/>
                    ＊一部機種・ブラウザでは正常に表示できない場合がございます。（タブレット端末など）<br/>
                    ＊上記推奨環境であっても、ご使用になられている機種、設定、バージョン、通信接続設定により、正常に動作しない場合がございます。あらかじめご了承ください。<br/>
                <p class="wow fadeIn">
                    ■注意事項<br/>
                    ・ご応募は満20歳以上の方に限らせていただきます。未成年者はご応募できません。<br/>
                    ・本キャンペーンは、ご応募いただくにあたり対象商品で配布されるカードに記載されたQRコードが必要です。<br/>
                    ・賞品の発送先は日本国内に限らせていただきます。<br/>
                    ・同じQRコードで複数回応募はできません。応募内容に誤りや入力漏れがあった場合には無効となりますのでご注意ください。<br/>
                    ・パソコン、スマートフォンからご応募の場合、ネットワークの混雑により、接続に時間がかかる場合がございます。<br/>
                    ・応募締切間近はアクセス集中等により繋がりにくくなる場合がございますので、お時間の余裕をもってご応募ください。<br/>
                    ・ご応募時にご入力いただく情報はSSLにより暗号化されて送信されます。<br/>
                    ・店舗によって、対象商品のお取扱いがない、または品切れの場合がございます。<br/>
                    ・店舗によって、QRコードが印刷されたカードが品切れの場合がございます。<br/>
                    ・ご当選の権利はご本人のみ有効で  譲渡・換金はできません。<br/>
                    ・賞品の仕様は予告なく変わる可能性がございます。<br/>
                    ・賞品のオークションなどによる転売行為を禁止しております。<br/>
                    ・通信費用はお客様のご負担となります。<br/>
                    ・通信の際の接続トラブルにつきましては、責任を負いかねますので、ご了承ください。<br/>
                    ・本キャンペーンはやむを得ない事情により中止または内容が変更となる場合がございますのであらかじめご了承ください。<br/>
                    ■個人情報の取り扱い<br/>
                    ‐お客様の個人情報は、個人を特定しない統計情報として商品開発、販促などのほか、お客様サービス向上のために利用させていただきます。<br/>
                    ‐お客様の個人情報はアンハイザー・ブッシュ・インベブジャパン株式会社にて管理いたします。お客様の個人情報をお客様の同意なしに業務委託先以外の第三者に開示・提供することはありません（法令等により開示を求められた場合を除く）。<br/>
                </p>
                <p class="wow fadeIn">
                    ■免責事項<br/>
                    ・本キャンペーンの利用に関連して利用者または第三者に損害が発生した場合、アンハイザー・ブッシュ・インベブジャパン株式会社は一切の責任を負いかねます。<br/>
                    ・本キャンペーンの全部または一部を、利用者に事前に通知することなく変更または中止することがあります。なお、必要と判断した場合には、利用者への予告なく本規約を変更できるほか、本キャンペーンの適正な運用を確保するために必要な措置をとることができます。<br/>
                </p>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {
            @if(isset($showModal))
            $('#login_dialog').modal('show');
            @endif
        });
    </script>
@stop