@extends('layouts.catalog')
@section('content')
    <div class="container">
        <div class="row">
            <div class="menu col-xs-3">
                <div class="island category">
                    <div class="title">Категории мебели</div>
                    <ul>
                        @foreach($categories as $category)
                            <li><a href="{{$category->key}}">{{$category->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="filter island">
                    <div class="title">Параметры</div>

                    <div class="block" data-filter="width">
                        <div class="rus">Ширина:</div>
                        <div class="fields">
                            <label class="line">
                                <span class="signature">от</span>
                                <input type="text" value="200" class="min">
                            </label>
                            <label class="line">
                                <span class="signature">до</span>
                                <input type="text" value="700" class="max">
                            </label>
                            <div class="ed">мм</div>
                            <div class="clear"></div>
                        </div>
                        <div class="slider"></div>
                        <div class="range">
                            <div class="min">100 мм</div>
                            <div class="max">900 мм</div>
                        </div>
                        <div class="step">1</div>
                    </div>

                    <div class="block" data-filter="height">
                        <div class="rus">Высота:</div>
                        <div class="fields">
                            <label class="line">
                                <span class="signature">от</span>
                                <input type="text" value="200" class="min">
                            </label>
                            <label class="line">
                                <span class="signature">до</span>
                                <input type="text" value="700" class="max">
                            </label>
                            <div class="ed">мм</div>
                            <div class="clear"></div>
                        </div>
                        <div class="slider"></div>
                        <div class="range">
                            <div class="min">100 мм</div>
                            <div class="max">900 мм</div>
                        </div>
                        <div class="step">1</div>
                    </div>

                    <div class="block delimiter" data-filter="depth">
                        <div class="rus">Глубина:</div>
                        <div class="fields">
                            <label class="line">
                                <span class="signature">от</span>
                                <input type="text" value="20" class="min">
                            </label>
                            <label class="line">
                                <span class="signature">до</span>
                                <input type="text" value="70" class="max">
                            </label>
                            <div class="ed">мм</div>
                            <div class="clear"></div>
                        </div>
                        <div class="slider"></div>
                        <div class="range">
                            <div class="min">10 мм</div>
                            <div class="max">130 мм</div>
                        </div>
                        <div class="step">1</div>
                    </div>

                    <div class="block last" data-filter="price">
                        <div class="rus">Цена:</div>
                        <div class="fields">
                            <label class="line">
                                <span class="signature">от</span>
                                <input type="text" value="200" class="min">
                            </label>
                            <label class="line">
                                <span class="signature">до</span>
                                <input type="text" value="700" class="max">
                            </label>
                            <div class="ed">руб</div>
                            <div class="clear"></div>
                        </div>
                        <div class="slider"></div>
                        <div class="range">
                            <div class="min">100 руб</div>
                            <div class="max">900 руб</div>
                        </div>
                        <div class="step">1</div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="col-xs-9">
                <div id="products" class="row">
                    @foreach($products as $product)
                        <div class="col-xs-4">
                        <div class="product">
                            <a href="/catalog/product/{{$product->id}}">
                                {!! HTML::image("img/product/medium/".$product->images[0]) !!}
                            </a>
                            <div class="layer">
                                <a href="" class="category">{{$product->category->name}}</a>
                                <div class="title">
                                    <a href="">{{$product->name}}</a>
                                    <div class="price">{{$product->price}}</div>
                                </div>
                                <div class="params">
                                    Ширина: <span>{{$product->width}} мм</span><br>
                                    Высота: <span>{{$product->height}} мм</span><br>
                                    Глубина: <span>{{$product->depth}} мм</span>
                                </div>
                            </div>
                            <div class="toCart">
                                Добавить в корзину
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
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
@endsection