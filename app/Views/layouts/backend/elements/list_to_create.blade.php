@php
    $total = $entities->total();
    $create_route = isset($create_route) ? $create_route : $routePrefix.'.create';
    $create_label = isset($create_label) ? $create_label : transb($routePrefix.'.create');
@endphp
@if($total)
    <div class="col-6">
@else
    <div class="col-12">
@endif
        <div class="pull-right pb-3">
            <a class="btn btn-main-color" href="{{backUrl($create_route)}}">
                <span class="ti-plus" aria-hidden="true">&nbsp;{{$create_label}}</span>
            </a>
            {{--<a class="btn btn-main-color"--}}
            {{--href="{{backUrl($routePrefix.'.exportCsv', ['limit' => $total] + Input::all())}}"><span--}}
            {{--class="ls-icon ls-icon-arrowdown" aria-hidden="true">&nbsp;{{trans('actions.csvExport')}}</span>--}}
            {{--</a>--}}
            {{--<a class="btn btn-danger mass-destroy-btn disabled" href="#mass_destroy_confirm"--}}
            {{--data-toggle="modal"--}}
            {{--data-action="{{backUrl($routePrefix.'.massDestroy')}}">--}}
            {{--<span class="ls-icon  ls-icon-delete" aria-hidden="true">&nbsp;{{trans('actions.massDestroy')}}</span>--}}
            {{--</a>--}}

        </div>
    </div>
{{--@endif--}}