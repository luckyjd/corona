<footer class="text-muted">
    <div class="container text-center noto-sans-cjk-ip-bold pb-3 wow fadeIn">
        <p>お問い合わせ先</p>
        <p class="pt-1 pb-1">
            CORONA WinterEscapeキャンペーン事務局<br/>
            <span class="text-bold">corona-jimukyoku@corona-we.com</span>
        </p>
        <p class="pt-1 pb-1">受付期間　2018年12月3日 〜 2019年2月28日</p>
        <p class="pt-1 pb-1">
            ＊ご質問の内容については、後日担当者よりご連絡させていただきます。<br>
            回答についてはお時間をいただく場合がございますので、あらかじめご了承ください。
        </p>
    </div>
    <div class="last-footer wow fadeIn">
        <div class="logo-bottom wow fadeInUp logo-bottom-fix">
            <a href="/" class="navbar-brand d-flex align-items-center">
                <img class="img" height="51" src="{{public_url('css/frontend/images/logo-footer.svg')}}">
            </a>
        </div>
        <div class="text-center">
            <span class="copyright">Anheuser-Busch InBev © 2018</span>
            <div class="menu-box">
                <div class="flex-center right-box">
                    <!-- Facebook -->
                    <a target="_blank" href="{{route('term')}}" class="helvetica-neue-bold">
                        利用規約
                    </a>
                    <!-- Facebook -->
                    <a target="_blank" href="{{route('privacypolicy')}}" class="helvetica-neue-bold">
                        プライバシーポリシー
                    </a>
                </div>
            </div>

        </div>
    </div>
    <a class="back-to-top text-uppercase" onclick="scrollToX('.main');" href="javascript:void(0)">TOP</a>
</footer>
@include('layouts.frontend.elements.structures.footer_js')
@include('layouts.frontend.elements.trans')

@if(session()->get('point_limited'))
    <script>
        alert('ポイントが上限に達しました。\nポイントを消費後、再度QRコードを読み込んでください。');
    </script>
    @php
        session()->pull('point_limited')
    @endphp
@endif