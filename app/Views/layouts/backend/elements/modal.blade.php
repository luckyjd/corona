<div class="modal" id="del-confirm" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-label">削除確認</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">削除します。
                <br>よろしいですか？
            </div>
            <div class="modal-footer">
                {!! MyForm::delete() !!}
                <a href="#" class="btn btn-default" data-dismiss="modal">いいえ</a>
                <button type="submit" class="btn btn-main-color">はい</button>
                {!! MyForm::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="modal" id="mass_destroy_confirm" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-label">一括削除確認</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">選択されたデータを一括削除します。
                <br>よろしいですか？
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">いいえ</a>
                <a href="#mass_destroy_reconfirm" data-toggle="modal" class="btn btn-main-color">はい</a>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="mass_destroy_reconfirm" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-label">一括削除確認</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p></p>
                <p>
                    本当によろしいですね？
                </p>
            </div>
            <div class="modal-footer">
                {!! MyForm::massDelete() !!}
                <a href="#" class="btn btn-warning close-parent-modal" data-parent-modal="mass_destroy_confirm"
                   data-dismiss="modal">いいえ</a>
                <button type="submit" class="btn btn-danger">はい</button>
                {!! MyForm::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_crop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">画像を刈込する</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <img id="image" src="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">いいえ</button>
                <button type="button" class="btn btn-main-color pull-right" id="crop">はい</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="modalConfirmDelete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-label">削除確認</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">削除します。
                <br>よろしいですか？
            </div>
            <div class="modal-footer">
                {!! MyForm::delete() !!}
                <a href="#" class="btn btn-default" data-dismiss="modal">いいえ</a>
                <button type="submit" class="btn btn-main-color">はい</button>
                {!! MyForm::close() !!}
            </div>
        </div>
    </div>
</div>