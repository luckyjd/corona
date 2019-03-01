<div class="sidebar trans-05">
    <div class="sidebar-inner">
        <div class="sidebar-logo">
            <div class="peers ai-c fxw-nw">
                <div class="peer peer-greed">
                    <a class="sidebar-link td-n" href="{{route('dashboard.index')}}">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer">
                                <div class="logo pt-1 pl-1"><img class="main-logo trans-05" src="{{public_url('/css/backend/img/logo.png')}}" alt=""></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="peer">
                    <div class="mobile-toggle sidebar-toggle main-color">
                        <a href="" class="td-n"><i class="ti-arrow-circle-left"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <ul class="sidebar-menu scrollable pos-r">
            <li class="nav-item mT-30 {{getNavActiveClass('dashboard')}}">
                <a class="sidebar-link" href="{{route('dashboard.index')}}">
                    <span class="icon-holder"><i class="main-color ti-bar-chart"></i></span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{getNavActiveClass('customer')}}">
                <a class="sidebar-link" href="{{route('customer.index')}}">
                    <span class="icon-holder"><i class="c-brown-500 ti-user"></i></span>
                    <span class="title">{{transb('customer.name')}}</span>
                </a>
            </li>
            <li class="nav-item {{getNavActiveClass('applications')}}">
                <a class="sidebar-link" href="{{route('applications.index')}}">
                    <span class="icon-holder"><i class="c-blue-500 ti-package"></i></span>
                    <span class="title">{{transm('applications.name')}}</span>
                </a>
            </li>
            {{--<li class="nav-item">--}}
                {{--<a class="sidebar-link" href="{{'' ? '#' : backUrl('applications.exportCsv')}}">--}}
                    {{--<span class="icon-holder"><i class="c-blue-500 ti-download"></i></span>--}}
                    {{--<span class="" aria-hidden="true"> {{trans('actions.export_csv_admin')}}</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            <li class="nav-item">
                <a class="sidebar-link" href="{{route('shop.index')}}">
                    <span class="icon-holder"><i class="c-green-500 ti-layout-grid2"></i></span>
                    <span class="" aria-hidden="true"> {{trans('actions.shop_management')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="sidebar-link" href="{{route('shipping.index')}}">
                    <span class="icon-holder"><i class="c-blue-500 ti-truck"></i></span>
                    <span class="" aria-hidden="true"> {{trans('actions.shipping_management')}}</span>
                </a>
            </li>
            <li class="nav-item {{getNavActiveClass('serial_numbers')}}">
                <a class="sidebar-link" href="{{route('serial_numbers.index')}}">
                    <span class="icon-holder"><i class="c-black-500 ti-share"></i></span>
                    <span class="title">{{transm('serial_numbers.name')}}</span>
                </a>
            </li>
            <li class="nav-item dropdown {{getNavActiveClass('presents')}}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder"><i class="c-red-500 ti-gift"></i></span>
                    <span class="title">{{transm('presents.name')}}</span>
                    <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li><a class="sidebar-link" href="{{route('presents.index')}}">{{transb('presents.index')}}</a></li>
                    <li><a class="sidebar-link" href="{{backUrl('presents.create', [], 'presents.index')}}">{{transb('presents.create')}}</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown {{getNavActiveClass('admin')}}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="c-teal-500 ti-user"></i>
                    </span>
                    <span class="title">{{transm('admin_user_info.name')}}</span>
                    <span class="arrow"><i class="ti-angle-right"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="sidebar-link" href="{{route('admin.index')}}">{{transb('admin.index')}}</a></li>
                    <li><a class="sidebar-link" href="{{backUrl('admin.create', [], 'admin.index')}}">{{transb('admin.create')}}</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
