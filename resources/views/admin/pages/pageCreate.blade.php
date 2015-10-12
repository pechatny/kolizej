@extends('layouts.admin')
@section('content')

    {!! Form::open(['action' => 'Admin\PagesController@store', 'method' => 'put']) !!}
        <label>
            <div class="signature">Ключ</div>
            <div class="field">
                <input type="text" name="key" value="{{ old('key') }}">
            </div>
        </label>
        <label>
            <div class="signature">Описание</div>
            <div class="field">
                <input type="text" name="description" value="{{ old('description') }}">
            </div>
        </label>
        <label>
            <div class="signature">Ключевые слова</div>
            <div class="field">
                <input type="text" name="keywords" value="{{ old('keywords') }}">
            </div>
        </label>
        <label>
            <div class="signature">Заголовок</div>
            <div class="field">
                <input type="text" name="title" value="{{ old('title') }}">
            </div>
        </label>
        <label>
            <div class="signature">Заголовок страницы</div>
            <div class="field">
                <input type="text" name="page_title" value="{{ old('page_title') }}">
            </div>
        </label>
        <label>
            <div class="signature">Текст</div>
            <div class="field">
                <textarea name="text" cols="30" rows="10">{{ old('text') }}</textarea>
            </div>
        </label>
        <label>
            <div class="signature">Елементы</div>
            <div class="field">
                <textarea name="elements" cols="30" rows="10">{{ old('elements') }}</textarea>
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