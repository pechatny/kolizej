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
	if($('.filter').length > 0) {
		// Фильтр в каталоге
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

	// Корзина
	function calculate () {
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
		var t = 500;

        $.post('/cart/delete', {
            id   : $(this).attr('data-id')
        }, function(data) {
            //
        });

		$(this).parent().parent().parent().fadeOut(t, function () {
			$(this).remove();
			calculate();
		});
	});
	if($('.cartList').length) {
		calculate();
	}
	$('.cartList .manage span').click(function () {
		calculate();
	});
	$('.cartList .counter input').keyup(function () {
		calculate();
	});

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

	$('.color .label').click(function () {
		var obj = $(this).parent();
		if(!obj.hasClass('active')) {
			obj.parent().find('.item.active').removeClass('active');
			obj.addClass('active');
		}
	});

	// Просмотр товара
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
	$('.toCart').click(function () {
		var count = Number($(this).find('input').val()),
			color = false,
			config = 'left';
		if($('.productInfo').length) {
			color = $('.color .item.active').children('span').text();
			config = $('.config .item.selected').attr('data-val');
		}
		$.post('/cart/add', {
			id     : $(this).attr('data-id'),
			count  : count,
			color  : color,
			config : config
		}, function(data) {
			//
		});
	});

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

	// Корзина
	$('.cartOrder form').submit(function () {
		var form = $(this).serialize(),
			city = $('.calcDelivery .select:eq(0) .selected').text(),
			distance = (city == 'Другой адрес' ? Number($('#mkad').find('input').val()) : -1),
			lift = $('.calcDelivery .select:eq(1) .selected').text(),
			stage = (lift == 'Вручную' ? Number($('#handup').find('input').val()) : -1);
		$.post('/ex.php', {
			'form'     : form, // FORMAT: name=1&lastname=2&phone=3&addres=4
			'city'     : city,
			'distance' : distance,
			'lift'     : lift,
			'stage'    : stage
		}, function(data) {
			//
		});
		return false;
	});
});