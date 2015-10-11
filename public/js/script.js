/*$(function () {
	
});*/
ymaps.ready(function () {
    var myMap = new ymaps.Map('map', {
            center: [55.971053, 37.195508],
            zoom: 16
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