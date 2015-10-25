@foreach($products as $product)
    @if($product->category)
        <div class="col-xs-4">
            <div class="product">
                <a href="/catalog/product/{{$product->id}}">
                    {!! HTML::image("img/product/medium/".$product->images[0]) !!}
                </a>
                <div class="layer">
                    <a href="" class="category">{{$product->category->name}}</a>
                    <div class="title">
                        <a href="">{{$product->name}}</a>
                        <div class="price">{{$product->price}}</div>
                    </div>
                    <div class="params">
                        Ширина: <span>{{$product->width}} мм</span><br>
                        Высота: <span>{{$product->height}} мм</span><br>
                        Глубина: <span>{{$product->depth}} мм</span>
                    </div>
                </div>
                <div class="toCart" data-id="{{$product->id}}">
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
    @endif
@endforeach