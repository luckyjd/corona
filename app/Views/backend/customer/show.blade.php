@extends('layouts.backend.layouts.main')
@section('content')
    @php
        $isDeleteBtn = true;
        $isEditBtn = false;
    @endphp

    @include('layouts.backend.elements._show', [
        'icon' => 'ls-icon ls-icon-user',
    ])
@endsection