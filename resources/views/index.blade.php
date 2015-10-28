@extends('layouts.main')
@section('content')
    <div class="categories wide">
        <div class="container">
            <div class="row">
                @foreach($categories as $category)
                    <div class="block col-xs-4">
                        <a href="/catalog/{{$category->key}}">
                            {!! HTML::image($category->image) !!}
                            <span>{{$category->name}}</span>
                        </a>
                    </div>
                @endforeach
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="aboutCompany container">
        <h1>Мебельное предприятие "Колизей"</h1>
        <p>Мы специализируемся на выпуске <b>корпусной мебели и компьютерных столов</b>. Компания <b>основана в 2003 году</b> (13 лет опыта работы).</p>
        <p>В производстве используются самые качественные импортные и отечественные материалы, не создающие проблем в процессе эксплуатации мебели. </p>
        <p>Компания “Колизей” предлагает <b>одно из лучших соотношений цены и качества</b>, что делает мебель привлекательной для широкого круга покупателей.</p>
        <div class="clear"></div>
    </div>

    <div class="advantages wide">
        <div class="container">
            <div class="row">
                <div class="block col-xs-2">
                    <img src="img/advantage/1.png" alt="">
                    <b>Цены</b> стабильные
                </div>
                <div class="block col-xs-2">
                    <img src="img/advantage/2.png" alt="">
                    <b>Сертифицирована</b> вся продукция
                </div>
                <div class="block col-xs-2">
                    <img src="img/advantage/3.png" alt="">
                    <b>Гарантия</b> на все товары
                </div>
                <div class="block col-xs-2">
                    <img src="img/advantage/4.png" alt="">
                    <b>Условия оплаты</b> гибкие
                </div>
                <div class="block col-xs-2">
                    <img src="img/advantage/5.png" alt="">
                    <b>Упаковка</b> надежная
                </div>
                <div class="block col-xs-2">
                    <img src="img/advantage/6.png" alt="">
                    <b>Доставка</b> по Москве и Московской области
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="catalog container">
        <h2>Популярные</h2>
        <div class="row">
            @include('include.productsList')
            <div class="clear"></div>
        </div>
    </div>

    <div class="features wide">
        <div class="container">
            <h2>Особенности производства</h2>
            <div class="row">
                <div class="col-xs-6">
                    <div class="block">
                        <div class="image">
                            <img src="img/feature/pvh.jpg" alt="">
                        </div>
					<span>
						<b>Кромка пвх</b>
						Практически все изделия серии “Колизей” обрабатываются кромкой ПВХ/ABS толщиной 2 мм, которая выдерживает повышенные нагрузки и в отличее от П-образного каната более практична
					</span>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="block">
                        <div class="image">
                            <img src="img/feature/mdf.jpg" alt="">
                        </div>
					<span>
						<b>Материал МДФ</b>
						Во многих изделиях серии “Колизей” используется материал МДФ, который отличается от ЛДСП повышенной прочностью и эластичностью, а пленки ПВХ, которыми он покрывается, придают мебели очень эстетичный вид
					</span>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="sertificates container">
        <h2>Наши сертификаты</h2>
        <div class="row">
            <div class="fake left"></div>
            <div class="block">
                <a href="/img/sertificate/1.jpg" target="_blank">
                    <img src="/img/sertificate/preview/1.jpg" alt="">
                </a>
            </div>
            <div class="block">
                <a href="/img/sertificate/2.jpg" target="_blank">
                    <img src="/img/sertificate/preview/2.jpg" alt="">
                </a>
            </div>
            <div class="block">
                <a href="/img/sertificate/3.jpg" target="_blank">
                    <img src="/img/sertificate/preview/3.jpg" alt="">
                </a>
            </div>
            <div class="block">
                <a href="/img/sertificate/4.jpg" target="_blank">
                    <img src="/img/sertificate/preview/4.jpg" alt="">
                </a>
            </div>
            <div class="block">
                <a href="/img/sertificate/5.jpg" target="_blank">
                    <img src="/img/sertificate/preview/5.jpg" alt="">
                </a>
            </div>
            <div class="block">
                <a href="/img/sertificate/6.jpg" target="_blank">
                    <img src="/img/sertificate/preview/6.jpg" alt="">
                </a>
            </div>
            <div class="block">
                <a href="/img/sertificate/7.jpg" target="_blank">
                    <img src="/img/sertificate/preview/7.jpg" alt="">
                </a>
            </div>
            <div class="fake left"></div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="contact">
        <div id="map"></div>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-8"></div>
                    <div class="col-xs-4">
                        <div class="block">
                            <h2>Контактная информация</h2>
                            <div class="item location">
                                г. Москва, Зеленоград,<br>
                                <b>ул. Заводская 21а</b>
                            </div>
                            <div class="item phone">
                                <a href="tel:+74959797858">+7 (495) 979-78-58</a>
                            </div>
                            <div class="item mobile">
                                <a href="tel:+79161234455">+7 (916) 123-44-55</a>
                            </div>
                            <div class="item time">
                                Время работы<br>
                                <b>9:00 - 22:00</b>
                            </div>
                            <div class="item mail">
                                Электронная почта<br>
                                <a href="mailto:mail@kolizej.ru">mail@kolizej.ru</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection