@extends('layouts.backend.layouts.main')
@section('content')
    <div class="row">
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <div class="row">
                    @include('layouts.backend.elements.pagination_info')
                    <div class="col-md-6 pb-2">
                        <a href="" data-toggle="modal" data-target="#importCSV" class="btn btn-success pull-right">
                            <span class="ti-upload" aria-hidden="true"> csvアップロード</span>
                        </a>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="active">
                            <th width="50" class="text-center">{!! Sorting::aLink('id') !!}</th>
                            <th width="100">{!! Sorting::aLink('code') !!}</th>
                            <th width="150">{!! Sorting::aLink('tel') !!}</th>
                            <th width="150">{!! Sorting::aLink('name') !!}</th>
                            <th width="140">{!! Sorting::aLink('zip_code') !!}</th>
                            <th width="110">{!! Sorting::aLink('pref') !!}</th>
                            <th width="110">{!! Sorting::aLink('address') !!}</th>
                            <th width="110">{!! Sorting::aLink('address1') !!}</th>
                            <th width="110">{!! Sorting::aLink('address2') !!}</th>
                            <th width="150">{!! Sorting::aLink('address3') !!}</th>
                            <th width="90">{!! Sorting::aLink('ins_datetime') !!}</th>
                            <th width="90">{!! Sorting::aLink('upd_datetime') !!}</th>
                            <th width="50" class="text-center">{{trans('actions.label')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($entities as $entity)
                            <tr>
                                <td class="text-center">{{$entity->id}}</td>
                                <td>{{$entity->code}}</td>
                                <td>{{$entity->tel}}</td>
                                <td>{{$entity->name}}</td>
                                <td>〒{{$entity->zip_code}}</td>
                                <td>{{$entity->pref}}</td>
                                <td>{{$entity->address}}</td>
                                <td>{{$entity->address1}}</td>
                                <td>{{$entity->address2}}</td>
                                <td>{{$entity->address3}}</td>
                                <td>{{$entity->ins_datetime}}</td>
                                <td>{{$entity->upd_datetime}}</td>
                                <td class="text-center">
                                    @include('layouts.backend.elements.list_delete_btn')
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
                <form style="margin-top: 15px;padding: 10px;" action="{{route('shop.importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
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
