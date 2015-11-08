<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
    <h1 style="font-size:150%; margin-bottom:20px;">Оформлен заказ на сайте</h1>

    <h2 style="font-size:125%; margin-bottom:10px;">Доставка</h2>
    <table width="100%" align="center" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse; border:#eeeeee 1px solid;">
        <tr>
            <td style="width:150px; border-collapse:collapse; border:#eeeeee 1px solid;">Город:</td>
            <td style="border-collapse:collapse; border:#eeeeee 1px solid;">{{ $city  or 'Не указан' }}</td>
        </tr>
        <tr>
            <td style="width:150px; border-collapse:collapse; border:#eeeeee 1px solid;">Подъём:</td>
            <td style="border-collapse:collapse; border:#eeeeee 1px solid;">{{ $lift  or 'Не указан' }}</td>
        </tr>
        <tr>
            <td style="width:150px; border-collapse:collapse; border:#eeeeee 1px solid;">Этаж:</td>
            <td style="border-collapse:collapse; border:#eeeeee 1px solid;">{{ $stage  or 'Не указан' }}</td>
        </tr>
        <tr>
            <td style="width:150px; border-collapse:collapse; border:#eeeeee 1px solid;">Расстояние от МКАД:</td>
            <td style="border-collapse:collapse; border:#eeeeee 1px solid;">{{ $distance  or 'Не указан' }}</td>
        </tr>
    </table>

    <h2 style="font-size:125%; margin-bottom:10px;">Данные клиента</h2>
    <table width="100%" align="center" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse; border:#eeeeee 1px solid;">
        <tr>
            <td style="width:150px; border-collapse:collapse; border:#eeeeee 1px solid;">Имя:</td>
            <td style="border-collapse:collapse; border:#eeeeee 1px solid;">{{ $arForm['name'] }}</td>
        </tr>
        <tr>
            <td style="width:150px; border-collapse:collapse; border:#eeeeee 1px solid;">Фамилия:</td>
            <td style="border-collapse:collapse; border:#eeeeee 1px solid;">{{ $arForm['lastname'] }}</td>
        </tr>
        <tr>
            <td style="width:150px; border-collapse:collapse; border:#eeeeee 1px solid;">Телефон:</td>
            <td style="border-collapse:collapse; border:#eeeeee 1px solid;">{{ $arForm['phone'] }}</td>
        </tr>
        <tr>
            <td style="width:150px; border-collapse:collapse; border:#eeeeee 1px solid;">Адрес доставки:</td>
            <td style="border-collapse:collapse; border:#eeeeee 1px solid;">{{ $arForm['addres'] }}</td>
        </tr>
    </table>

    <h2 style="font-size:125%; margin-bottom:10px;">Мебель</h2>
    <table width="100%" align="center" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse; border:#dddddd 1px solid;">
        <tr>
            <td style="border-collapse:collapse; border:#dddddd 1px solid;">Наименование</td>
            <td style="border-collapse:collapse; border:#dddddd 1px solid;">Конфигурация</td>
            <td style="border-collapse:collapse; border:#dddddd 1px solid;">Цвет</td>
            <td style="border-collapse:collapse; border:#dddddd 1px solid;">Цена</td>
            <td style="border-collapse:collapse; border:#dddddd 1px solid;">Количество</td>
        </tr>
        <tr>
            @foreach($cart as $cartItem)
                <td style="border-collapse:collapse; border:#dddddd 1px solid;">{{ $cartItem['product']->name }}</td>
                <td style="border-collapse:collapse; border:#dddddd 1px solid;">
                    @if($item['product']->configuration)
                        @$cartItem['configuration'] == 'left' ? 'Левая' : 'Правая'
                </td>
                <td style="border-collapse:collapse; border:#dddddd 1px solid;">{{ $cartItem['product']->price }}</td>
                <td style="border-collapse:collapse; border:#dddddd 1px solid;">{{ $cartItem['quantity'] }}</td>
            @endforeach
        </tr>
        <tr>
            <td colspan="5"><? print_r($cartItem); ?></td>
        </tr>
    </table>
</body>
</html>
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