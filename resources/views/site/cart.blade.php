@extends('layouts.page')
@section('content')
    <div class="container">
        <div class="cartList island">
            <div class="colNames">
                <div class="row">
                    <div class="col Photo"></div>
                    <div class="col Name"></div>
                    <div class="col Color">Цвет</div>
                    <div class="col Price">Цена</div>
                    <div class="col Count">Количество</div>
                    <div class="col TotalPrice">Стоимость</div>
                    <div class="col delete"></div>
                    <div class="clear"></div>
                </div>
            </div>

            @if($items)
            @foreach($items as $item)
                            <div class="block">
                                <div class="row">
                                    <div class="col Photo">
                                        <div class="image">
                                            <a href="/img/product/big/{{$item['product']->images[0]}}">
                                                {!! HTML::image("img/product/medium/".$item['product']->images[0]) !!}
                                            </a>
                                            <a href="/img/product/big/{{$item['product']->images[0]}}" class="view-big"></a>
                                        </div>
                                    </div>
                                    <div class="col Name vertical">
                                        <div class="children">
                                            <a href="/catalog/product/{{$item['product']->id}}" target="_blank">{{$item['product']->name}}</a>
                                        </div>
                                    </div>
                                    <div class="col Color">
                                        <div class="color">
                                            <div class="choose">
                                                @foreach($item['product']->color as $color)
                                                     <div class="item">
                                                         <a href="/{{$color->image}}" class="preview" title="{{$color->name}}">
                                                             {!! HTML::image($color->image, '', array('height' => '31')) !!}
                                                         </a>
                                                         <div class="label">
                                                             <span>{{$color->name}}</span>
                                                         </div>
                                                     </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col Price vertical">
                                        <div class="children">
                                            <div class="price">{{$item['product']->price}}</div>
                                        </div>
                                    </div>
                                    <div class="col Count toCart vertical">
                                        <div class="counter">
                                            <input type="text" value="{{$item['quantity']}}">
                                            <div class="manage">
                                                <span class="plus"></span>
                                                <span class="minus"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col TotalPrice vertical">
                                        <div class="children">
                                            <div class="price">{{$item['product']->price * $item['quantity']}}</div>
                                        </div>
                                    </div>
                                    <div class="col delete vertical">
                                        <span data-id="{{$item['product']->id}}"></span>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        @endforeach
            @endif
            <div class="total">
                стоимость мебели:
                <b>{{$count}}</b>
            </div>
        </div>
        <div class="bigheight"></div>

        <h2>Расчет доставки и сборки</h2>
        <div class="calcDelivery col-xs-12 island">
            <div class="enterData">
                <span class="label">Куда доставить:</span>
                <div class="select left" data-target="mkad">
                    <div class="item first">г. Москва</div>
                    <div class="item">г. Зеленоград</div>
                    <div class="item selected true last">Другой адрес</div>
                    <div class="clear"></div>
                </div>
                <div class="mkad">
                    <span class="label">Расстояние от МКАД:</span>
                    <div class="left">
                        <input type="text" value="10">
                    </div>
                    <span class="ed label">км</span>
                </div>
                <div class="clear"></div>

                <span class="label">Способ подъема на этаж:</span>
                <div class="select left" data-target="handup">
                    <div class="item first">На лифте</div>
                    <div class="item selected true last">Вручную</div>
                    <div class="clear"></div>
                </div>
                <div class="handup">
                    <span class="label">Поднять на:</span>
                    <div class="left">
                        <input type="text" value="10">
                    </div>
                    <span class="ed label">этаж</span>
                </div>
                <div class="clear"></div>
            </div>

            <div class="priceDelivery">
                <div class="colNames">
                    <div class="row">
                        <div class="col Name"></div>
                        <div class="col">Доставка</div>
                        <div class="col">Подъем</div>
                        <div class="col">Сборка</div>
                        <div class="col">Итого</div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="block">
                    <div class="row">
                        <div class="col Name">Письменный стол СТ-35</div>
                        <div class="col">
                            <span>1 000</span>
                        </div>
                        <div class="col">
                            <span>2 000</span>
                        </div>
                        <div class="col">
                            <span>3 000</span>
                        </div>
                        <div class="col">
                            <span>6 000</span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="block">
                    <div class="row">
                        <div class="col Name">Письменный стол СТ-35</div>
                        <div class="col">
                            <span>1 500</span>
                        </div>
                        <div class="col">
                            <span>2 000</span>
                        </div>
                        <div class="col">
                            <span>2 500</span>
                        </div>
                        <div class="col">
                            <span>6 000</span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>

                <div class="total">
                    стоимость доставки и сборки:
                    <b>
                        <span>12 000</span>
                    </b>
                </div>
            </div>

            <div class="totalPrice">
                <span>Стоимость заказа</span>
                <b>117 000</b>
                <div class="clear"></div>
            </div>
        </div>

        <a name="ok"></a>
        <h2>Оформить заказ</h2>
        <div class="cartOrder form col-xs-12 island">
            <form action="#">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="field">
                            <input type="text" placeholder="Имя">
                            <div class="help"></div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="field">
                            <input type="text" placeholder="Фамилия">
                            <div class="help"></div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="field">
                            <input type="text" placeholder="Телефон">
                            <div class="help"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="field">
                            <input type="text" placeholder="Адрес доставки">
                            <div class="help"></div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="field">
                            <input type="submit" value="Оформить заказ">
                            <div class="help"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </form>
        </div>
        <div class="clear"></div>
    </div>
@endsection