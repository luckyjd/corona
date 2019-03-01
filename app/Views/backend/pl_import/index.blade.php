@extends('layouts.backend.layouts.main')
@section('content')
    <h1>Import Tool</h1>

    <div class="row">
        {!! MyForm::open(['route' => 'pl.import.import', 'class' => 'form-horizontal', 'enctype' => "multipart/form-data"]) !!}
        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" id="exampleInputFile" name="file_excel">
            <p class="help-block">Example block-level help text here.</p>
        </div>
        <div class="text-center">
            <button class="btn btn-primary" type="submit">OK</button>
        </div>
        {!! MyForm::close() !!}
    </div>

@endsection