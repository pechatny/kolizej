@extends('layouts.catalog')
@section('content')
    <div class="container">
        <div class="row">
            <div class="menu col-xs-3">
                <div class="island category">
                    <div class="title">Категории мебели</div>
                    <ul>
                        @foreach($categories as $category)
                            <li><a href="{{$category->key}}" data="{{$category->id}}">{{$category->name}}</a></li>
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
                                <input type="text" value="{{$params['min']['width']}}" class="min">
                            </label>
                            <label class="line">
                                <span class="signature">до</span>
                                <input type="text" value="{{$params['max']['width']}}" class="max">
                            </label>
                            <div class="ed">мм</div>
                            <div class="clear"></div>
                        </div>
                        <div class="slider"></div>
                        <div class="range">
                            <div class="min">{{$params['min']['width']}} мм</div>
                            <div class="max">{{$params['max']['width']}} мм</div>
                        </div>
                        <div class="step">1</div>
                    </div>

                    <div class="block" data-filter="height">
                        <div class="rus">Высота:</div>
                        <div class="fields">
                            <label class="line">
                                <span class="signature">от</span>
                                <input type="text" value="{{$params['min']['height']}}" class="min">
                            </label>
                            <label class="line">
                                <span class="signature">до</span>
                                <input type="text" value="{{$params['max']['height']}}" class="max">
                            </label>
                            <div class="ed">мм</div>
                            <div class="clear"></div>
                        </div>
                        <div class="slider"></div>
                        <div class="range">
                            <div class="min">{{$params['min']['height']}} мм</div>
                            <div class="max">{{$params['max']['height']}} мм</div>
                        </div>
                        <div class="step">1</div>
                    </div>

                    <div class="block delimiter" data-filter="depth">
                        <div class="rus">Глубина:</div>
                        <div class="fields">
                            <label class="line">
                                <span class="signature">от</span>
                                <input type="text" value="{{$params['min']['depth']}}" class="min">
                            </label>
                            <label class="line">
                                <span class="signature">до</span>
                                <input type="text" value="{{$params['max']['depth']}}" class="max">
                            </label>
                            <div class="ed">мм</div>
                            <div class="clear"></div>
                        </div>
                        <div class="slider"></div>
                        <div class="range">
                            <div class="min">{{$params['min']['depth']}} мм</div>
                            <div class="max">{{$params['max']['depth']}} мм</div>
                        </div>
                        <div class="step">1</div>
                    </div>

                    <div class="block last" data-filter="price">
                        <div class="rus">Цена:</div>
                        <div class="fields">
                            <label class="line">
                                <span class="signature">от</span>
                                <input type="text" value="{{$params['min']['price']}}" class="min">
                            </label>
                            <label class="line">
                                <span class="signature">до</span>
                                <input type="text" value="{{$params['max']['price']}}" class="max">
                            </label>
                            <div class="ed">руб</div>
                            <div class="clear"></div>
                        </div>
                        <div class="slider"></div>
                        <div class="range">
                            <div class="min">{{$params['min']['price']}} руб</div>
                            <div class="max">{{$params['max']['price']}} руб</div>
                        </div>
                        <div class="step">1</div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="col-xs-9">
                <div id="products" class="row">
                    @include('include.productsList')
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
@endsection