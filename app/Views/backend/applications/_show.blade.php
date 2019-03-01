<ul class="list-group">
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('present_name')}}</strong>
        <br/>
        {{$entity->tryGet('present')->name}}
    </li>
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('present_type')}}</strong>
        <br/>{{$entity->tryGet('present')->typeText()}}
    </li>
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('status')}}</strong>
        <br/>{{$entity->statusText()}}
    </li>
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('user_email')}}</strong>
        <br/>{{$entity->tryGet($entity->isWinner() ? 'user': 'shipping')->email}}
    </li>
    @if($entity->isWinner())
        <li class="list-group-item">
            <strong class="text-primary">{{$entity->tA('user_name')}}</strong>
            <br/>{{$entity->tryGet('shipping')->getFullName()}}
        </li>
        <li class="list-group-item">
            <strong class="text-primary">{{$entity->tA('user_tel')}}</strong>
            <br/>{{$entity->tryGet('shipping')->telText()}}
        </li>
        <li class="list-group-item">
            <strong class="text-primary">{{$entity->tA('user_store_list')}}</strong>
            <br/>{{$entity->storeListText()}}
        </li>
        <li class="list-group-item">
            <strong class="text-primary">{{$entity->tA('user_address')}}</strong>
            <br/>{{$entity->addressText()}}
        </li>
    @endif
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('created_by')}}</strong>
        <br/>{{$entity->tryGet('user')->getName()}}
    </li>
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('ins_datetime')}}</strong>
        <br/>{{$entity->ins_datetime}}
    </li>
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('upd_datetime')}}</strong>
        <br/>{{$entity->upd_datetime}}
    </li>
</ul>