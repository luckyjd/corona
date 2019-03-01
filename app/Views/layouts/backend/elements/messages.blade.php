@if(!isset($show_success) || $show_error == true)
    <div id="success_msg">
        @if(Session()->has('success'))
            <div class="row">
                <div class="col-md-12">
                    @php
                        $successMsg = (array)Session()->get('success')
                    @endphp
                    <ul class="col-md-12 alert alert-success">
                        @foreach($successMsg as $msg)
                            <li>
                                <i class="fa fa-check"></i>
                                <strong>{{$msg}}</strong>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endif
@if(!isset($show_error) || $show_error == true)
    <div id="error_msg">
        @if (!empty($errors) && count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endif