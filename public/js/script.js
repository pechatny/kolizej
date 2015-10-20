$(function () {
	function debug (string) {
		if(!$('.debug').length) {
			$('body').append('<div class="debug" style="position:fixed; z-index:10000; top:15px; left:0; padding:7px 10px; border-radius:0 5px 5px 0; border:1px solid #c00; display:block; background:#eee; color:#333; font-family:Courier new"></div>');
		}
		$('.debug').html(string);
	}

	if($('.filter').length > 0) {
		// Фильтр в каталоге
		function filter () {
			var category = $('.menu .category .active a').text(),
				params = {},
				en,
				rus = {};
			rus['Ширина'] = 'width';
			rus['Высота'] = 'height';
			rus['Глубина'] = 'depth';
			rus['Цена'] = 'price';
			if(!category)
				category = 'all';
			$('.filter .block').each(function () {
				en = rus[$(this).find('.rus').text().replace(':', '')];
				params[en] = $(this).find('input.min').val() +' '+ $(this).find('input.max').val();
			});
			$.post('/catalogUpdate', {
				operation: 'filter',
				params   : params
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
		});
		$('.filter input.min').change(function () {
			var a = Number($(this).parent().parent().parent().find('div.min').html().replace(/[^0-9]/g,''));
			if($(this).val() < a) {
				$(this).val(a); 
			}
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
		});
		$('.filter input.max').change(function () {
			var a = Number($(this).parent().parent().parent().find('div.max').html().replace(/[^0-9]/g,''));
			if($(this).val() > a) {
				$(this).val(a); 
			}
		});
		$('.menu .category a').click(function () {
			if(!$(this).parent().hasClass('active')) {
				$('.menu .category .active').removeClass('active');
				$(this).parent().addClass('active');
				filter();
			}
			return false;
		});
	}

	if($('.cartList').length > 0) {
		$('.cartList .vertical').each(function () {
			$(this).height($(this).parent().children('.Photo').height());
		});
		setTimeout(function () {
			$('.cartList .vertical').each(function () {
				$(this).height($(this).parent().children('.Photo').height());
			});
		}, 500);
	}

	$('.sertificates').magnificPopup({
		delegate: 'a',
		type: 'image',
		gallery: {
			enabled:true
		}
	});
	$('.productView .big a, .cartList .image .view-big, .color .choose .preview').magnificPopup({
		type: 'image'
	});

	$('.counter .manage span').click(function () {
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
	});
	$('.counter input').keyup(function () {
		var v = Number($(this).val().replace(/[^0-9]/,''));
		$(this).val(v ? v : 1);
	});

	$('.color .choose span').click(function () {
		var obj = $(this).parent();
		if(!obj.hasClass('active')) {
			obj.parent().find('.item.active').removeClass('active');
			obj.addClass('active');
		}
	});

	function priceFormat (a) {
		return String(a).replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1 ")
	} 
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
	$('.cartList .delete span').click(function () {
		var t = 500;
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

	var sliderCount = $('.productView .block').length,
		sliderLine = 4;
	if($('.productView .preview').length && sliderCount > sliderLine) {
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
				}
			}
		});
		$('.productView .preview img').click(function () {
			if(!$(this).parent().hasClass('active')) {
				$('.productView .preview .active').removeClass('active');
				$(this).parent().addClass('active');
			}
		});
	}
});