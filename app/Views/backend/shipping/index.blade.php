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
                                {!! MyForm::search('shipping[id_eq]','',['placeholder'=>'ID']) !!}
                            </div>
                        </div>

                        <div class="form-group col-md-6 row">
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('email')}}</label>
                            <div class="col-md-8">
                                {!! MyForm::search('shipping[email_eq]','',['placeholder'=>$model->tA('email')]) !!}
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-12">&nbsp;</div>

                    <div class="form-row">
                        <div class="form-group col-md-6 row">
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('shipping_flg')}}</label>
                            <div class="col-md-8">
                                {!! MyForm::dropdown('shipping_flg_eq', null, getConfig('shipping.shipping_flg')) !!}
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
                                    {!! MyForm::search('shipping[ins_datetime_gteqt]','',['placeholder'=>'', 'class' => 'datepicker']) !!}
                                    <span class="input-group-addon text-connect">〜</span>
                                    {!! MyForm::search('shipping[ins_datetime_lteqt]','',['placeholder'=>'', 'class' => 'datepicker']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6 row">
                            <label class="col-md-4 col-form-label" for="InputName">{{$model->tA('upd_datetime')}}</label>
                            <div class="col-md-8">
                                <div class="inline-group">
                                    {!! MyForm::search('shipping[upd_datetime_gteqt]','',['placeholder'=>'', 'class' => 'datepicker']) !!}
                                    <span class="input-group-addon text-connect">〜</span>
                                    {!! MyForm::search('shipping[upd_datetime_lteqt]','',['placeholder'=>'', 'class' => 'datepicker']) !!}
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
                    <div class="col-md-6 pb-2">
                        <a href="" data-toggle="modal" data-target="#importCSV" class="btn btn-main-color pull-right"
                           style="margin-left: 15px;">
                            <span class="ti-upload" aria-hidden="true"> csvアップロード</span>
                        </a>
                        <a href="{{'' ? '#' : backUrl('shipping.exportCsvCongrat')}}"
                           class="btn btn-main-color pull-right" style="margin-left: 15px;">
                            <span class="ti-download" aria-hidden="true"> 全あたり応募</span>
                        </a>
                        <a href="{{'' ? '#' : backUrl('shipping.exportCsv')}}" class="btn btn-main-color pull-right"
                           style="margin-left: 15px;">
                            <span class="ti-download" aria-hidden="true"> 未発送</span>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="active">
                            <th width="50">
                                {!! Sorting::aLink('shipping[application_id]', '応募ID') !!}
                            </th>
                            <th width="150">{!! Sorting::aLink('user_email', $model->tA('email')) !!}</th>
                            <th width="100">{!! Sorting::aLink('applications[status]', $model->tA('status')) !!}</th>
                            <th width="100">{!! Sorting::aLink('store_list', $model->tA('user_store_list')) !!}</th>
                            <th width="100">{{$model->tA('user_address')}}</th>
                            <th width="100">{!! Sorting::aLink('shipping[ins_datetime]', $model->tA('ins_datetime')) !!}</th>
                            <th width="100">{!! Sorting::aLink('shipping[upd_datetime]', $model->tA('upd_datetime')) !!}</th>
                            <th width="100">{!! Sorting::aLink('shipping_flg', $model->tA('shipping_flg')) !!}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($entities as $entity)
                            <tr>
                                <th><a href="{{backUrl('applications.show', $entity->application_id)}}">{{$entity->application_id}}</a></th>
                                <td>{{$entity->user_email}} </td>
                                <td>{{$entity->statusText()}}</td>
                                <td>{{$entity->storeListText()}}</td>
                                <td>{{$entity->addressText()}}</td>
                                <td>{{$entity->ins_datetime}}</td>
                                <td>{{$entity->upd_datetime}}</td>
                                <td>{{$entity->getShippingFlg()}}</td>

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

    <div class="modal" id="importCSV" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-label">店舗一覧アップロード</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form style="margin-top: 15px;padding: 10px;" action="{{route('shipping.importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <input type="file" name="import_file" />
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-default" data-dismiss="modal">いいえ</a>
                        <button type="submit" class="btn btn-primary">はい</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection