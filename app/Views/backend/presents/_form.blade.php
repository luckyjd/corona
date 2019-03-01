<div class="row gap-20 pos-r">
    <div class="masonry-sizer col-md-6"></div>
    <div class="masonry-item col-md-12">
        <div class="bgc-white p-20 bd">
            <h6 class="c-grey-900">
                @include('layouts.backend.elements._form_label', ['icon' => 'ls-icon ls-icon-gift'])
            </h6>
            <div class="mT-30">
                <p class="text-danger">※は必須項目です。</p>
                {!! MyForm::model($entity, array('route' => array('presents.valid', $entity->getKey())))!!}
                <div class="form-group col-md-8 row">
                    <label class="col-md-4 col-sm-2 col-form-label" for="InputText">
                        {!! $entity->tA('name') !!}
                        <span class="text-danger">※</span>
                    </label>
                    <div class="col-md-8 col-md-8 col-sm-5">
                        {!! MyForm::text('name', $entity->name,['placeholder'=> $entity->tA('name')]) !!}
                    </div>
                </div>
                <div class="form-group col-md-8 row">
                    <label class="col-md-4 col-sm-2 col-form-label" for="InputText">
                        {!! $entity->tA('quantity') !!}
                        <span class="text-danger">※</span>
                    </label>
                    <div class="col-md-8 col-md-8 col-sm-5">
                        {!! MyForm::text('quantity', $entity->quantity,['placeholder'=> $entity->tA('quantity')]) !!}
                    </div>
                </div>
                @if ($entity->id !== null)
                <div class="form-group col-md-8 row">
                    <label class="col-md-4 col-sm-2 col-form-label" for="InputText">
                        {!! $entity->tA('remain_quantity') !!}
                        <span class="text-danger">※</span>
                    </label>
                    <div class="col-md-8 col-md-8 col-sm-5">
                        {!! MyForm::text('remain_quantity', $entity->remain_quantity,['placeholder'=> $entity->tA('remain_quantity')]) !!}
                    </div>
                </div>
                @endif
                <div class="form-group col-md-8 row">
                    <label class="col-md-4 col-sm-2 col-form-label" for="InputText">
                        {!! $entity->tA('type') !!}
                        <span class="text-danger">※</span>
                    </label>
                    <div class="col-md-8 col-md-8 col-sm-5">
                        {!! MyForm::dropdown('type',$entity->type, getConfig('presents.types')) !!}
                    </div>
                </div>
                <div class="form-group col-md-8 row">
                    <label class="col-md-4 col-sm-2 col-form-label" for="InputText">
                        {!! $entity->tA('introduction') !!}
                        <span class="text-danger">※</span>
                    </label>
                    <div class="col-md-8 col-md-8 col-sm-5">
                        {!! MyForm::textarea('introduction', $entity->introduction,['placeholder'=> $entity->tA('introduction'), 'rows' => 5]) !!}
                    </div>
                </div>
                <div class="form-group col-md-8 row">
                    <label class="col-md-4 col-sm-2 col-form-label" for="InputText">
                        {!! $entity->tA('image') !!}
                        <span class="text-danger">※</span>
                    </label>
                    <div class="col-md-8 col-md-8 col-sm-5">
                        {!! MyForm::upload2('image', getConfig('file.presents.image')) !!}
                        <label class="btn btn-main-color mt10 label_upload" for="uploadFile-image">
                            <span class="ti-export" aria-hidden="true"> アップロード</span>
                        </label>
                    </div>
                </div>

                @include('layouts.backend.elements._submit_form_button')
            </div>
            {!! MyForm::close() !!}
        </div>
    </div>
</div>