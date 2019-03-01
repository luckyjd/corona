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
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('email')}}</label>
                            <div class="col-md-8">
                                {!! MyForm::search('email_cons','',['placeholder'=>$model->tA('email')]) !!}
                            </div>
                        </div>
                    </div>

                    <div class=" col-md-12">&nbsp;</div>

                    <div class="form-row">
                        <div class="form-group col-md-6 row">
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('ins_datetime_text')}}</label>
                            <div class="col-md-8">
                                <div class="inline-group">
                                    {!! MyForm::search('ins_datetime_gteqt','',['placeholder'=>'', 'class' => 'datepicker']) !!}
                                    <span class="input-group-addon text-connect">〜</span>
                                    {!! MyForm::search('ins_datetime_lteqt','',['placeholder'=>'', 'class' => 'datepicker']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6 row">
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('upd_datetime_text')}}</label>
                            <div class="col-md-8">
                                <div class="inline-group">
                                    {!! MyForm::search('upd_datetime_gteqt','',['placeholder'=>'', 'class' => 'datepicker']) !!}
                                    <span class="input-group-addon text-connect">〜</span>
                                    {!! MyForm::search('upd_datetime_lteqt','',['placeholder'=>'', 'class' => 'datepicker']) !!}
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
                            <th width="100">{!! Sorting::aLink('name') !!}</th>
                            <th width="100">{!! Sorting::aLink('email') !!}</th>
                            <th width="150">{!! Sorting::aLink('ins_datetime') !!}</th>
                            <th width="150">{!! Sorting::aLink('upd_datetime') !!}</th>
                            <th width="100" class="text-center">{{trans('actions.label')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($entities as $entity)
                            <tr>
                                <th><a href="{{backUrl('admin.show', $entity->getKey())}}">{{$entity->getKey()}}</a></th>
                                <td>{{$entity->name}}</td>
                                <td>{{$entity->email}}</td>
                                <td>{{$entity->ins_datetime}}</td>
                                <td>{{$entity->upd_datetime}}</td>
                                <td class="text-center">
                                    @include('layouts.backend.elements.list_show_btn')
                                    @if(!$entity->isOwner())
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