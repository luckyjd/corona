@extends('layouts.frontend.layouts.main')
@section('content')
<div class="content">
    <div class="listPresent listPresentOnePt">
        <h2 class="title">List present 1pt</h2>
        <div class="row">
            @foreach ($presentsOnePt as $item)
                <div class="col-md-4">
                    <div class="present itemOnePt">
                        <div class="name-item">{{ $item->name }}</div>
                        <img src="{{ $item->image }}" alt="name" class="img-present" width="">
                        <button class="btn-present" data-id="{{$item->id}}" id="present_{{$item->id}}">1PT</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="listPresent listPresentFivePt">
        <h2 class="title">List present 5pt</h2>
        <div class="row">
            @foreach ($presentsFivePt as $item)
                <div class="col-md-4">
                    <div class="present itemFivePt">
                        <div class="name-item">{{ $item->name }}</div>
                        <img src="{{ $item->image }}" alt="name" class="img-present" width="">
                        <button class="btn-present" data-id="{{$item->id}}" id="present_{{$item->id}}">5PT</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection