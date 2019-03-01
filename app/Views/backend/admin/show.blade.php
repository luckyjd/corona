@extends('layouts.backend.layouts.main')
@section('content')
    @include('layouts.backend.elements._show', [
        'icon' => 'ls-icon ls-icon-user',
        'isDeleteBtn'=> !$entity->isOwner()
    ])
@endsection