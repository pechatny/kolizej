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


    <div>
        <div class="signature">Цвета</div>
        <button class="add_color_button">Добавить цвет</button>
        <div class="add_color">
            @if(count($item->color) == 0)
                <div class="input_color">{!! Form::select('colors[]', $colors) !!} <button class="remove_field">Удалить</button></div>
            @endif

            @foreach($item->color as $formColor)
                    <div class="input_color">{!! Form::select('colors[]', $colors, $formColor->id) !!} <button class="remove_field">Удалить</button></div>
            @endforeach
        </div>
    </div>


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
        <div class="signature">Доставка</div>
        <div class="field">
            {!! Form::text('delivery', $item->delivery ) !!}
        </div>
    </label>
    <label>
        <div class="signature">Подъём</div>
        <div class="field">
            {!! Form::text('lift', $item->lift ) !!}
        </div>
    </label>
    <label>
        <div class="signature">Сборка</div>
        <div class="field">
            {!! Form::text('assembly', $item->assembly ) !!}
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
    <div class="add_fields">
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
    </div>


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

