@extends('layouts.admin')
@section('content')

	<div class="clear">
		<h1 class="left">{{$title}}</h1>
		<a href="{{$route}}/create" class="button">Создать новую</a>
	</div>

	<div class="list clear">
		   <div class="head row">
					<div class="col col-xs-2">id</div>
					<div class="col col-xs-2">Ключ</div>
					<div class="col col-xs-2">Название</div>
			   <div class="clear"></div>
		   </div>

		@foreach($pages as $page)
			<div class="block row">
				<div class="col col-xs-2">{{$page->id}}</div>
				<div class="col col-xs-2">{{$page->key}}</div>
				<div class="col col-xs-2">{{$page->title}}</div>
				<div class="col col-xs-4">
					<a href="{{$route}}/edit/{{$page->id}}" class="edit">Редактировать</a>
					<a href="{{$route}}/delete/{{$page->id}}" class="del">Удалить</a>
				</div>
				<div class="clear"></div>
			</div>
		@endforeach
	</div>
@endsection