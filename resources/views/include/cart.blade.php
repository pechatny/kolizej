<div class="cart col-xs-3">
    @if($count != 0)
        <div class="layer">
            <a href="/cart" class="title">Корзина</a>
            <div class="clear"></div>

            {{$count}} товара
            <b>{{$sum}} руб.</b>

            <a href="/cart" class="button cent wide">Оформить заказ</a>
        </div>
    @else
        <div class="layer empty">
            <a href="/cart" class="title">Корзина</a>
            <div class="clear"></div>
            0 товаров
            <b>Выберите товары из каталога</b>
            <a href="/catalog" class="button cent wide">В каталог</a>
        </div>
    @endif
</div>
