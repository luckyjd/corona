<!DOCTYPE html>
<html lang="ja">
@include('layouts.backend.elements.structures.head')
<body class="{{getBodyClass()}}">
@include('layouts.backend.elements.loader')
@include('layouts.backend.elements.structures.sidebar')
<div class="page-container">
    @include('layouts.backend.elements.structures.top-sidebar')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            {!! Breadcrumbs::render() !!}
            @include('layouts.backend.elements.messages')
            @yield('content')
        </div>
    </main>
    @include('layouts.backend.elements.structures.footer')
    @include('layouts.backend.elements.modal')
</div>
@stack('scripts')
</body>
</html>