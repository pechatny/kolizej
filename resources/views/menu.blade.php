<div class="row">
    <div class="nav col-xs-12">
        <ul>
            @foreach($menuItems as $menuItem)
                @if($current == $menuItem->key)
                    <li class="active">
                @else
                    <li>
                @endif
                        <a href='/{{$menuItem->key}}'>{{ $menuItem->name }}</a>
                    </li>
            @endforeach
        </ul>
    </div>
    <div class="clear"></div>
</div>



