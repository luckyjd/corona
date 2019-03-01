<div class="text-center">
    <span class="padr20">
    <a class="btn btn-default" href="{{getBackUrl(true)}}">
        <span class="ls-icon ls-icon-reply" aria-hidden="true">戻る</span>
    </a>
    </span>
    <a class="btn btn-main-color" href="" data-toggle="modal"
       data-target="#{{$entity->getKey(true) ? 'update_confirm' : 'create_confirm'}}">
        <span class="ls-icon ls-icon-check" aria-hidden="true">{{$entity->getKey(true) ? '修正する' : '登録する'}}</span>
    </a>
</div>

<!-- モーダル・ダイアログ -->
<div class="modal" id="create_confirm" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-label">登録確認</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">登録します。
                <br>よろしいですか？
            </div>
            <div class="modal-footer">
                {!! MyForm::confirm($entity, $controllerName) !!}
                <button type="button" class="btn btn-default" data-dismiss="modal">いいえ</button>
                <button type="submit" class="btn btn-main-color">はい</button>
                {!! MyForm::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="modal" id="update_confirm" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-label">修正確認</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">修正します。
                <br>よろしいですか？
            </div>
            <div class="modal-footer">
                {!! MyForm::confirm($entity, $controllerName) !!}
                <button type="button" class="btn btn-default" data-dismiss="modal">いいえ</button>
                <button type="submit" class="btn btn-main-color">はい</button>
                {!! MyForm::close() !!}
            </div>
        </div>
    </div>
</div>
