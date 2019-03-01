 <div class="row gap-20 masonry pos-r">
    <div class="masonry-sizer col-md-6"></div>
    <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">
                    @include('layouts.backend.elements._form_label', ['icon' => 'ls-icon ls-icon-user'])
                </h6>
                <div class="mT-30">
                    <p class="text-danger">※は必須項目です。</p>
                    {!! MyForm::model($entity, array('route' => array('admin.valid', $entity->getKey())))!!}
                    <div class="form-group col-md-8 row pb-3">
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
                            {!! $entity->tA('email_text') !!}
                            <span class="text-danger">※</span>
                        </label>
                        <div class="col-md-8 col-md-8 col-sm-5">
                            {!! MyForm::email('email', $entity->email,['placeholder'=> $entity->tA('email')]) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-8 row">
                        <label class="col-md-4 col-sm-2 col-form-label" for="InputText">パスワード
                            {!!  $entity->getKey() ? '' : '<span class="text-danger">※</span>'!!}
                        </label>
                        <div class="col-md-8 col-sm-5">
                            {!! MyForm::password('password',['placeholder'=>$entity->tA('password')]) !!}
                            <span class="help-block">{{$entity->tA('password_note_text')}}</span>
                        </div>
                    </div>
                    <div class="form-group col-md-8 row">
                        <label class="col-md-4 col-sm-2 col-form-label" for="InputText">{{$entity->tA('password_confirmation')}}
                            {!!  $entity->getKey() ? '' : '<span class="text-danger">※</span>'!!}
                        </label>
                        <div class="col-md-8 col-sm-5">
                            {!! MyForm::password('password_confirmation',['placeholder'=>$entity->tA('password_confirmation')]) !!}
                        </div>
                    </div>
                    @include('layouts.backend.elements._submit_form_button')
                </div>
                {!! MyForm::close() !!}
            </div>
        </div>
</div>