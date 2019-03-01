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
                                {!! MyForm::search('applications[id_eq]','',['placeholder'=>'ID']) !!}
                            </div>
                        </div>

                        <div class="form-group col-md-6 row">
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('user_email')}}</label>
                            <div class="col-md-8">
                                {!! MyForm::search('email','',['placeholder'=>$model->tA('user_email')]) !!}
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-12">&nbsp;</div>

                    <div class="form-row">
                        <div class="form-group col-md-6 row">
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('status')}}</label>
                            <div class="col-md-8">
                                {!! MyForm::dropdown('applications[status_eq]', null, getConfig('application.statuses')) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-6 row">
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('present_name')}}</label>
                            <div class="col-md-8">
                                {!! MyForm::dropdown('presents[id_eq]','', $presents) !!}
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-12">&nbsp;</div>

                    <div class="form-row">
                        <div class="form-group col-md-6 row">
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('present_type')}}</label>
                            <div class="col-md-8">
                                {!! MyForm::dropdown('presents[type_eq]', null, getConfig('presents.types')) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-6 row">
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('user_store_list')}}</label>
                            <div class="col-md-8">
                                {!! MyForm::search('shipping[store_list_consl]','',['placeholder'=>$model->tA('user_store_list')]) !!}
                            </div>
                        </div>
                    </div>

                    <div class=" col-md-12">&nbsp;</div>

                    <div class="form-row">
                        <div class="form-group col-md-6 row">
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('ins_datetime')}}</label>
                            <div class="col-md-8">
                                <div class="inline-group">
                                    {!! MyForm::search('applications[ins_datetime_gteqt]','',['placeholder'=>'', 'class' => 'datepicker']) !!}
                                    <span class="input-group-addon text-connect">〜</span>
                                    {!! MyForm::search('applications[ins_datetime_lteqt]','',['placeholder'=>'', 'class' => 'datepicker']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6 row">
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('upd_datetime')}}</label>
                            <div class="col-md-8">
                                <div class="inline-group">
                                    {!! MyForm::search('applications[upd_datetime_gteqt]','',['placeholder'=>'', 'class' => 'datepicker']) !!}
                                    <span class="input-group-addon text-connect">〜</span>
                                    {!! MyForm::search('applications[upd_datetime_lteqt]','',['placeholder'=>'', 'class' => 'datepicker']) !!}
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
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="active">
                            <th width="50">
                                {!! Sorting::aLink('applications[id]', $model->tA('id')) !!}
                            </th>
                            <th width="150">{!! Sorting::aLink('user_email', $model->tA('user_email')) !!}</th>
                            <th width="100">{!! Sorting::aLink('presents[name]', $model->tA('present_name')) !!}</th>
                            <th width="100">{!! Sorting::aLink('presents[type]', $model->tA('present_type')) !!}</th>
                            <th width="100">{!! Sorting::aLink('applications[status]', $model->tA('status')) !!}</th>
                            <th width="100">{!! Sorting::aLink('store_list', $model->tA('user_store_list')) !!}</th>
                            <th width="100">{{$model->tA('user_address')}}</th>
                            <th width="100">{!! Sorting::aLink('applications[ins_datetime]', $model->tA('ins_datetime')) !!}</th>
                            <th width="100">{!! Sorting::aLink('applications[upd_datetime]', $model->tA('upd_datetime')) !!}</th>
                            <th width="100">{!! Sorting::aLink('shipping_flg', $model->tA('shipping_flg')) !!}</th>
                            <th width="100" class="text-center">{{trans('actions.label')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($entities as $entity)
                            <tr>
                                <th><a href="{{backUrl('applications.show', $entity->getKey())}}">{{$entity->getKey()}}</a></th>
                                <td>{{$entity->user_email}} </td>
                                <td>
                                    {{$entity->present_name}}
                                </td>
                                <td>
                                    {{$entity->presentTypeText()}}
                                </td>
                                <td>{{$entity->statusText()}}</td>
                                <td>{{$entity->storeListText()}}</td>
                                <td>{{$entity->addressText()}}</td>
                                <td>{{$entity->ins_datetime}}</td>
                                <td>{{$entity->upd_datetime}}</td>
                                <td>{{$entity->getShippingFlg()}}</td>
                                <td class="text-center">
                                    @include('layouts.backend.elements.list_show_btn')
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    @include('layouts.backend.elements.no_result_found')
                    {{ $entities->appends(Input::all())->links() }}
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection