<ul class="list-group">
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('name')}}</strong>
        <br/>{{$entity->name}}
    </li>
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('email')}}</strong>
        <br/>{{$entity->email}}
    </li>
    <li class="list-group-item">
        <strong class="text-primary">{{$entity->tA('password')}}</strong>
        <br/>{!! $entity->passwordText()!!}
    </li>
</ul>