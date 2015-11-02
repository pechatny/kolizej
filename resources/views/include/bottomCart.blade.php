<div class="cart col-xs-2">
    @if($count != 0)
        <div class="layer">
            <a href="/cart" class="title">Корзина</a>
            <div class="clear"></div>

            <div class="msg">
                {{$count}} товар
                <b>{{$sum}} руб.</b>
            </div>

            <a href="/cart#ok" class="button cent wide">Оформить заказ</a>
        </div>
    @else
        <div class="layer empty">
            <a href="/cart" class="title">Корзина</a>
            <div class="clear"></div>

            <div class="msg">
                0 товаров
                <b>Выберите товары из каталога</b>
            </div>
            
            <a href="/catalog" class="button cent wide">В каталог</a>
        </div>
    @endif
</div>