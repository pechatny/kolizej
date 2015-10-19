ymaps.ready(function () {
    var loc, 
        z;
    if($('body').hasClass('index-page')) {
        loc = [55.971053, 37.195508];
        z = 16;
    }
    else {
        loc = [55.971600, 37.194008];
        z = 15;
    }
    var myMap = new ymaps.Map('map', {
            center: loc,
            zoom: z
        }, {
            searchControlProvider: 'yandex#search'
        }),
        myPlacemark = new ymaps.Placemark([55.971053, 37.194008], {
            hintContent: 'Мебельное предприятие “Колизей”',
            balloonContent: 'Мебельное предприятие <b>Колизей</b><br>г. Москва, <b>Зеленоград, ул. Заводская 21а</b>'
        }, {
            iconLayout: 'default#image',
            iconImageHref: 'img/ico/contact/baloon.png',
            iconImageSize: [53, 79],
            // Смещение левого верхнего угла иконки относительно
            // её "ножки" (точки привязки).
            iconImageOffset: [-26, -79]
        });

    myMap.geoObjects.add(myPlacemark);
});