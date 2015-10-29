@extends('layouts.page')
@section('content')
   <div class="container">
   	<form action="/search" class="search page">
   		<input name="val"  type="text" placeholder="Поиск" value="">
   		<input type="submit" value="">
   		<div class="clear"></div>
   	</form>

   	<div class="row">
            @if($products)
                @include('include.productsList');
            @endif
   		<div class="clear"></div>
   	</div>
   </div>
@endsection