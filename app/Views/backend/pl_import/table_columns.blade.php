@extends('layouts.backend.layouts.main')
@section('content')
    <h1>Table column</h1>
    {{"'".implode("','", $columns)."'"}}
@endsection