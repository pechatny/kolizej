@extends('layouts.admin')
@section('content')

	<div class="clear">
		<h1 class="left">{{$title}}</h1>
		<a href="{{$route}}/create" class="button">Создать новую</a>
	</div>

	<div class="list clear">
		   <div class="head row">
					<div class="col col-xs-2">id</div>
					<div class="col col-xs-2">Название</div>
					<div class="col col-xs-2">Изображение</div>
			   <div class="clear"></div>
		   </div>

		@foreach($items as $item)
			<div class="block row">
				<div class="col col-xs-2">{{$item->id}}</div>
				<div class="col col-xs-2">{{$item->name}}</div>
				<div class="col col-xs-2">{!! HTML::image($item->image, '', array('height' => '50px')) !!}</div>
				<div class="col col-xs-4">
					<a href="{{$route}}/edit/{{$item->id}}" class="edit">Редактировать</a>
					<a href="{{$route}}/delete/{{$item->id}}" class="del">Удалить</a>
				</div>
				<div class="clear"></div>
			</div>
		@endforeach
	</div>
@endsection