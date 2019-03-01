<ul class="list-group">
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('name')}}</strong>
        <br/>{{$entity->getFullName()}}
    </li>
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('email')}}</strong>
        <br/>{{$entity->email}}
    </li>
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('point')}}</strong>
        <br/>{{$entity->point}}
    </li>
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('type')}}</strong>
        <br/>{{$entity->typeText()}}
    </li>
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('tel')}}</strong>
        <br/>{{$entity->telText()}}
    </li>
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('zip_code')}}</strong>
        <br/>{{$entity->zipCodeText()}}
    </li>
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('pref_id')}}</strong>
        <br/>{{$entity->prefText()}}
    </li>
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('address')}}</strong>
        <br/>{{$entity->address}}
    </li>
</ul>