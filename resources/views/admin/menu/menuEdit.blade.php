@extends('layouts.admin')
@section('content')
    {!! Form::open(['action' => ['Admin\MenuController@update', $menuItem->id], 'method' => 'put']) !!}
        <label>
        <div class="signature">Ключ</div>
        <div class="field">
            <input type="text" name="key" value="{{$menuItem->key}}">
        </div>
        </label>
        <label>
        <div class="signature">Имя</div>
        <div class="field">
            <input type="text" name="name" value="{{$menuItem->name}}">
        </div>
        </label>
        <label>
        <div class="signature">Сортировка</div>
        <div class="field">
            <input type="text" name="sort" value="{{$menuItem->sort}}">
        </div>
        </label>
            <input type="submit" name="submit" value="Сохранить" class="button">
    {!! Form::close() !!}

    @if(count($errors) > 0)
        <div class="error">
            Запись <strong>не сохранена</strong>
        </div>
    @endif
@endsection