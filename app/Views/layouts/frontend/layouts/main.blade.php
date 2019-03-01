<!DOCTYPE html>
<html lang="ja">
@include('layouts.frontend.elements.structures.head')
<body class="{{getBodyClass()}}">
@include('layouts.frontend.elements.structures.sidebar')
<main role="main" class="main">
    <div id="bg-wrap" class="bg-wrap">
        <div class="bubble-wrap">
            <p class="load-logo text-center"><img src="{{public_url('css/frontend/images/small-logo.png')}}" width="114" height="77" alt="CORONA"></p>
        </div>
    </div>
    <div id="contents">
        @yield('content')
    </div>
</main>
@include('layouts.frontend.elements.structures.footer')
@include('layouts.frontend.elements.modal')
@stack('scripts')
</body>
</html>