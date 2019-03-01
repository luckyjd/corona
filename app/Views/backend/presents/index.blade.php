@extends('layouts.backend.layouts.main')
@section('content')
    <div class="row gap-20 masonry pos-r" >
        <div class="masonry-sizer col-md-6"></div>
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">
                    @include('layouts.backend.elements._index_label', ['icon' => 'ls-icon ls-icon-user'])
                </h6>
                <div class="mT-30">
                    {!! MyForm::query() !!}
                    <div class="form-row">
                        <div class="form-group col-md-6 row">
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('id')}}</label>
                            <div class="col-md-8">
                                {!! MyForm::search('id_eq','',['placeholder'=>'ID']) !!}
                            </div>
                        </div>

                        <div class="form-group col-md-6 row">
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('name')}}</label>
                            <div class="col-md-8">
                                {!! MyForm::search('name_cons','',['placeholder'=>$model->tA('name')]) !!}
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-12">&nbsp;</div>

                    <div class="form-row">
                        <div class="form-group col-md-6 row">
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('type')}}</label>
                            <div class="col-md-8">
                                <div class="inline-group">
                                    {!! MyForm::dropdown('type_eq','', getConfig('presents.types')) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=" col-md-12">&nbsp;</div>

                    <div class="form-row">
                        <div class="form-group col-md-6 row">
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('quantity')}}</label>
                            <div class="col-md-8">
                                <div class="inline-group">
                                    {!! MyForm::search('quantity_gteqt','',['placeholder'=>'']) !!}
                                    <span class="input-group-addon text-connect">〜</span>
                                    {!! MyForm::search('quantity_lteqt','',['placeholder'=>'']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6 row">
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('remain_quantity')}}</label>
                            <div class="col-md-8">
                                <div class="inline-group">
                                    {!! MyForm::search('remain_quantity_gteqt','',['placeholder'=>'']) !!}
                                    <span class="input-group-addon text-connect">〜</span>
                                    {!! MyForm::search('remain_quantity_lteqt','',['placeholder'=>'']) !!}
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class=" col-md-12">&nbsp;</div>
                    <div class=" col-md-12">
                        @include('layouts.backend.elements.search_form_btn')
                    </div>
                    {!! MyForm::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row gap-20 masonry pos-r">
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <div class="row">
                    @include('layouts.backend.elements.pagination_info')
                    @include('layouts.backend.elements.list_to_create')
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="active">
                            <th width="50">
                                {!! Sorting::aLink('id') !!}
                            </th>
                            <th width="150">{!! Sorting::aLink('name') !!}</th>
                            <th width="80">{!! Sorting::aLink('quantity') !!}</th>
                            <th width="80">{!! Sorting::aLink('remain_quantity') !!}</th>
                            <th width="100">{!! Sorting::aLink('type') !!}</th>
                            <th width="100">{!! $model->tA('image') !!}</th>
                            <th width="300">{!! $model->tA('introduction') !!}</th>
                            <th width="100" class="text-center">{{trans('actions.label')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($entities as $entity)
                            <tr>
                                <th><a href="{{backUrl('presents.show', $entity->getKey())}}">{{$entity->getKey()}}</a></th>
                                <td>{{$entity->name}}</td>
                                <td>{{$entity->quantity}}</td>
                                <td>{{$entity->remain_quantity}}</td>
                                <td>{{$entity->typeText()}}</td>
                                <td class="text-center"><a href="{{backUrl('presents.show', $entity->getKey())}}">{!! $entity->getImgView('image', ['height' => '100px']) !!}</a></td>
                                <td>{!! ebr($entity->introduction) !!}</td>
                                <td class="text-center">
                                    @include('layouts.backend.elements.list_show_btn')
                                    @if (!$entity->isApplicationUse())
                                        / @include('layouts.backend.elements.list_delete_btn')
                                    @endif
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
@endsection