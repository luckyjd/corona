@extends('layouts.backend.layouts.main')
@section('content')
    <div class="row gap-20 masonry pos-r">
        <div class="masonry-sizer col-md-6"></div>
        {{-- Total --}}
        <div class="masonry-item w-100">
            <div class="row gap-20">
                <div class="col-md-4">
                    <div class="layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10"><h6 class="lh-1">{{getConstant('LABEL_TOTAL_USER')}}</h6></div>
                        <div class="layer w-100">
                            <div class="peers ai-sb fxw-nw">
                                <div class="peer peer-greed"><span id="sparklinedash"></span></div>
                                <div class="peer">
                                    <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500">{{$overview['total_user']}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10"><h6 class="lh-1">{{getConstant('LABEL_TOTAL_APPLICATION')}}</h6></div>
                        <div class="layer w-100">
                            <div class="peers ai-sb fxw-nw">
                                <div class="peer peer-greed"><span id="sparklinedash2"></span></div>
                                <div class="peer">
                                    <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500">{{$overview['total_application']}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="layers bd bgc-white p-20">
                        <div class="layer w-100 mB-10"><h6 class="lh-1">{{getConstant('LABEL_APPLICATION_WINED')}}</h6></div>
                        <div class="layer w-100">
                            <div class="peers ai-sb fxw-nw">
                                <div class="peer peer-greed"><span id="sparklinedash3"></span></div>
                                <div class="peer">
                                    <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500">{{$overview['application_wined']}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Chart --}}
        <div class="masonry-item col-md-6">
            <div class="bd bgc-white">
                <div class="layers">
                    <div class="layer w-100 pX-20 pT-20"><h6 class="lh-1">{{getConstant('DAILY_STATS')}}</h6></div>
                    <div class="layer w-100 p-20">
                        <canvas id="line_chart" height="220"></canvas>
                    </div>
                    <div class="layer bdT p-20 w-100">
                        <div class="peers ai-c jc-c gapX-20">
                            <div class="peer">
                                <span class="fsz-def fw-600 mR-10 c-grey-800">
                                    {{getConstant('LABEL_TOTAL_APPLICATION')}}
                                    <i class="fa fa-line-chart c-{{getConstant('COLOR_CHART_APPLICATION')}}-500"></i>
                                </span>
                            </div>
                            <div class="peer">
                                <span class="fsz-def fw-600 mR-10 c-grey-800">
                                    {{getConstant('LABEL_APPLICATION_WINED')}}
                                    <i class="fa fa-line-chart c-{{getConstant('COLOR_CHART_APPLICATION_WINED')}}-500"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Report --}}
        <div class="masonry-item col-md-6">
            <div class="bd bgc-white">
                <div class="layers">
                    <div class="layer w-100 p-20"><h6 class="lh-1">{{getConstant('LABEL_TOP_TEN')}}</h6></div>
                    <div class="layer w-100">
                        <div class="main-bg-color c-white p-20">
                            <div class="peers ai-c jc-sb gap-40">
                                <div class="peer peer-greed"><h5>{{date('F Y')}}</h5>
                                    <p class="mB-0">{{getConstant('LABEL_TOP_TEN')}}</p></div>
                                <div class="peer"><h3 class="text-right"></h3></div>
                            </div>
                        </div>
                        <div class="table-responsive p-20">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="bdwT-0">{{$model->tA('name')}}</th>
                                    <th class="bdwT-0">{{$model->tA('email')}}</th>
                                    <th class="bdwT-0 text-center">{{$model->tA('point')}}</th>
                                    <th class="bdwT-0">{{$model->tA('tel')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($winners as $winner)
                                    <tr>
                                        <td>{{$winner->user->getName()}}</td>
                                        <td class="fw-600">{{$winner->user->email}}</td>
                                        <td class="text-center">{!! $winner->user->getPoint() !!}</td>
                                        <td>{{$winner->user->tel}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="ta-c bdT w-100 p-20"><a class="main-color text-bold" href="{{route('customer.index')}}">{{getConstant('VIEW_ALL_USER')}}</a></div>
            </div>
        </div>
    </div>
    <script>
        var data = {!! json_encode($charts) !!}
    </script>
@endsection