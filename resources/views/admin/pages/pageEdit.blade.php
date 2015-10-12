@extends('layouts.admin')
@section('content')
    {!! Form::open(['action' => ['Admin\PagesController@update', $page->id], 'method' => 'put']) !!}
        <label>
            <div class="signature">Описание</div>
            <div class="field">
                <input type="text" name="description" value="{{$page->description}}">
            </div>
        </label>
        <label>
            <div class="signature">Ключевые слова</div>
            <div class="field">
                <input type="text" name="keywords" value="{{$page->keywords}}">
            </div>
        </label>
        <label>
            <div class="signature">Заголовок</div>
            <div class="field">
                <input type="text" name="title" value="{{$page->title}}">
            </div>
        </label>
        <label>
            <div class="signature">Заголовок страницы</div>
            <div class="field">
                <input type="text" name="page_title" value="{{$page->page_title}}">
            </div>
        </label>
        <label>
            <div class="signature">Текст</div>
            <div class="field">
                <textarea name="text" cols="30" rows="10">{{$page->text}}</textarea>
            </div>
        </label>
        <label>
            <div class="signature">Элементы</div>
            <div class="field">
                <textarea name="elements" cols="30" rows="10">{{$page->elements}}</textarea>
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