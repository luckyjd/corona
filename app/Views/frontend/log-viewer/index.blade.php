<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel log viewer</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body {
            padding: 25px;
        }

        h1 {
            font-size: 1.5em;
            margin-top: 0;
        }

        .stack {
            font-size: 0.85em;
        }

        .date {
            min-width: 75px;
        }

        .text {
            word-break: break-all;
        }

        a.llv-active {
            z-index: 2;
            background-color: #f5f5f5;
            border-color: #777;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <h1><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Laravel Log Viewer</h1>
            <p class="text-muted"><i>by Rap2h</i></p>
            <div id="jstree_demo"></div>
            <div class="list-group hide">

                @php
                $fileList = [];
                @endphp
                @foreach($files as $file)
                    @php
                        $fileX = explode('logs/', $file);
                        $fileName = last($fileX);
                        $file = explode('/', $fileName);
                        $hash = base64_encode($fileName);
                        $fileList[array_first($file)][$file[1]][] = $hash
                    @endphp
                    <a href="?l={{ $hash }}&password={{Input::get('password')}}" data-hash="{{$hash}}"
                       class="list-group-item @if ($current_file == $file) llv-active @endif">
                        {{$fileName}}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-sm-9 col-md-10 table-container">
            @if ($logs === null)
                <div>
                    Log file >50M, please download it.
                </div>
            @else
                <table id="table-log" class="table table-striped">
                    <thead>
                    <tr>
                        <th>Level</th>
                        <th>Context</th>
                        <th>Date</th>
                        <th>Content</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($logs as $key => $log)
                        <tr data-display="stack{{{$key}}}">
                            <td class="text-{{{$log['level_class']}}}"><span
                                        class="glyphicon glyphicon-{{{$log['level_img']}}}-sign"
                                        aria-hidden="true"></span> &nbsp;{{$log['level']}}</td>
                            <td class="text">{{$log['context']}}</td>
                            <td class="date">{{{$log['date']}}}</td>
                            <td class="text">
                                @if ($log['stack']) <a class="pull-right expand btn btn-default btn-xs"
                                                       data-display="stack{{{$key}}}"><span
                                            class="glyphicon glyphicon-search"></span></a>@endif
                                {{{$log['text']}}}
                                @if (isset($log['in_file'])) <br/>{{{$log['in_file']}}}@endif
                                @if ($log['stack'])
                                    <div class="stack" id="stack{{{$key}}}"
                                         style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}
                                    </div>@endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            @endif
            <div>
                @if($current_file)
                    <a href="?dl={{ base64_encode($current_file) }}&password={{Input::get('password')}}"><span
                                class="glyphicon glyphicon-download-alt"></span>
                        Download file</a>
                    -
                    <a id="delete-log"
                       href="?del={{ base64_encode($current_file) }}&password={{Input::get('password')}}"><span
                                class="glyphicon glyphicon-trash"></span> Delete file</a>
                    @if(count($files) > 1)
                        -
                        <a id="delete-all-log" href="?delall=true&password={{Input::get('password')}}"><span
                                    class="glyphicon glyphicon-trash"></span> Delete all files</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script>
    $(document).ready(function () {
        $('.table-container tr').on('click', function () {
            $('#' + $(this).data('display')).toggle();
        });
        $('#table-log').DataTable({
            "order": [1, 'desc'],
            "stateSave": true,
            "stateSaveCallback": function (settings, data) {
                window.localStorage.setItem("datatable", JSON.stringify(data));
            },
            "stateLoadCallback": function (settings) {
                var data = JSON.parse(window.localStorage.getItem("datatable"));
                if (data) data.start = 0;
                return data;
            }
        });
        $('#delete-log, #delete-all-log').click(function () {
            return confirm('Are you sure?');
        });
    });

    $('#jstree_demo').jstree({
        "core": {
            "animation": 0,
            "check_callback": true,
            "themes": {"stripes": true},
            'data': [
                    @php $i = $j = 0; @endphp
                    @foreach($fileList as $key => $file)
                    {
                        "id": "root-{{$key}}{{$i}}",
                        "text": "{{$key}}",
                        "children": [
                                @foreach($file as $keyx => $filex)
                                    {
                                    "text": "{{$keyx}}",
                                    "children": [
                                            @foreach($filex as $keyxx => $filexx)
                                            @php $fileName = base64_decode($filexx);
                                                $fileName = explode('/', $fileName);
                                            @endphp
                                                {"text": "{{last($fileName)}}", "children": true, "id": "{{$filexx}}", "icon": "file"},
                                            @endforeach
                                    ],
                                "id": "{{$keyx}}{{$j}}",
                                    },
                                @php $j++ @endphp
                                @endforeach
                        ],
                        "type": "root"
                    },
                @php $i++ @endphp
                @endforeach
            ]
        },
    });

    $('#jstree_demo').on('loaded.jstree', function () {
        $('#jstree_demo').jstree(true).select_node('{{\Illuminate\Support\Facades\Input::get('l')}}');
    });
    $('#jstree_demo').on("changed.jstree", function (e, data) {
        var id = $(this).attr('id');
        var href = $('a[data-hash="' + data.selected + '"]').attr('href');
        if(href && data.selected != "{{ Input::get('l') }}"){
            window.location.href = href;
        }
    });
</script>
</body>
</html>
