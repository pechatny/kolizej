@extends('layouts.admin')
@section('content')
    {!! Form::open(['action' => 'Admin\MenuController@store', 'method' => 'put']) !!}
        <label>
        <div class="signature">Ключ</div>
        <div class="field">
            <input type="text" name="key">
        </div>
        </label>
        <label>
        <div class="signature">Имя</div>
        <div class="field">
            <input type="text" name="name">
        </div>
        </label>
        <label>
        <div class="signature">Сортировка</div>
        <div class="field">
            <input type="text" name="sort">
        </div>
        </label>
            <input type="submit" name="submit" value="Создать" class="button">
    {!! Form::close() !!}

    @if(count($errors) > 0)
        <div class="error">
            Запись <strong>не создана</strong>
        </div>
    @endif
@endsection