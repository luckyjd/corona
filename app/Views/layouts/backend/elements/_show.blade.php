@php
    $label = transb($routePrefix.'.name').'詳細';
    $show = isset($show) ? $show : $area.'.'.$controllerName.'._show';
@endphp
<div class="row gap-20 masonry pos-r">
    <div class="masonry-sizer col-md-6"></div>
    <div class="masonry-item col-md-12">
        <div class="bgc-white p-20 bd">
            <h6 class="c-grey-900"><span class="{{$icon}}" aria-hidden="true">{{$label}}</span></h6>
            <div class="mT-30 sp-padb15">
                @include($show)
                <div style="margin-top: 15px;"></div>
                @include('layouts.backend.elements.show_to_edit')
            </div>
        </div>
    </div>
</div>