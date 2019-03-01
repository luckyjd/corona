@php
    $label = transb($routePrefix.'.name');
    $show = isset($show) ? $show : $area.'.'.$controllerName.'._show';
@endphp
<div class="row gap-20 masonry pos-r" >
    <div class="masonry-sizer col-md-6"></div>
    <div class="masonry-item col-md-12">
        <div class="bgc-white p-20 bd">
            <h6 class="c-grey-900">
                {{$entity->getKey() ? $label.'編集（確認）': $label.'登録（確認）'}}</span>
            </h6>
            <div class="mT-30 sp-padb15">
                @include('layouts.backend.elements.confirm_text_danger')
                @include($show)
                <div style="margin-top: 15px;"></div>
                @include('layouts.backend.elements.confirm')
            </div>
        </div>
    </div>
</div>