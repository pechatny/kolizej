<p>Доставка:</p>

<table>
    <tr>
        <td>Город:</td>
        <td>{{$city  or 'нет'}}</td>
    </tr>
    <tr>
        <td>Подъём:</td>
        <td>{{$lift or 'нет'}}</td>
    </tr>
    <tr>
        <td>Этаж:</td>
        <td>{{$stage or 'нет'}}</td>
    </tr>
    <tr>
        <td>Расстояние:</td>
        <td>{{$distance or 0}}</td>
    </tr>
</table>

<p>Данные клиента:</p>
<table>
    <tr>
        <td>Фамилия:</td>
        <td>{{$arForm['name']}}</td>
    </tr>
    <tr>
        <td>Имя:</td>
        <td>{{$arForm['lastname']}}</td>
    </tr>
    <tr>
        <td>Телефон:</td>
        <td>{{$arForm['phone']}}</td>
    </tr>
    <tr>
        <td>Адрес доставки:</td>
        <td>{{$arForm['addres']}}</td>
    </tr>
</table>
<h2>Товары</h2>
<table>

<tr>
    <td>Наименование</td>
    {{--<td>{{$item->color->name}}</td>--}}
    <td>Цена</td>
    <td>Количество</td>
</tr>
    @foreach($cart as $cartItem)
    {{--{!!dd($cartItem)!!}--}}
        <tr>
            <td>{{$cartItem['product']->name}}</td>
            {{--<td>{{$item->color->name}}</td>--}}
            <td>{{$cartItem['product']->price}}</td>
            <td>{{$cartItem['quantity']}}</td>
        </tr>
    @endforeach
</table>