<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
    <meta name="description" content="Главная">
    <meta name="keywords" content="Главная">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css">
    <link href="/css/reset.css" rel="stylesheet" type="text/css">
    <link href="/css/grid.css" rel="stylesheet" type="text/css">
    <link href="/css/magnific-popup.css" rel="stylesheet" type="text/css">
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
    <script type="text/javascript" src="/js/map.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script type="text/javascript" src="/js/magnific-popup.min.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
</head>
<body class="index-page">
@include('include.header')
<section>

@yield('content')

</section>
<footer>
    <div class="container">
        <div class="row">
            <div class="folder col-xs-2">
                <div class="title">Информация</div>
                <div class="block">
                    <a href="">Главная</a>
                    <a href="">Контакты</a>
                    <a href="">Доставка и оплата</a>
                    <a href="">Оптовикам</a>
                    <a href="">Мебель на заказ</a>
                </div>
            </div>
            <div class="folder col-xs-4">
                <div class="title">Каталог</div>
                <div class="block w50">
                    <a href="">Кухня</a>
                    <a href="">Компьютерные столы</a>
                    <a href="">Письменные столы</a>
                    <a href="">Комоды / Тумбы</a>
                    <a href="">Столы-трансформеры</a>
                </div>
                <div class="block w50">
                    <a href="">Стенки</a>
                    <a href="">Стеллажи офисные</a>
                    <a href="">Прихожие</a>
                    <a href="">Шкаф-купе</a>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="phone">
                    <span class="right">9:00 - 22:00</span>
                    <div class="clear"></div>
                    <a href="tel:+74959797858" class="right">+7 (495) 979-78-58</a>
                    <div class="clear"></div>
                </div>
                <div class="mobile">
                    <a href="tel:+79161234455" class="right">+7 (916) 123-44-55</a>
                    <div class="clear"></div>
                </div>
                <form action="#" class="search">
                    <input type="text" placeholder="Поиск . . ." class="right">
                    <input type="submit" value="">
                    <div class="clear"></div>
                </form>
            </div>
            @include('include.bottomCart')
            <div class="clear"></div>
        </div>

        <div class="copyright">
            © Разработка <a href="http://efremovm.ru/" target="_blank">M.Efremov</a> <?= date('Y') > 2015 ? ('2015 - ' . date('Y') . 'гг.') : '2015г.'; ?>
        </div>
    </div>
</footer>
</body>
</html>
