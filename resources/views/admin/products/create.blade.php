@extends('layouts.admin')
@section('content')


    {!! Form::open(['action' => array('Admin\ProductsController@store'), 'files' => true ]) !!}

    <label>
        <div class="signature">Артикул</div>
        <div class="field">
            {!! Form::text('article', old( 'article' )) !!}
        </div>
    </label>
    <label>
        <div class="signature">Название</div>
        <div class="field">
            {!! Form::text('name', old( 'name' )) !!}
        </div>
    </label>

    <label>
        <div class="signature">Категория</div>
        <div class="field">
            {!! Form::select('category_id', $categories, old( 'category_id' )) !!}
        </div>
    </label>

    <label>
        <div class="signature">Описание</div>
        <div class="field">
            {!! Form::text('description', old( 'description' )) !!}
        </div>
    </label>
    <label>
        <div class="signature">Ключевые слова</div>
        <div class="field">
            {!! Form::text('keywords', old( 'keywords' )) !!}
        </div>
    </label>
    <label>
        <div class="signature">Текст</div>
        <div class="field">
            {!! Form::text('text', old( 'text' )) !!}
        </div>
    </label>
    <label>
        <div class="signature">Цена</div>
        <div class="field">
            {!! Form::text('price', old( 'price' )) !!}
        </div>
    </label>
    <label>
        <div class="signature">Ширина</div>
        <div class="field">
            {!! Form::text('width', old( 'width' )) !!}
        </div>
    </label>
    <label>
        <div class="signature">Высота</div>
        <div class="field">
            {!! Form::text('height', old( 'height' )) !!}
        </div>
    </label>
    <label>
        <div class="signature">Глубина</div>
        <div class="field">
            {!! Form::text('depth', old( 'depth' )) !!}
        </div>
    </label>
    <label>
        <div class="signature">Вес</div>
        <div class="field">
            {!! Form::text('weight', old( 'weight' )) !!}
        </div>
    </label>
    <label>
        <div class="signature">Гарантия</div>
        <div class="field">
            {!! Form::text('warranty', old( 'warranty' )) !!}
        </div>
    </label>

    <label>
        <div class="signature">В наличии</div>
        <div class="field">
            {!! Form::checkbox('stock', old( 'stock' )) !!}
        </div>
    </label>
    <label>
        <div class="signature">Параметры</div>
        <div class="field">
            {!! Form::text('params', old( 'params' )) !!}
        </div>
    </label>
    <label class="add_fields">
        <button class="add_field_button">Ещё картинку</button>
        <div class="signature">Изображения</div>
        <div class="field">
            <div class="input_fields_wrap">{!! Form::file('images[]') !!}<button class="remove_field">Удалить</button></div>

        </div>
    </label>


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