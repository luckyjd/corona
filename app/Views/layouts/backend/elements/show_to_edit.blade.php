<?php
$route = str_replace('.show', '.', $routeName);
$isEditBtn = isset($isEditBtn) ? $isEditBtn : true;
$isDeleteBtn = isset($isDeleteBtn) ? $isDeleteBtn : false;
?>
<div class="text-center">
    <span class="padr20 sp-padr5"><a class="btn btn-default" href="{{getBackUrl()}}"><span class="ti-back-left" aria-hidden="true"> 戻る</span></a></span>
    @if($isEditBtn)
        <span class="padr20 sp-padr5"><a class="btn btn-main-color" href="{{backUrl($route.'edit', $entity->getKey())}}"><span class="ti-check" aria-hidden="true"> 編集する</span></a></span>
    @endif
    @if($isDeleteBtn)
        <span><a class="btn btn-danger delete-action" data-action="{{route($route.'destroy', $entity->getKeyWithName() + [\App\Helpers\Url::QUERY=> Input::get(\App\Helpers\Url::QUERY)])}}" href="#del-confirm" style="display:inline-block" data-toggle="modal" ><span class="ti-close" aria-hidden="true"> {{trans('actions.destroy')}}する</span></a></span>
    @endif
</div>