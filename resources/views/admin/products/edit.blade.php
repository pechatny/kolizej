@extends('layouts.admin')
@section('content')
    {!! Form::open(['action' => ['Admin\ProductsController@update', $item->id], 'files' => true ]) !!}
    <label>
        <div class="signature">Артикул</div>
        <div class="field">
            {!! Form::text('article', $item->article ) !!}
        </div>
    </label>
    <label>
        <div class="signature">Название</div>
        <div class="field">
            {!! Form::text('name', $item->name ) !!}
        </div>
    </label>
    <label>
        <div class="signature">Описание</div>
        <div class="field">
            {!! Form::text('description', $item->description ) !!}
        </div>
    </label>
    <label>
        <div class="signature">Ключевые слова</div>
        <div class="field">
            {!! Form::text('keywords', $item->keywords ) !!}
        </div>
    </label>
    <label>
        <div class="signature">Текст</div>
        <div class="field">
            {!! Form::text('text', $item->text ) !!}
        </div>
    </label>
    <label>
        <div class="signature">Цена</div>
        <div class="field">
            {!! Form::text('price', $item->price ) !!}
        </div>
    </label>
    <label>
        <div class="signature">Ширина</div>
        <div class="field">
            {!! Form::text('width', $item->width ) !!}
        </div>
    </label>
    <label>
        <div class="signature">Высота</div>
        <div class="field">
            {!! Form::text('height', $item->height ) !!}
        </div>
    </label>
    <label>
        <div class="signature">Глубина</div>
        <div class="field">
            {!! Form::text('depth', $item->depth ) !!}
        </div>
    </label>
    <label>
        <div class="signature">Вес</div>
        <div class="field">
            {!! Form::text('weight', $item->weight ) !!}
        </div>
    </label>
    <label>
        <div class="signature">В наличии</div>
        <div class="field">
            {!! Form::text('stock', $item->stock ) !!}
        </div>
    </label>
    <label>
        <div class="signature">Параметры</div>
        <div class="field">
            {!! Form::text('params', $item->params ) !!}
        </div>
    </label>



    <label>
        <div class="signature">Изображение</div>
        <div class="field">
            {!! Form::file('image') !!}
        </div>
    </label>
    {{--<label>--}}
        {{--<div class="field">--}}
            {{--{!! HTML::image($item->image, '', array('height' => '200px')) !!}--}}
        {{--</div>--}}
    {{--</label>--}}

    <input type="submit" name="submit" value="Сохранить" class="button">
    {!! Form::close() !!}

    @if(count($errors) > 0)
        <div class="error">
            Запись <strong>не сохранена</strong>
        </div>
    @endif
@endsection