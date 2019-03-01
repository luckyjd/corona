<script>
    window.addEventListener('load', () => {
        var loader = document.getElementById('loader');
        setTimeout(() => {
            loader.classList.add('fadeOut');
        }, 500);
    });
</script>
<?php
$jsFiles = [
    'vendor/jquery.min',
    'vendor/bootstrap',
    'vendor/bootstrap-datepicker.min',
    'vendor/bootstrap-datepicker.ja.min',
    'vendor/bootstrap-colorpicker',
    'vendor/bootstrap-timepicker',
    'vendor/jquery.maskedinput.min',
    'vendor/jquery.equalheight.min',
    'vendor/vendor',
    'vendor/bundle',
    'vendor/utils/loadingoverlay.min',
    'vendor/utils/loadingoverlay_progress.min',
    'vendor/utils/moment.min',
    'vendor/utils/min',
    'vendor/utils/common',
    'vendor/utils/xhr',
    'vendor/utils/system',
    'vendor/ja',
    'vendor/ajaxzip3-source',
    'vendor/cropper/handle',
];
?>
{!! loadFiles($jsFiles, $area, 'js') !!}
@include('layouts.elements.footer_autoload')