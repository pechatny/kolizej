@foreach($products as $product)
    @if($product && $product->category)
        @if(isset($indexFlag))
            <div class="col-xs-3">
        @else
            <div class="col-xs-4">
        @endif

            <div class="product">
                <a href="/catalog/product/{{$product->id}}" class="image">
                    <img src="img/product/product_card-w268/{{$product->images[0]}}" alt="">
                </a>
                <div class="layer">
                    <a href="/catalog/{{$product->category->key}}" class="category">{{$product->category->name}}</a>
                    <div class="title">
                        <a href="/catalog/product/{{$product->id}}"><span>{{$product->name}}</span></a>
                        <div class="price">{{$product->price}}</div>
                    </div>
                    <div class="params">
                        Ширина: <span>{{$product->width}} мм</span><br>
                        Высота: <span>{{$product->height}} мм</span><br>
                        Глубина: <span>{{$product->depth}} мм</span>
                    </div>
                </div>
                <div class="toCart" data-id="{{$product->id}}">
                    <span class="add">Добавить в корзину</span>
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
    @endif
@endforeach