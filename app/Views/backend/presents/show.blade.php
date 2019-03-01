@extends('layouts.backend.layouts.main')
@section('content')
    @php
        $isDeleteBtn = !$entity->isApplicationUse();
    @endphp
    @include('layouts.backend.elements._show', [
        'icon' => 'ls-icon ls-icon-gift',
        'isDeleteBtn'=> $isDeleteBtn
    ])
@endsection