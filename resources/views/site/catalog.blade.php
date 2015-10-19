@extends('layouts.catalog')
@section('content')
    <div class="container">
        <div class="row">
            <?
            if(!isset($_GET['id'])) {
            ?>
            <div class="menu col-xs-3">
                <div class="island category">
                    <div class="title">Категории мебели</div>
                    <ul>
                        <li><a href="">Кухня</a></li>
                        <li><a href="">Компьютерные столы</a></li>
                        <li><a href="">Письменные столы</a></li>
                        <li><a href="">Комоды / Тумбы</a></li>
                        <li><a href="">Столы-трансформеры</a></li>
                        <li><a href="">Стенки</a></li>
                        <li><a href="">Стеллажи офисные</a></li>
                        <li><a href="">Прихожие</a></li>
                        <li><a href="">Шкаф-купе</a></li>
                    </ul>
                </div>
                <div class="filter island">
                    <div class="title">Параметры</div>

                    <div class="block">
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

                    <div class="block">
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

                    <div class="block delimiter">
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

                    <div class="block last">
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
                <div class="row">
                    <div class="col-xs-4">
                        <div class="product">
                            <a href="/catalog/1">
                                <img src="/img/product/2.jpg" alt="">
                            </a>
                            <div class="layer">
                                <a href="" class="category">Компьютерные столы</a>
                                <div class="title">
                                    <a href="">CK-35</a>
                                    <div class="price">35 000</div>
                                </div>
                                <div class="params">
                                    Ширина: <span>100 мм</span><br>
                                    Высота: <span>100 мм</span><br>
                                    Глубина: <span>100 мм</span>
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
                    <div class="col-xs-4">
                        <div class="product">
                            <a href="/catalog/1">
                                <img src="/img/product/3.jpg" alt="">
                            </a>
                            <div class="layer">
                                <a href="" class="category">Компьютерные столы</a>
                                <div class="title">
                                    <a href="">CK-35</a>
                                    <div class="price">35 000</div>
                                </div>
                                <div class="params">
                                    Ширина: <span>100 мм</span><br>
                                    Высота: <span>100 мм</span><br>
                                    Глубина: <span>100 мм</span>
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
                    <div class="col-xs-4">
                        <div class="product">
                            <a href="/catalog/1">
                                <img src="/img/product/4.jpg" alt="">
                            </a>
                            <div class="layer">
                                <a href="" class="category">Компьютерные столы</a>
                                <div class="title">
                                    <a href="">CK-35</a>
                                    <div class="price">35 000</div>
                                </div>
                                <div class="params">
                                    Ширина: <span>100 мм</span><br>
                                    Высота: <span>100 мм</span><br>
                                    Глубина: <span>100 мм</span>
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
                    <div class="clear"></div>
                </div><div class="row">
                    <div class="col-xs-4">
                        <div class="product">
                            <a href="/catalog/1">
                                <img src="/img/product/2.jpg" alt="">
                            </a>
                            <div class="layer">
                                <a href="" class="category">Компьютерные столы</a>
                                <div class="title">
                                    <a href="">CK-35</a>
                                    <div class="price">35 000</div>
                                </div>
                                <div class="params">
                                    Ширина: <span>100 мм</span><br>
                                    Высота: <span>100 мм</span><br>
                                    Глубина: <span>100 мм</span>
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
                    <div class="col-xs-4">
                        <div class="product">
                            <a href="/catalog/1">
                                <img src="/img/product/3.jpg" alt="">
                            </a>
                            <div class="layer">
                                <a href="" class="category">Компьютерные столы</a>
                                <div class="title">
                                    <a href="">CK-35</a>
                                    <div class="price">35 000</div>
                                </div>
                                <div class="params">
                                    Ширина: <span>100 мм</span><br>
                                    Высота: <span>100 мм</span><br>
                                    Глубина: <span>100 мм</span>
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
                    <div class="col-xs-4">
                        <div class="product">
                            <a href="/catalog/1">
                                <img src="/img/product/4.jpg" alt="">
                            </a>
                            <div class="layer">
                                <a href="" class="category">Компьютерные столы</a>
                                <div class="title">
                                    <a href="">CK-35</a>
                                    <div class="price">35 000</div>
                                </div>
                                <div class="params">
                                    Ширина: <span>100 мм</span><br>
                                    Высота: <span>100 мм</span><br>
                                    Глубина: <span>100 мм</span>
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
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
            <?
            }
            else {
            ?>
            <div class="col-xs-6">
                <div class="productView island">
                    <div class="big">
                        <img src="/img/product/1/1.jpg" alt="">
                        <a href="/img/product/1/1.jpg"></a>
                    </div>
                    <div class="preview">
                        <div class="overlay">
                            <div class="move">
                                <div class="row">
                                    <div class="block active">
                                        <img src="/img/product/1/preview/1.jpg" alt="">
                                    </div>
                                    <div class="block">
                                        <img src="/img/product/1/preview/2.jpg" alt="">
                                    </div>
                                    <div class="block">
                                        <img src="/img/product/1/preview/3.jpg" alt="">
                                    </div>
                                    <div class="block">
                                        <img src="/img/product/1/preview/4.jpg" alt="">
                                    </div>
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
                        <p>Фабрика мебели Колизей предлагает Вашему вниманию стол компьютерный СК-45 — несмотря на свои небольшие размеры, компьютерный стол очень функционален.</p>
                        <p>Два вместительных ящика позволяют без проблем хранить любые канцелярские принадлежности. Размеры под монитор: ширина 465 мм, высота 590 мм. Стол выполнен из ЛДСП, обработан кромкой ПВХ, фасады ящиков — МДФ.</p>
                    </div>

                    <div class="row">
                        <div class="params column">
                            <b class="title">Параметры:</b>
                            Ширина: <span class="value">100 мм</span><br>
                            Высота: <span class="value">100 мм</span><br>
                            Глубина: <span class="value">100 мм</span><br>
                            Гарантия: <span class="value">24 мес</span><br>
                            Вес: <span class="value">10 кг</span>
                        </div>

                        <div class="color column">
                            <b class="title">Выбор цвета:</b>
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

                        <div class="column forCart">
                            <div class="price right">35 000</div>
                            <div class="clear"></div>

                            <div class="toCart right">
                                Добавить в корзину
                                <div class="counter">
                                    <input type="text" value="1">
                                    <div class="manage">
                                        <span class="plus"></span>
                                        <span class="minus"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>

                            <div class="articul">
                                Артикул:
                                <span class="value">123000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bigheight clear"></div>


            <h2>Смотрите так же</h2>
            <div class="col-xs-3">
                <div class="product">
                    <a href="/catalog/1">
                        <img src="/img/product/1.jpg" alt="">
                    </a>
                    <div class="layer">
                        <a href="" class="category">Компьютерные столы</a>
                        <div class="title">
                            <a href="">CK-35</a>
                            <div class="price">35 000</div>
                        </div>
                        <div class="params">
                            Ширина: <span>100 мм</span><br>
                            Высота: <span>100 мм</span><br>
                            Глубина: <span>100 мм</span>
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
            <div class="col-xs-3">
                <div class="product">
                    <a href="/catalog/1">
                        <img src="/img/product/1.jpg" alt="">
                    </a>
                    <div class="layer">
                        <a href="" class="category">Компьютерные столы</a>
                        <div class="title">
                            <a href="">CK-35</a>
                            <div class="price">35 000</div>
                        </div>
                        <div class="params">
                            Ширина: <span>100 мм</span><br>
                            Высота: <span>100 мм</span><br>
                            Глубина: <span>100 мм</span>
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
            <div class="col-xs-3">
                <div class="product">
                    <a href="/catalog/1">
                        <img src="/img/product/1.jpg" alt="">
                    </a>
                    <div class="layer">
                        <a href="" class="category">Компьютерные столы</a>
                        <div class="title">
                            <a href="">CK-35</a>
                            <div class="price">35 000</div>
                        </div>
                        <div class="params">
                            Ширина: <span>100 мм</span><br>
                            Высота: <span>100 мм</span><br>
                            Глубина: <span>100 мм</span>
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
            <div class="col-xs-3">
                <div class="product">
                    <a href="/catalog/1">
                        <img src="/img/product/1.jpg" alt="">
                    </a>
                    <div class="layer">
                        <a href="" class="category">Компьютерные столы</a>
                        <div class="title">
                            <a href="">CK-35</a>
                            <div class="price">35 000</div>
                        </div>
                        <div class="params">
                            Ширина: <span>100 мм</span><br>
                            Высота: <span>100 мм</span><br>
                            Глубина: <span>100 мм</span>
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
            <div class="clear"></div>

            <?
            }
            ?>
        </div>
    </div>
@endsection