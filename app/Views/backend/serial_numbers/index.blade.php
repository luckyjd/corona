@extends('layouts.backend.layouts.main')
@section('content')
    <div class="row gap-20 masonry pos-r" >
        <div class="masonry-sizer col-md-6"></div>
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">
                    @include('layouts.backend.elements._index_label', ['icon' => 'ti-share'])
                </h6>
                @php
                    $total = $entities->total();
                    $addDisabled = serialIsLimited($total) ? 'disabled' : false;
                    $exportCsvDisabled = $addDisabled ? '' : 'disabled';
                @endphp
                <div class="mT-30">
                    {!! MyForm::open(['route' => 'serial_numbers.store', 'method' => 'POST']) !!}
                    <div class="form-row">
                        <div class="form-group col-md-3 disabled">
                            {!! MyForm::dropDown('quantity', null, getConfig('quantities'), false, ['disabled'=> $addDisabled]) !!}
                        </div>
                        <div class="form-group col-md-9">
                            <button class="btn btn-main-color {{$addDisabled}}" type="{{$addDisabled ? 'button' : 'submit'}}">
                                <span class="ti-plus" aria-hidden="true"> {{trans('actions.gen_serial_number')}}</span>
                            </button>
                            <a href="{{$exportCsvDisabled ? '#' : backUrl('serial_numbers.exportCsv')}}" class="btn btn-main-color {{$exportCsvDisabled}}"><span class="ti-download" aria-hidden="true"> {{trans('actions.export_csv')}}</span></a>
                        </div>
                    </div>
                    {!! MyForm::close() !!}
                </div>
            </div>
        </div>
    </div>
    @if ($entities->total())
    <div class="row gap-20 masonry pos-r">
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <div class="row">
                    @include('layouts.backend.elements.pagination_info')
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="active">
                            <th width="50">
                                {!! Sorting::aLink('id') !!}
                            </th>
                            <th width="100">{!! Sorting::aLink('serial_number') !!}</th>
                            <th width="100">{!! Sorting::aLink('key') !!}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($entities as $entity)
                            <tr>
                                <th>{{$entity->getKey()}}</th>
                                <td>{{$entity->serial_number}}</td>
                                <td>{{$entity->key}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center mT-20">
                    @include('layouts.backend.elements.no_result_found')
                    {{ $entities->appends(Input::all())->links() }}
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection