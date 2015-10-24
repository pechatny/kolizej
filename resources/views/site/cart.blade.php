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

            <div class="block">
                <div class="row">
                    <div class="col Photo">
                        <div class="image">
                            <a href="/catalog/1">
                                <img src="/img/product/1/cart.jpg" alt="">
                            </a>
                            <a href="/img/product/1/1.jpg" class="view-big"></a>
                        </div>
                    </div>
                    <div class="col Name vertical">
                        <div class="children">
                            <a href="/catalog/1" target="_blank">Письменный стол СТ-35</a>
                        </div>
                    </div>
                    <div class="col Color">
                        <div class="color">
                            <div class="choose">
                                <div class="item active">
                                    <a href="/img/color/1.jpg" class="preview" title="Орех итальянский">
                                        <img src="/img/color/preview/1.jpg" alt="">
                                    </a>
                                    <span>Орех итальянский</span>
                                </div>
                                <div class="item">
                                    <a href="/img/color/2.jpg" class="preview" title="Яблоня локарно">
                                        <img src="/img/color/preview/2.jpg" alt="">
                                    </a>
                                    <span>Яблоня локарно</span>
                                </div>
                                <div class="item">
                                    <a href="/img/color/3.jpg" class="preview" title="Ольха">
                                        <img src="/img/color/preview/3.jpg" alt="">
                                    </a>
                                    <span>Ольха</span>
                                </div>
                                <div class="item">
                                    <a href="/img/color/4.jpg" class="preview" title="Дуб беленый">
                                        <img src="/img/color/preview/4.jpg" alt="">
                                    </a>
                                    <span>Дуб беленый</span>
                                </div>
                                <div class="item">
                                    <a href="/img/color/5.jpg" class="preview" title="Венге">
                                        <img src="/img/color/preview/5.jpg" alt="">
                                    </a>
                                    <span>Венге</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col Price vertical">
                        <div class="children">
                            <div class="price">35 000</div>
                        </div>
                    </div>
                    <div class="col Count toCart vertical">
                        <div class="counter">
                            <input type="text" value="1">
                            <div class="manage">
                                <span class="plus"></span>
                                <span class="minus"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col TotalPrice vertical">
                        <div class="children">
                            <div class="price">35 000</div>
                        </div>
                    </div>
                    <div class="col delete vertical">
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="block">
                <div class="row">
                    <div class="col Photo">
                        <div class="image">
                            <a href="/catalog/1">
                                <img src="/img/product/1/cart.jpg" alt="">
                            </a>
                            <a href="/img/product/1/1.jpg" class="view-big"></a>
                        </div>
                    </div>
                    <div class="col Name vertical">
                        <div class="children">
                            <a href="/catalog/1" target="_blank">Письменный стол СТ-35</a>
                        </div>
                    </div>
                    <div class="col Color">
                        <div class="color">
                            <div class="choose">
                                <div class="item active">
                                    <a href="/img/color/1.jpg" class="preview" title="Орех итальянский">
                                        <img src="/img/color/preview/1.jpg" alt="">
                                    </a>
                                    <span>Орех итальянский</span>
                                </div>
                                <div class="item">
                                    <a href="/img/color/2.jpg" class="preview" title="Яблоня локарно">
                                        <img src="/img/color/preview/2.jpg" alt="">
                                    </a>
                                    <span>Яблоня локарно</span>
                                </div>
                                <div class="item">
                                    <a href="/img/color/3.jpg" class="preview" title="Ольха">
                                        <img src="/img/color/preview/3.jpg" alt="">
                                    </a>
                                    <span>Ольха</span>
                                </div>
                                <div class="item">
                                    <a href="/img/color/4.jpg" class="preview" title="Дуб беленый">
                                        <img src="/img/color/preview/4.jpg" alt="">
                                    </a>
                                    <span>Дуб беленый</span>
                                </div>
                                <div class="item">
                                    <a href="/img/color/5.jpg" class="preview" title="Венге">
                                        <img src="/img/color/preview/5.jpg" alt="">
                                    </a>
                                    <span>Венге</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col Price vertical">
                        <div class="children">
                            <div class="price">35 000</div>
                        </div>
                    </div>
                    <div class="col Count toCart vertical">
                        <div class="counter">
                            <input type="text" value="1">
                            <div class="manage">
                                <span class="plus"></span>
                                <span class="minus"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col TotalPrice vertical">
                        <div class="children">
                            <div class="price">35 000</div>
                        </div>
                    </div>
                    <div class="col delete vertical">
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="total">
                итого:
                <b>105 000</b>
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