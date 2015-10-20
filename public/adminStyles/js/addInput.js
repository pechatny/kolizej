$(document).ready(function() {
	var max_fields      = 10; //maximum input boxes allowed
	var wrapper         = $(".add_fields"); //Fields wrapper
	var add_button      = $(".add_field_button"); //Add button ID

	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('' +
				'<div class="input_fields_wrap"><div><input type="file" name="images[]"><button class="remove_field">Удалить</button></div>'
			); //add input box
		}
	});

	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});

$(document).ready(function() {
	var wrapper         = $(".add_color"); //Fields wrapper
	var add_button      = $(".add_color_button"); //Add button ID
	var select          = $(".input_color").eq(0).html();

	//alert(select);

	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		$(wrapper).append('<div class="input_color">' + select + '</div>'
		); //add input box
	});

	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});