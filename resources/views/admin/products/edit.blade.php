@extends('layouts.admin')
@section('content')

    {!! Form::open(['action' => ['Admin\ProductsController@update', $item->id], 'files' => true ]) !!}
    
    <div class="row">
        <label class="col-xs-3">
            <div class="signature">Название</div>
            <div class="field">
                {!! Form::text('name' , $item->name) !!}
            </div>
        </label>
        <label class="col-xs-3">
            <div class="signature">Категория</div>
            <div class="field">
                {!! Form::select('category_id', $categories, $item->category_id) !!}
            </div>
        </label>
        <label class="col-xs-2">
            <div class="signature">Цена</div>
            <div class="field">
                {!! Form::text('price', $item->price) !!}
            </div>
        </label>
        <label class="col-xs-2">
            <div class="signature">Артикул</div>
            <div class="field">
                {!! Form::text('article', $item->article) !!}
            </div>
        </label>
        <label class="col-xs-2">
            <div class="signature">Конфигурация</div>
            <div class="field">
                {!! Form::select('configuration', array('0' => 'Нет', '1' => 'Да'), $item->configuration) !!}
            </div>
        </label>
        <div class="clear"></div>
    </div>

    <div class="row">
        <div class="signature col-xs-12">
            Цвета 
            <button class="add_color_button">Добавить цвет</button>
        </div>
        <div class="clear"></div>

        <div class="add_color">
            @if(count($item->color) == 0)
                <div class="input_color">
                    {!! Form::select('colors[]', $colors) !!}
                    <button class="remove_field">Удалить</button>
                </div>
            @endif

            @foreach($item->color as $formColor)
                <div class="input_color">
                    {!! Form::select('colors[]', $colors, $formColor->id) !!}
                    <button class="remove_field">Удалить</button>
                </div>
            @endforeach
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="row">
        <label class="col-xs-6">
            <div class="signature">Описание</div>
            <div class="field">
                {!! Form::text('description', $item->description) !!}
            </div>
        </label>
        <label class="col-xs-6">
            <div class="signature">Ключевые слова</div>
            <div class="field">
                {!! Form::text('keywords', $item->keywords) !!}
            </div>
        </label>
        <div class="clear"></div>
    </div>
    
    <div class="row">
        <label class="col-xs-2">
            <div class="signature">Ширина</div>
            <div class="field">
                {!! Form::text('width', $item->width) !!}
            </div>
        </label>
        <label class="col-xs-2">
            <div class="signature">Высота</div>
            <div class="field">
                {!! Form::text('height', $item->height) !!}
            </div>
        </label>
        <label class="col-xs-2">
            <div class="signature">Глубина</div>
            <div class="field">
                {!! Form::text('depth', $item->depth) !!}
            </div>
        </label>
        <label class="col-xs-2">
            <div class="signature">Подъём на лифте</div>
            <div class="field">
                {!! Form::text('lift', $item->lift ) !!}
            </div>
        </label>
        <label class="col-xs-2">
            <div class="signature">Подъём вручную</div>
            <div class="field">
                {!! Form::text('lift_hand', $item->lift_hand ) !!}
            </div>
        </label>
        <label class="col-xs-2">
            <div class="signature">Сборка</div>
            <div class="field">
                {!! Form::text('assembly', $item->assembly ) !!}
            </div>
        </label>
    </div>

    <div class="row">
        <label class="col-xs-6">
            <div class="signature">Текст</div>
            <div class="field h100">
                {!! Form::textarea('text', $item->text) !!}
            </div>
        </label>
        <label class="col-xs-6">
            <div class="signature">Параметры</div>
            <div class="field h100">
                {!! Form::textarea('params', $item->params) !!}
            </div>
        </label>
        <div class="clear"></div>
    </div>

    <div class="add_fields">
        <div class="signature">
            Изображения
            <button class="add_field_button">Ещё изображение</button>
        </div>
        <div class="field row">
            @foreach($images as $image)
                <div class="input_fields_wrap">
                    <div class="layer">
                        {!! HTML::image('img/product/product_card-w268/'.$image, '', array('height' => '100')) !!}
                        {!! Form::hidden('loadedImages[]', $image) !!}
                        <button class="remove_field">Удалить</button>
                    </div>
                </div>
            @endforeach
            <div class="input_fields_wrap">
                <div class="layer">
                    {!! Form::file('images[]') !!}
                    <button class="remove_field">Удалить</button>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="row">
        <label class="col-xs-4">
            <div class="signature">Вес</div>
            <div class="field">
                {!! Form::text('weight', $item->weight) !!}
            </div>
        </label>
        <label class="col-xs-4">
            <div class="signature">Гарантия</div>
            <div class="field">
                {!! Form::text('warranty', $item->warranty) !!}
            </div>
        </label>
        <label class="col-xs-4">
            <div class="signature">В наличии</div>
            <div class="field">
                {!! Form::checkbox('stock', $item->stock) !!}
            </div>
        </label>
        <div class="clear"></div>
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

