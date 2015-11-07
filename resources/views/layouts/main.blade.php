<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$page->title}}</title>
    <meta name="description" content="{{$page->description}}">
    <meta name="keywords" content="{{$page->keywords}}">
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
        <div id="products"class="row">
            {!! $menuBottomHtml !!}
            <div class="folder col-xs-4">
                <div class="title">Каталог</div>
                <div class="block w50">
                     <?
                    for($i = 0, $to = count($categories), $half = ceil($to / 2) - 1; $i < $to; $i++) {
                        echo '<a href="/catalog/', $categories[$i]->key ,'">', $categories[$i]->name ,'</a>';
                        if($i == $half)
                            echo '</div><div class="block w50">';
                    }
                    ?>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="phone">
                    <span class="right">c 9:00 до 17:00</span>
                    <div class="clear"></div>
                    <a href="tel:+74959797858" class="right">+7 (495) 979-78-58</a>
                    <div class="clear"></div>
                </div>
                <div class="mobile">
                    <a href="tel:+79165578363" class="right">+7 (916) 557-83-63</a>
                    <div class="clear"></div>
                </div>
                <form action="/search" class="search">
                    <input type="text" placeholder="Поиск . . ." class="right" value="{{$search or ''}}">
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

