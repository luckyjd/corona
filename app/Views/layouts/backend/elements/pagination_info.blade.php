@if($entities->total())
    @php
        $totalRecord  = $entities->total();
        $currentPage = $entities->currentPage();
        $perPage = $entities->perPage();
        // paging info variables
        $fromRecord = (int)($currentPage - 1) * $perPage + 1;
        $toRecord = (($currentPage * $perPage) - $totalRecord) > 0 ? $totalRecord : ($currentPage * $perPage);
    @endphp
    <div class="col-md-6 pb-2">{{$entities->total()}}件中 {{$fromRecord}}〜{{$toRecord}}件目を表示しています</div>
@endif
