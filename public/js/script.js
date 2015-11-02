$(function () {
	function debug (string) {
		if(!$('.debug').length) {
			$('body').append('<div class="debug" style="position:fixed; z-index:10000; top:15px; left:0; padding:7px 10px; border-radius:0 5px 5px 0; border:1px solid #c00; display:block; background:#eee; color:#333; font-family:Courier new"></div>');
		}
		$('.debug').html(string);
	}
	// -- delete

	function priceFormat (a) {
		return String(a).replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1 ")
	}
	function openPopup (text, title) {
		$.magnificPopup.open({
			items: {
				src: '<div class="popup">\
					'+ (title != undefined ? '<div class="popupTitle">'+ title +'</div>' : '') +'\
					'+ text +'\
				</div>',
				type: 'inline'
			}
		});
	}
	function genDec (n) {
		var cases = [ '', 'а', 'ов' ],
		n = n % 100;
		n1 = n % 10;
		if (n > 10 && n < 20) 
			return cases[2];
		if (n1 > 1 && n1 < 5) 
			return cases[1];
		if (n1 == 1) 
			return cases[0];
		return cases[2];
	}
	function cartDeclension () {
		if(!$('.cart .layer').hasClass('empty')) {
			var html = $('.cart .msg').html(),
				count = Number(html.replace(/^[\s]*([0-9+]) товар[\s]+.*/g, '$1')),
				cases = [ '', 'а', 'ов' ];
			c100 = count % 100;
			c10 = count % 10;
			$('.cart .msg').html(html.replace('товар', 'товар'+ genDec(count)));
		}
	}
	cartDeclension();

	$('.price').each(function () {
		$(this).html(priceFormat($(this).html()));
	});
	if(!$('.cart .layer').hasClass('empty')) {
		$('.cart .msg b').html(priceFormat($('.cart .msg b').html()));
	}

	// Свои селекты
	$('.select .item').click(function () {
		if(!$(this).hasClass('selected')) {
			$(this).parent().children('.item').removeClass('selected');
			$(this).addClass('selected');
			var target = $(this).parent().attr('data-target'),
				sp = 300;
			if(target != undefined) {
				if($(this).hasClass('display')) {
					$(target).fadeIn(sp);
				}
				else {
					$(target).fadeOut(sp / 2);
				}
			}
		}
	});

	// Фильтр в каталоге
	if($('.filter').length > 0) {
		function filter () {
			var category = $('.menu .category .active a').attr('data'),
				params = {};
			if(category == undefined)
				category = 'all';
			$('.filter .block').each(function () {
				params[$(this).attr('data-filter')] = $(this).find('input.min').val() +' '+ $(this).find('input.max').val();
			});
			$.post('/catalogUpdate', {
				params   : params,
				category : category
			}, function(data) {
				$('#products').html(data);
				$('.price').each(function () {
					$(this).html(priceFormat($(this).html()));
				});
			});
		}
		var slider = Array(),
			i = 0,
			data = Array();
		$('.filter .block').each(function () {
			data = [
				Number($(this).find('input.min').val()), // нижняя граница
				Number($(this).find('input.max').val()), // верхняя граница
				Number($(this).find('div.min').html().replace(/[^0-9]/g,'')), // минимально возможное
				Number($(this).find('div.max').html().replace(/[^0-9]/g,'')), // максимально возможное
				Number($(this).find('div.step').html()) // шаг слайдера
			];
			slider[i] = $(this).children('.slider').slider({
				range: true,
				values: [ data[0], data[1]],
				min: data[2],
				max: data[3],
				step: data[4],
				stop: function(event, ui) {
					$(this).parent().find('input.min').val($(this).slider('values', 0));
					$(this).parent().find('input.max').val($(this).slider('values', 1));
					filter();
				},
				slide: function(event, ui) {
					$(this).parent().find('input.min').val($(this).slider('values', 0));
					$(this).parent().find('input.max').val($(this).slider('values', 1));
				}
			});
			i++;
		});

		$('.filter input.min').keyup(function () {
			var block = $(this).parent().parent().parent(),
				i = block.index() - 1;
			if($(this).val() <= slider[i].slider('values', 1)) {
				slider[i].slider('values', 0, $(this).val());
			}
			else {
				$(this).val(slider[i].slider('values', 1));
				slider[i].slider('values', 0, slider[i].slider('values', 1));
			}
			filter();
		});
		$('.filter input.min').change(function () {
			var a = Number($(this).parent().parent().parent().find('div.min').html().replace(/[^0-9]/g,''));
			if($(this).val() < a) {
				$(this).val(a); 
			}
			filter();
		});

		$('.filter input.max').keyup(function () {
			var block = $(this).parent().parent().parent(),
				i = block.index() - 1;
			if($(this).val() >= slider[i].slider('values', 0)) {
				slider[i].slider('values', 1, $(this).val());
			}
			else {
				$(this).val(slider[i].slider('values', 0));
				slider[i].slider('values', 1, slider[i].slider('values', 0));
			}
			filter();
		});
		$('.filter input.max').change(function () {
			var a = Number($(this).parent().parent().parent().find('div.max').html().replace(/[^0-9]/g,''));
			if($(this).val() > a) {
				$(this).val(a); 
			}
			filter();
		});
		$('.menu .category a').click(function () {
			if(!$(this).parent().hasClass('active')) {
				$('.menu .category .active').removeClass('active');
				$(this).parent().addClass('active');
			}
			else {
				$('.menu .category .active').removeClass('active');
			}
			filter();
			return false;
		});
	}

	// Изменение количества
	$('.counter span').click(function () {
		var to = $(this).hasClass('plus') ? 1 : 0,
			input = $(this).parent().parent().children('input'),
			val = parseFloat(input.val());
		if(to) {
			input.val(val + 1);
		}
		else {
			if(val > 1) {
				input.val(val - 1);
			}
		}
		if($('.cartList').length) {
			calculate();
		}
	});
	$('.counter input').keyup(function () {
		var v = Number($(this).val().replace(/[^0-9]/,''));
		$(this).val(v ? v : 1);
	});

	// Корзина - страница
	function calculate () {
		// стоимость мебели
		var s = 0,
			price,
			count,
			ans;
		$('.cartList .block').each(function () {
			price = Number($(this).find('.Price').find('.price').html().replace(/[^0-9]/g,''));
			count = Number($(this).find('.counter').children('input').val());
			ans = price * count;
			$(this).find('.TotalPrice').find('.price').html(priceFormat(ans));
			s += ans;
		});
		$('.cartList .total b').html(priceFormat(s));

		// стоимость доставки
		var d = 0,
			quantity,
			delivery = !$('.enterData .select[data-target="#mkad"] .selected').hasClass('display') ? 0 : $('#mkad input').attr('data-price') * Math.abs(Number($('#mkad input').val().replace(/[^0-9]/g,''))),
			handup = !$('.enterData .select[data-target="#handup"] .selected').hasClass('display') ? 0 : Math.abs(Number($('#handup input').val().replace(/[^0-9]/g,''))),
			lift,
			assembly;
		$('.priceDelivery .block[data-id]').each(function () {
			quantity = $(this).attr('data-quantity');
			assembly = $(this).attr('data-assembly') * quantity;

			lift = $(this).attr('data-'+ (!handup ? 'lift' : 'lift_hand'));
			lift = (!handup ? lift : lift * handup) * quantity;

			d += lift + assembly;

			$(this).find('.Lift').children('span').html(priceFormat(lift));
			$(this).find('.Assembly').children('span').html(priceFormat(assembly));
			$(this).find('.Total').children('span').html(priceFormat(lift + assembly));
		});

		if(!delivery) {
			$('.priceDelivery .delivery span').html('Бесплатно').addClass('free');
		}
		else {
			$('.priceDelivery .delivery span').html(priceFormat(delivery)).removeClass('free');
		}
		d += delivery;
		$('.priceDelivery .total span').html(priceFormat(d));

		// стоимость заказа
		$('.totalPrice b').html( priceFormat(s + d) );
	}
	function cartUpdate (data) {
		var count = data.count,
			sum = data.sum,
			href = '/cart#ok',
			text = 'Оформить заказ',
			msg = '0 товаров <b>Выберите товары из каталога</b>';
		if(count == 0) {
			href = '/catalog',
			text = 'В каталог';
			$('.cart .layer').addClass('empty');
			if($('.cartList').length) {
				$('.cartList').slideUp(500, function () {
					$('.cartList').parent().html('<div class="island">\
		                <p>В вашей корзине 0 товаров</p>\
		                <p>\
		                    <span class="left cartListEmpty">Начните делать покупки </span>\
		                    <a href="/catalog" class="button left">В каталоге</a>\
		                </p>\
		                <div class="clear"></div>\
		            </div>');
				});
			}
		}
		else {
			msg = count +' товар <b>'+ priceFormat(sum) +' руб.</b>';
			$('.cart .layer').removeClass('empty');
		}
		$('.cart .msg').html(msg);
		$('.cart .button').attr('href', href).text(text);
		cartDeclension();
	}
	if($('.cartList').length > 0) {
		$('.cartList .vertical').each(function () {
			$(this).height($(this).parent().parent().height());
		});
		setTimeout(function () {
			$('.cartList .vertical').each(function () {
				$(this).height($(this).parent().parent().height());
			});
		}, 500);
	}
	$('.cartList .delete span').click(function () {
        $.post('/cart/delete', {
            id: $(this).parent().parent().parent().attr('data-id')
        }, function(data) {
            cartUpdate(data);
        });
		var t = 500,
			obj = $(this).parent().parent().parent();
		obj.fadeOut(t, function () {
			$(this).remove();
			calculate();
		});
		$('.priceDelivery .block[data-id='+ obj.attr('data-id') +']').fadeOut(t, function () {
			$(this).remove();
			calculate();
		});
	});
	if($('.cartList').length) {
		calculate();
	}
	$('.cartList .manage span').click(function () {
		var id = $(this).parent().parent().parent().parent().parent().attr('data-id'),
			count = $(this).parent().parent().children('input').val();
		$('.priceDelivery .block[data-id='+ id +']').attr('data-quantity', count);
		/*
		//доделать!!
		var count = Number($(this).parent().find('input').val()),
			color = false,
			config = 'left';
		if($('.productInfo').length) {
			color = $('.color .item.active').attr('data-id');
			config = $('.config .item.selected').attr('data-val');
		}
		*/
		$.post('/cart/add', {
			id     : id,
			count  : count
		}, function(data) {
			cartUpdate(data);
		});
		calculate();
	});
	$('.cartList .counter input').keyup(function () {
		calculate();
	});
	$('.calcDelivery .enterData .select .item').click(function () {
		calculate();
	});
	$('#mkad input, #handup input').keyup(function () {
		calculate();
	});

	$('.cartOrder form').submit(function () {
		var form = $(this).serialize(),
			city = $('.calcDelivery .select:eq(0) .selected').text(),
			distance = (city == 'Другой адрес' ? Number($('#mkad').find('input').val()) : -1),
			lift = $('.calcDelivery .select:eq(1) .selected').text(),
			stage = (lift == 'Вручную' ? Number($('#handup').find('input').val()) : -1);
		$.post('/cart/order', {
			'form'     : form,
			'city'     : city,
			'distance' : distance,
			'lift'     : lift,
			'stage'    : stage
		}, function(data) {
			if(data.success == true) {
				openPopup('Номер заказа: <b>'+ data.number +'</b>', 'Ваш заказ оформлен');
				$('.cartOrder input[type=text], .cartOrder textarea').val('');
			}
			else {
				openPopup('<p><b>Ошибка оформления заказа</b></p>\
				<p>Попробуйте повторить попытку позже или позвонить нам в офис <a href="tel:+74959797858" class="right">+7 (495) 979-78-58</a>', 'Ваш заказ не оформлен');
			}
		});
		return false;
	});

	// Модальные окна
	$('.sertificates').magnificPopup({
		delegate: 'a',
		type: 'image',
		gallery: {
			enabled:true
		}
	});
	$('.cartList .image .view-big, .color .preview').magnificPopup({
		type: 'image'
	});
	$('.productView .big').magnificPopup({
		delegate: 'a',
		type: 'image'
	});

	// Изменение цвета
	$('.color .label').click(function () {
		var obj = $(this).parent();
		if(!obj.hasClass('active')) {
			obj.parent().find('.item.active').removeClass('active');
			obj.addClass('active');
		}
	});

	// Просмотр товара - страница
	function viewBig (src) {
		var sp = 300;
		$('.productView .big').children('img').fadeOut(sp / 2, function () {
			$(this).attr('src', src);
			$(this).parent().children('a').attr('href', src);
			$(this).fadeIn(sp);
		});
	}
	var sliderCount = $('.productView .block').length,
		sliderLine = 4;
	if(sliderCount == 1) {
		$('.productView .preview').hide();
		$('.productView').addClass('onlyone');
	}
	if($('.productView .preview').length) {
		var sliderAnimate = false,
			sliderSpeed = 0.4, // sec
			sliderPos,
			sliderStep,
			sliderActive;
		$('.productView .preview span').click(function () {
			if(!sliderAnimate) {
				sliderPos = Number($('.productView .preview').attr('data-pos'));
				sliderStep = Number($('.productView .block').outerWidth(true));
				sliderActive = $('.productView .block.active').index();
				if($(this).hasClass('back')) {
					if(sliderPos > 0) {
						sliderPos--;
					}
					if(sliderActive > 0) {
						sliderActive--;
					}
				}
				else {
					if((sliderPos + sliderLine) < sliderCount) {
						sliderPos++;
					}
					if(sliderActive < ( sliderCount - 1)) {
						sliderActive++;
					}
				}
				if($('.productView .preview').attr('data-pos') != sliderPos) {
					$('.productView .preview').attr('data-pos', sliderPos);
					sliderAnimate = true;
					$('.productView .move').animate({ 'left': -(sliderStep * sliderPos) +'px' }, sliderSpeed * 1000, function () {
						sliderAnimate = false;
					});
				}
				if(sliderActive != $('.productView .block.active').index()) {
					$('.productView .block.active').removeClass('active');
					$('.productView .block:eq('+ sliderActive +')').addClass('active');
					viewBig($('.productView .block:eq('+ sliderActive +') a').attr('href'));
				}
			}
		});
		$('.productView .preview a').click(function () {
			if(!$(this).parent().hasClass('active')) {
				$('.productView .preview .active').removeClass('active');
				$(this).parent().addClass('active');
				viewBig($(this).attr('href'));
			}
			return false;
		});
	}
	function productHeight () {
		if($('.productInfo').height() < $('.productView').height()) {
			$('.productInfo').outerHeight($('.productView').height());
		}
	}
	productHeight();
	setTimeout(function() {
		productHeight();
	}, 500);
	if($('.color .item').length && !$('.color .item.active').length) {
		$('.color .item:eq(0)').addClass('active');
	}

	// Добавление в корзину
	$('.toCart .add').click(function () {
		var count = Number($(this).parent().find('input').val()),
			color = false,
			config = 'left';
		if($('.productInfo').length) {
			color = $('.color .item.active').attr('data-id');
			config = $('.config .item.selected').attr('data-val');
		}
		$.post('/cart/add', {
			id     : $(this).parent().attr('data-id'),
			count  : count,
			color  : color,
			config : config
		}, function(data) {
			cartUpdate(data);
		});
	});

	// placeholder для текстовой области
	$('textarea').focus(function () { 
		if(this.value == 'Текст обращения') { 
			this.value = ''; 
		} 
	}).blur(function () { 
		if(this.value == '') { 
			this.value = 'Текст обращения'; 
		} 
	});

	// Обратная связь
	$('.feedback form').submit(function () {
		var data = {};
		$(this).find('input, textarea').each(function () {
			if($(this).attr('name')) {
				data[$(this).attr('name')] = $(this).val();
			}
		});
		$.post('/feedback', data, function(data) {
			if(data.success == true) {
				openPopup('Номер обращения: <b>'+ data.number +'</b>', 'Ваше обращение успешно отправлено');
				$('.feedback input[type=text], .feedback textarea').val('');
			}
			else {
				openPopup('<p><b>Ошибка отправки</b></p>\
					<p>Попробуйте повторить попытку позже или позвонить нам в офис <a href="tel:+74959797858" class="right">+7 (495) 979-78-58</a>', 'Ваше обращение не отправлено');
			}
		});
		return false;
	});
});