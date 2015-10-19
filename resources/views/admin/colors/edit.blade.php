@extends('layouts.admin')
@section('content')
    {!! Form::open(['action' => ['Admin\ColorsController@update', $item->id], 'files' => true ]) !!}
    <label>
        <div class="signature">Название</div>
        <div class="field">
            {!! Form::text('name', $item->name ) !!}
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