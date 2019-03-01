<!DOCTYPE html>
<html lang="ja">
@include('layouts.frontend.elements.structures.head')
<body class="{{getBodyClass()}}">
<main role="main" class="main">
    @yield('content')
</main>
@include('layouts.frontend.elements.structures.footer')
@include('layouts.frontend.elements.modal')
@stack('scripts')
</body>
</html>