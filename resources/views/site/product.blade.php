@extends('layouts.catalog')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <div class="productView island">
                    <div class="big">
                        {!! HTML::image("img/product/detail-w570/".$product->images[0]) !!}
                        <a href="/img/product/original/{{$product->images[0]}}"></a>
                    </div>
                    <div class="preview" data-pos="0">
                        <div class="overlay">
                            <div class="move">
                                <div class="row">
                                    <div class="block active">
                                        <a href="/img/product/original/{{$product->images[0]}}">
                                            {!! HTML::image("img/product/gallery_preview-w108/".$product->images[0]) !!}
                                        </a>
                                    </div>
                                    @foreach($product->images as $key => $image)
                                        @if($key > 0)
                                            <div class="block">
                                                <a href="/img/product/original/{{$image}}">
                                                    {!! HTML::image("img/product/gallery_preview-w108/".$image) !!}
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <span class="back"></span>
                        <span class="next"></span>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="productInfo island">
                    <div class="text">
                        {!! $product->text !!}
                    </div>

                    <div class="row">
                        <div class="params column">
                            <b class="title">Параметры:</b>
                            Ширина: <span class="value">{{ $product->width }} мм</span><br>
                            Высота: <span class="value">{{ $product->height }} мм</span><br>
                            Глубина: <span class="value">{{ $product->depth }} мм</span><br>
                            @if($product->warranty)
                                Гарантия: <span class="value">{{ $product->warranty }} мес</span><br>
                            @endif
                            @if($product->weight)
                                Вес: <span class="value">{{ $product->weight }} кг</span>
                            @endif
                            @if($product->params) 
                                <div class="additional">{!! $product->params !!}</div>
                            @endif
                        </div>

                        <div class="color column">
                            <b class="title">Выбор цвета:</b>
                            @foreach($product->color as $color)
                                <div class="item{{ ($currentItem and $currentItem['color'] == $color->id) ? ' active' : '' }}" data-id="{{$color->id}}">
                                    <a href="/{{$color->image}}" class="preview" title="{{$color->name}}">
                                        {!! HTML::image($color->image, '', array('height' => '31')) !!}
                                    </a>
                                    <div class="label">
                                        <span>{{$color->name}}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="column forCart">
                            <div class="price right">{{$product->price}}</div>
                            <div class="clear"></div>

                            <div class="toCart right" data-id="{{$product->id}}">
                                <span class="add">Добавить в корзину</span>
                                <div class="counter">
                                    <input type="text" value="1">
                                    <div class="manage">
                                        <span class="plus"></span>
                                        <span class="minus"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                            
                            @if($product->configuration)
                                <div class="config">
                                    <b class="title">Вариант исполнения:</b>
                                    <div class="select">
                                        <div class="item first{{ (($currentItem and $currentItem['configuration'] == 'left') or !$currentItem['configuration']) ? ' selected' : '' }}" data-val="left">Левый</div>
                                        <div class="item last{{ ($currentItem and $currentItem['configuration'] == 'right') ? ' selected' : '' }}" data-val="right">Правый</div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            @endif

                            <div class="articul">
                                Артикул:
                                <span class="value">{{$product->article}}</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="bigheight clear"></div>


            <h2>Смотрите так же</h2>
            @foreach($recommended as $product)
                <div class="col-xs-3">
                    <div class="product">
                        <a href="/catalog/product/{{$product->id}}" class="image">
                            {!! HTML::image("img/product/product_card-w268/".$product->images[0]) !!}
                        </a>
                        <div class="layer">
                            <a href="/catalog/{{$product->category->key}}" class="category">{{$product->category->name}}</a>
                            <div class="title">
                                <a href="/catalog/product/{{$product->id}}">{{$product->name}}</a>
                                <div class="price">{{$product->price}}</div>
                            </div>
                            <div class="params">
                                Ширина: <span>{{$product->width}} мм</span><br>
                                Высота: <span>{{$product->height}} мм</span><br>
                                Глубина: <span>{{$product->depth}} мм</span>
                            </div>
                        </div>
                        <div class="toCart">
                            <span class="add">Добавить в корзину</span>
                            <div class="counter">
                                <input type="text" value="1">
                                <div class="manage">
                                    <span class="plus"></span>
                                    <span class="minus"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="clear"></div>
        </div>
    </div>
@endsection