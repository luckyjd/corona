<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}}</title>
    <meta name="description" content="{{isset($description) ? $description : ''}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{public_url('favicon.ico')}}">
    <link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:500" rel="stylesheet">
    <?php $cssFiles = [
        'tippy',
        'vendor/animate',
        'style',
    ];
    $jsFiles = [
        'vendor/jquery.min',
    ];
    ?>
    {!! loadFiles($jsFiles, $area, 'js') !!}
    {!! loadFiles($cssFiles, $area) !!}
    @include('layouts.elements.head_autoload')
    <!--[if lt IE 9]>
    {{Html::script('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}
    {{Html::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}
    <![endif]-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109239638-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-109239638-2');
    </script>
</head>