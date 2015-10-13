<div class="folder col-xs-2">
    <div class="title">Информация</div>
    <div class="block">
        @foreach($menuItems as $menuItem)
            <a href="/{{$menuItem->key}}">{{$menuItem->name}}</a>
        @endforeach
    </div>
</div>

