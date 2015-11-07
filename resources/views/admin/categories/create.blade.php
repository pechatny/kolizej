@extends('layouts.admin')
@section('content')

    {!! Form::open(['action' => array('Admin\CategoriesController@store'), 'files' => true ]) !!}
        <label>
            <div class="signature">Ключ</div>
            <div class="field">
                {!! Form::text('key', old('key') ) !!}
            </div>
        </label>
        <label>
            <div class="signature">Ключевые слова</div>
            <div class="field">
                {!! Form::text('keywords', old('keywords')) !!}
            </div>
        </label>
        <label>
            <div class="signature">Описание</div>
            <div class="field">
                {!! Form::text('description', old('description')) !!}
            </div>
        </label>
        <label>
            <div class="signature">Название категории</div>
            <div class="field">
                {!! Form::text('name', old('name')) !!}
            </div>
        </label>
        <label>
            <div class="signature">Сортировка</div>
            <div class="field">
                {!! Form::text('sort', old('sort')) !!}
            </div>
        </label>
        <label>
            <div class="signature">Изображение</div>
            <div class="field">
                {!! Form::file('image', old('image')) !!}
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