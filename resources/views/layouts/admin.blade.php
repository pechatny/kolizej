<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin</title>
        {!! HTML::style('adminStyles/css/main.css') !!}
        {!! HTML::style('adminStyles/css/global.css') !!}
        {!! HTML::style('adminStyles/css/grid.css') !!}
        {!! HTML::style('adminStyles/css/style.css') !!}
        {!! HTML::style('adminStyles/css/addInput.css') !!}
        {!! HTML::style('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css') !!}
        {!! HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js') !!}
        {!! HTML::script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js') !!}
        {!! HTML::script('adminStyles/js/addInput.js') !!}
        <link href="/adminStyles/img/favicon/admin.png" rel="shortcut icon">
    </head>
    <body class="index-page">
        <div class="wrapper">
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-vs-12">
                            <a href="/admin/" class="toAdmin">Консоль</a>
                            <a href="/" class="toSite" target="_blank">На сайт</a>
                            <a href="http://cloudia.innoday.net/phpmyadmin2/" class="toMySQL" target="_blank">MySQL</a>
                            <a href="./" class="exit">Выход</a>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xs-4 col-sm-3 col-lg-2">
                        <div class="menu">
                            @include('admin.leftMenu')
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-9 col-lg-10">
                        <div class="section">

                            @yield('content')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
