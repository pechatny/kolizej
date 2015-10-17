@extends('layouts.admin')
@section('content')

    {!! Form::open(['action' => array('Admin\ColorsController@store'), 'files' => true ]) !!}

        <label>
            <div class="signature">Название</div>
            <div class="field">
                {!! Form::text('name', old('name')) !!}
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