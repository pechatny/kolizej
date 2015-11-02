<header class="wide">
    <div class="container">
        <div class="row">
            <div class="logo col-xs-5">
                <a href="/" class="img left">
                    <img src="/img/logo.png" alt="" class="left">
                </a>
                <a href="/" class="text left">
                    <b>К<span>о</span>лизей</b>
                    <span>мебельное</span>
                    производство
                </a>
            </div>
            <div class="col-xs-4">
                <div class="phone">
                    <span class="right">9:00 - 22:00</span>
                    <a href="tel:+74959797858" class="right">+7 (495) 979-78-58</a>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <form action="/search" class="search">
                    <input name="val" type="text" placeholder="Поиск . . ." class="right">
                    <input type="submit" value="">
                    <div class="clear"></div>
                </form>
            </div>
            @include('include.cart')
            <div class="clear"></div>
        </div>

        {!! $menuHtml !!}
    </div>
</header>

