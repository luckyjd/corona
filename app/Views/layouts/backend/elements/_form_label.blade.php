@php
    $label = transb($routePrefix.'.name');
@endphp
<span class="{{$icon}}" aria-hidden="true">{{$entity->getKey() ? $label.'編集': $label.'登録'}}</span>