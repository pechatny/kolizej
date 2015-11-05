@extends('layouts.admin')
@section('content')


    {!! Form::open(['action' => array('Admin\ProductsController@store'), 'files' => true ]) !!}
    
    <div class="row">
        <label class="col-xs-3">
            <div class="signature">Название</div>
            <div class="field">
                {!! Form::text('name', old( 'name' )) !!}
            </div>
        </label>
        <label class="col-xs-3">
            <div class="signature">Категория</div>
            <div class="field">
                {!! Form::select('category_id', $categories, old( 'category_id' )) !!}
            </div>
        </label>
        <label class="col-xs-2">
            <div class="signature">Цена</div>
            <div class="field">
               {!! Form::text('price', old( 'price' )) !!}
            </div>
        </label>
        <label class="col-xs-2">
            <div class="signature">Артикул</div>
            <div class="field">
                {!! Form::text('article', old( 'article' )) !!}
            </div>
        </label>
        <label class="col-xs-2">
            <div class="signature">Конфигурация</div>
            <div class="field">
                {!! Form::select('configuration', array('0' => 'Нет', '1' => 'Да'), old( 'configuration' )) !!}
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
            <div class="input_color">
                {!! Form::select('colors[]', $colors, old( 'colors' )) !!} 
                <button class="remove_field">Удалить</button>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="row">
        <label class="col-xs-6">
            <div class="signature">Описание</div>
            <div class="field">
                {!! Form::text('description', old( 'description' )) !!}
            </div>
        </label>
        <label class="col-xs-6">
            <div class="signature">Ключевые слова</div>
            <div class="field">
                {!! Form::text('keywords', old( 'keywords' )) !!}
            </div>
        </label>
        <div class="clear"></div>
    </div>
    
    <div class="row">
        <label class="col-xs-2">
            <div class="signature">Ширина</div>
            <div class="field">
                {!! Form::text('width', old( 'width' )) !!}
            </div>
        </label>
        <label class="col-xs-2">
            <div class="signature">Высота</div>
            <div class="field">
                {!! Form::text('height', old( 'height' )) !!}
            </div>
        </label>
        <label class="col-xs-2">
            <div class="signature">Глубина</div>
            <div class="field">
                {!! Form::text('depth', old( 'depth' )) !!}
            </div>
        </label>
        <label class="col-xs-2">
            <div class="signature">Подъём на лифте</div>
            <div class="field">
                {!! Form::text('lift', old( 'lift' )) !!}
            </div>
        </label>
        <label class="col-xs-2">
            <div class="signature">Подъём вручную</div>
            <div class="field">
                {!! Form::text('lift_hand', old( 'lift_hand' )) !!}
            </div>
        </label>
        <label class="col-xs-2">
            <div class="signature">Сборка</div>
            <div class="field">
                {!! Form::text('assembly', old( 'assembly' )) !!}
            </div>
        </label>
    </div>

    <div class="row">
        <label class="col-xs-6">
            <div class="signature">Текст</div>
            <div class="field h100">
                {!! Form::textarea('text', old( 'text' )) !!}
            </div>
        </label>
        <label class="col-xs-6">
            <div class="signature">Параметры</div>
            <div class="field h100">
                {!! Form::textarea('params', old( 'params' )) !!}
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
                {!! Form::text('weight', old( 'weight' )) !!}
            </div>
        </label>
        <label class="col-xs-4">
            <div class="signature">Гарантия</div>
            <div class="field">
                {!! Form::text('warranty', old( 'warranty' )) !!}
            </div>
        </label>
        <label class="col-xs-4">
            <div class="signature">В наличии</div>
            <div class="field">
                {!! Form::checkbox('stock', old( 'stock' )) !!}
            </div>
        </label>
        <div class="clear"></div>
    </div>

    <input type="submit" name="submit" value="Создать" class="button">
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