@extends('layouts.page')
@section('content')
    <div class="container">
        @if($items)
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

                @foreach($items as $item)
                    <div class="block" data-id="{{$item['product']->id}}">
                        <div class="row">
                            <div class="col Photo">
                                <div class="image">
                                    <a href="/catalog/product/{{$item['product']->id}}">
                                        {!! HTML::image("img/product/cart-w216/".$item['product']->images[0]) !!}
                                    </a>
                                    <a href="/img/product/original/{{$item['product']->images[0]}}" class="view-big"></a>
                                </div>
                            </div>
                            <div class="col Name vertical">
                                <div class="children">
                                    <div class="title">
                                        <a href="/catalog/product/{{$item['product']->id}}">{{$item['product']->name}}</a>
                                        @if($item['product']->configuration)
                                            <div class="config">
                                                Конфигурация:
                                                <span data-val="left"{!! $item['configuration'] == 'left' ? ' class="active"' : '' !!}>левая</span>
                                                <span data-val="right"{!! $item['configuration'] == 'right' ? ' class="active"' : '' !!}>правая</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col Color">
                                <div class="color">
                                    @foreach($item['product']->color as $color)
                                            @if($color->id == $item['color'])
                                                <div class="item active" data-id="{{$color->id}}">
                                            @else
                                                <div class="item" data-id="{{$color->id}}">
                                            @endif
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
                                <span></span>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                @endforeach
                
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
                    <div class="select left" data-target="#mkad">
                        <div class="item selected first">г. Москва</div>
                        <div class="item">г. Зеленоград</div>
                        <div class="item display last">Другой адрес</div>
                        <div class="clear"></div>
                    </div>
                    <div id="mkad" class="none">
                        <span class="label">Расстояние от МКАД:</span>
                        <div class="left">
                            <input type="text" value="10" data-price="100">
                        </div>
                        <span class="ed label">км</span>
                    </div>
                    <div class="clear"></div>

                    <span class="label">Способ подъема на этаж:</span>
                    <div class="select left" data-target="#handup">
                        <div class="item selected first">На лифте</div>
                        <div class="item display last">Вручную</div>
                        <div class="clear"></div>
                    </div>
                    <div id="handup" class="none">
                        <span class="label">Поднять на:</span>
                        <div class="left">
                            <input type="text" value="2">
                        </div>
                        <span class="ed label">этаж</span>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="priceDelivery">
                    <div class="colNames">
                        <div class="row">
                            <div class="col Name"></div>
                            <div class="col">Подъем</div>
                            <div class="col">Сборка</div>
                            <div class="col">Итого</div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    @foreach($items as  $item)
                        <div class="block" data-id="{{$item['product']->id}}" data-lift="{{$item['product']->lift}}" data-lift_hand="{{$item['product']->lift_hand}}" data-assembly="{{$item['product']->assembly}}" data-quantity="{{$item['quantity']}}">
                            <div class="row">
                                <div class="col Name">{{$item['product']->name}}</div>
                                <div class="col Lift">
                                    <span>{{$item['product']->lift * $item['quantity']}}</span>
                                </div>
                                <div class="col Assembly">
                                    <span>{{$item['product']->assembly * $item['quantity']}}</span>
                                </div>
                                <div class="col Total">
                                    <span>{{$item['product']->lift * $item['quantity'] + $item['product']->assembly}}</span>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    @endforeach
                     
                    <div class="block delivery">
                        <div class="row">
                            <div class="col Name">
                                <b>Доставка:</b>
                            </div>
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col Total">
                                <span class="free">Бесплатно</span>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <div class="total">
                        стоимость доставки и сборки:
                        <b>
                            <span class="price">{{$deliverySum}}</span>
                        </b>
                    </div>
                </div>

                <div class="totalPrice">
                    <span>Стоимость заказа</span>
                    <b class="price">{{$totalSum}}</b>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear bigheight"></div>

            <a name="ok"></a>
            <h2>Оформить заказ</h2>
            <div class="cartOrder form col-xs-12 island">
                <form action="#">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="field">
                                <input type="text" placeholder="Имя" name="name">
                                <div class="help"></div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="field">
                                <input type="text" placeholder="Фамилия" name="lastname">
                                <div class="help"></div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="field">
                                <input type="text" placeholder="Телефон" name="phone">
                                <div class="help"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="field">
                                <input type="text" placeholder="Адрес доставки" name="addres">
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
        @else
            <div class="island">
                <p>В вашей корзине 0 товаров</p>
                <p>
                    <span class="left cartListEmpty">Начните делать покупки </span>
                    <a href="/catalog" class="button left">В каталоге</a>
                </p>
                <div class="clear"></div>
            </div>
        @endif
    </div>
@endsection