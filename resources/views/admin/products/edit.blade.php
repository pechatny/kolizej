@extends('layouts.admin')
@section('content')

    {!! Form::open(['action' => ['Admin\ProductsController@update', $item->id], 'files' => true ]) !!}

    <label>
        <div class="signature">Артикул</div>
        <div class="field">
            {!! Form::text('article', $item->article) !!}
        </div>
    </label>
    <label>
        <div class="signature">Название</div>
        <div class="field">
            {!! Form::text('name' , $item->name) !!}
        </div>
    </label>

    <label>
        <div class="signature">Категория</div>
        <div class="field">
            {!! Form::select('category_id', $categories, $item->category_id) !!}
        </div>
    </label>

    <label>
        <div class="signature">Цвет</div>
        <div class="field">
            {!! Form::select('color_id', $colors, $item->color_id) !!}
        </div>
    </label>

    <label>
        <div class="signature">Описание</div>
        <div class="field">
            {!! Form::text('description', $item->description) !!}
        </div>
    </label>
    <label>
        <div class="signature">Ключевые слова</div>
        <div class="field">
            {!! Form::text('keywords', $item->keywords) !!}
        </div>
    </label>
    <label>
        <div class="signature">Текст</div>
        <div class="field">
            {!! Form::text('text', $item->text) !!}
        </div>
    </label>
    <label>
        <div class="signature">Цена</div>
        <div class="field">
            {!! Form::text('price', $item->price) !!}
        </div>
    </label>
    <label>
        <div class="signature">Ширина</div>
        <div class="field">
            {!! Form::text('width', $item->width) !!}
        </div>
    </label>
    <label>
        <div class="signature">Высота</div>
        <div class="field">
            {!! Form::text('height', $item->height) !!}
        </div>
    </label>
    <label>
        <div class="signature">Глубина</div>
        <div class="field">
            {!! Form::text('depth', $item->depth) !!}
        </div>
    </label>
    <label>
        <div class="signature">Вес</div>
        <div class="field">
            {!! Form::text('weight', $item->weight) !!}
        </div>
    </label>
    <label>
        <div class="signature">Гарантия</div>
        <div class="field">
            {!! Form::text('warranty', $item->warranty) !!}
        </div>
    </label>

    <label>
        <div class="signature">В наличии</div>
        <div class="field">
            {!! Form::checkbox('stock', $item->stock) !!}
        </div>
    </label>
    <label>
        <div class="signature">Параметры</div>
        <div class="field">
            {!! Form::text('params', $item->params) !!}
        </div>
    </label>
    <label class="add_fields">
        <button class="add_field_button">Ещё картинку</button>
        <div class="field">

            @foreach($images as $image)
                <div class="input_fields_wrap">
                    {!! HTML::image('img/product/medium/'.$image, '', array('height' => '100')) !!}
                    {!! Form::hidden('loadedImages[]', $image) !!}
                    <button class="remove_field">Удалить</button>
                </div>
            @endforeach

            <div class="input_fields_wrap">{!! Form::file('images[]') !!}<button class="remove_field">Удалить</button></div>
        </div>
    </label>


    <input type="submit" name="submit" value="Сохранить" class="button">
    {!! Form::close() !!}

    @if($errors->has())
        <div class="error">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
            Запись <strong>не создана</strong>
        </div>
    @endif
@endsection

