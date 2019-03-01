<ul class="list-group">
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('name')}}</strong>
        <br/>{{$entity->name}}
    </li>
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('quantity')}}</strong>
        <br/>{{$entity->quantity}}
    </li>
    @if (isset($entity->remain_quantity))
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('remain_quantity')}}</strong>
        <br/>{{$entity->remain_quantity}}
    </li>
    @endif
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('type')}}</strong>
        <br/>{{$entity->typeText()}}
    </li>
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('introduction')}}</strong>
        <br/>{!! ebr($entity->introduction) !!}
    </li>
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('image')}}</strong>
        <br/>{!! $entity->getImgView('image') !!}
    </li>
</ul>