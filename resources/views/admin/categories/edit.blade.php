@extends('layouts.admin')
@section('content')
    {!! Form::open(['action' => ['Admin\CategoriesController@update', $item->id], 'files' => true ]) !!}
    <label>
        <div class="signature">Ключ</div>
        <div class="field">
            {!! Form::text('key', $item->key ) !!}
        </div>
    </label>
    <label>
        <div class="signature">Ключевые слова</div>
        <div class="field">
            {!! Form::text('keywords', $item->keywords) !!}
        </div>
    </label>
    <label>
        <div class="signature">Описание</div>
        <div class="field">
            {!! Form::text('description', $item->description) !!}
        </div>
    </label>
    <label>
        <div class="signature">Название категории</div>
        <div class="field">
            {!! Form::text('name', $item->name) !!}
        </div>
    </label>
    <label>
        <div class="signature">Изображение</div>
        <div class="field">
            {!! Form::file('image') !!}
        </div>
    </label>
    <label>
        <div class="field">
            {!! HTML::image($item->image, '', array('height' => '200px')) !!}
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