@extends('layouts.admin')
@section('content')
	<div class="clear">
		<h1 class="left">{{$title}}</h1>
		<a href="{{$route}}/create" class="button">Создать новую</a>
	</div>

	<div class="list clear">
		   <div class="head row">
			   @foreach($menuNames as $name)
					<div class="col col-xs-2">{{$name}}</div>
			   @endforeach
			   <div class="clear"></div>
		   </div>

		@foreach($menuItems as $menuItem)
			<div class="block row">
				<div class="col col-xs-2">{{$menuItem->key}}</div>
				<div class="col col-xs-2">{{$menuItem->name}}</div>
				<div class="col col-xs-2">{{$menuItem->sort}}</div>
				<div class="col col-xs-4">
					<a href="{{$route}}/edit/{{$menuItem->id}}" class="edit">Редактировать</a>
					<a href="{{$route}}/delete/{{$menuItem->id}}" class="del">Удалить</a>
				</div>
				<div class="clear"></div>
			</div>

		@endforeach
	</div>
@endsection