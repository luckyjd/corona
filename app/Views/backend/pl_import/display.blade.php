@extends('layouts.backend.layouts.main')
@section('content')
    <h1>Data Migrate</h1>
    <div class="row">
        <div class="col-md-12">
            @foreach($data as $table)
                <h3>{{$table['title']}}</h3>
                @foreach($table['attr'] as $attr)
                    <p>{{$attr}}</p>
                @endforeach
                <p>$table->actionBy();</p>
                <p>$table->timestamps();</p>
                <p>$table->softDeletes();</p>
            @endforeach
        </div>
    </div>
@endsection