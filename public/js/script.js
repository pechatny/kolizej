$(function () {
	function debug (string) {
		if(!$('.debug').length) {
			$('body').append('<div class="debug" style="position:fixed; z-index:10000; top:15px; left:0; padding:7px 10px; border-radius:0 5px 5px 0; border:1px solid #c00; display:block; background:#eee; color:#333; font-family:Courier new"></div>');
		}
		$('.debug').html(string);
	}
	if($('.filter').length > 0) {
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
		$(this).val(Number($(this).val().replace(/[^0-9]/,'')));
	});

	$('.color .choose span').click(function () {
		var obj = $(this).parent();
		if(!obj.hasClass('active')) {
			obj.parent().find('.item.active').removeClass('active');
			obj.addClass('active');
		}
	});
});