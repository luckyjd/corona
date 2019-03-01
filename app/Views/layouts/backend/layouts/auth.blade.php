<!DOCTYPE html>
<html lang="ja">
@include('layouts.backend.elements.structures.head')
<body class="{{getBodyClass()}}">
@include('layouts.backend.elements.loader')
<div id="Wrap">
    <div class="container">
        @yield('content')
    </div>
</div>
@include('layouts.backend.elements.structures.footer_js')
@stack('scripts')
</body>
</html>