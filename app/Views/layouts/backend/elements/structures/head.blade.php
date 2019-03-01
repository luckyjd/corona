<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>{{$title}}</title>
    <meta name="description" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{public_url('favicon.png')}}">
    <?php $cssFiles = [
        'vendor/ready',
        'vendor/style',
        'style',
        'custom',
        'vendor/cropper/cropper',
    ];
    $jsFiles = [
        'vendor/jquery.min',
        'vendor/cropper/cropper',
        'autoload/dashboard',
    ];
    ?>
    {!! loadFiles($jsFiles, $area, 'js') !!}
    {!! loadFiles($cssFiles, $area) !!}
    @include('layouts.elements.head_autoload')
    <!--[if lt IE 9]>
    {{Html::script('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}
    {{Html::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}
    <![endif]-->
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <script>
        window.convertMediaUrl = '{{route("convertMedia")}}';
        window.saveCropImgTmpFile = '{{route("saveCropImgTmpFile")}}';
    </script>
</head>