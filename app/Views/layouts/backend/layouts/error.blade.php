<!DOCTYPE html>
<html lang="ja">
@include('layouts.backend.elements.structures.head')
<body class="{{getBodyClass()}}">
@include('layouts.backend.elements.loader')
<main class="main-content bgc-grey-100">
    <div id="mainContent">
        @yield('content')
    </div>
</main>
@include('layouts.backend.elements.structures.footer_js')
@stack('scripts')
</body>
</html>