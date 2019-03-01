<?php
$jsFiles = [
    'vendor/popper.min',
    'vendor/bootstrap',
    'vendor/bootstrap-datepicker.min',
    'vendor/bootstrap-datepicker.ja.min',
    'vendor/utils/loadingoverlay.min',
    'vendor/utils/loadingoverlay_progress.min',
    'vendor/utils/moment.min',
    'vendor/utils/min',
    'vendor/utils/common',
    'vendor/utils/xhr',
    'vendor/utils/system',
    'vendor/bootstrap-timepicker.min',
    'vendor/ja',
    'vendor/jquery.maskedinput.min',
    'vendor/tippy',
    'vendor/wow.min',
    'vendor/ajaxzip3-source',
];
?>
{!! loadFiles($jsFiles, $area, 'js') !!}
@include('layouts.elements.footer_autoload')
<script>
    new WOW().init();
</script>