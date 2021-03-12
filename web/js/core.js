$('document').ready(function(){
	
	//initStars();

    $('body').on('submit', '.ajax-form', function(e){
    	
		var form = $(this);	
		e.preventDefault();
		e.stopPropagation();
		
		if (!form.hasClass('sending') && DefaultCheckForm(form)) {
			form.addClass('sending');
			$(form).ajaxSubmit({
				dataType: 'json',
				success: function(data){

					if (data.error != undefined){
						if (data.message != undefined) {
							if ( data.message == 'without_notice' )
								form.removeClass('sending');
							else if (data.message != '')
								setNotice(data.message, (data.error == 0) ? 'success' : 'warning');
						} else {
							setNotice((data.error == 0) ? 'Отправлено' : 'Ошибка', (data.error == 0) ? 'success' : 'warning');
						}
						if (data.error == 0) {
							if (data.reload != undefined){
								location.reload()
							}	
							if (data.redirect != undefined){
								setTimeout(function(){
									location.href = data.redirect;
								}, 2000);
								
							} if (data.callback != undefined){
								window[data.callback](data);
							} else {
								if (!form.hasClass('notreset')) {
									form[0].reset();
									resetStars();
								}
							}
						}
					}

				},
				complete: function(response){
					
					setTimeout(function(){
						form.removeClass('sending');
						
					}, 1000);

				},
				error: function(requestObject, error, errorThrown){
					
					setNotice('Системная ошибка', 'warning');
				}
			})
		} else {
			setNotice( (window.my_data.language == 'kk') ? 'Толтырылмаған өрістер бар!' : 'Не все поля заполнены!', 'warning');
		}
	});
	
	$('.select-dynamic').change(function(){

		var id = $(this).val(),
			target = $(this).attr('data-target'),
			target_insert = $(this).attr('data-target-insert'),
			url = $(this).attr('data-ajaxurl');

		SetDefaultSelect($(this));

		$.ajax({
			type: "GET",
			data: {id: id, target: target},
			url: url,
			success: function(data){
				$('#'+target_insert).html(data).removeAttr('disabled');
			},
			complete: function(response){
				
			},
			error: function(requestObject, error, errorThrown){
				setNotice('Системная ошибка', 'warning');
				return false;
			}
		});
	});

	$('input[type=radio]').change(function() {
		var id = $(this).parents( ".chosen-check" ).find('.custom-answer').attr('is_own');
		if ( $(this).parents( ".chosen-check" ).find('.custom-answer').is(':checked') ){
			$('input[parent_id='+id+']').show(200);
			$('textarea[parent_id='+id+']').show(200);
		} else {
			$('input[parent_id='+id+']').hide(200);
			$('textarea[parent_id='+id+']').hide(200);
		}
	});

	$('input[type=checkbox].custom-answer').change(function() {
		var id = $(this).attr('is_own');
		if ( $(this).is(':checked') ){
			$('input[parent_id='+id+']').show(200);
			$('textarea[parent_id='+id+']').show(200);
		} else {
			$('input[parent_id='+id+']').hide(200);
			$('textarea[parent_id='+id+']').hide(200);
		}
	});
	

	$('body').find('.js_date').each(function(){
		var el = $(this);
		if (el.hasClass('alldate')) {
			el.datetimepicker({
				timepicker:false,
				format:'d.m.Y',
				lang:'ru',
				closeOnDateSelect: true,
				//minDate: '-1970/01/01',
				defaultDate:new Date(),
				dayOfWeekStart:1,
			});
		} else {
			el.datetimepicker({
				timepicker:false,
				format:'d.m.Y',
				lang:'ru',
				closeOnDateSelect: true,
				minDate: '-1970/01/01',
				defaultDate:new Date(),
				dayOfWeekStart:1,			
			});
		}
	});

	$('.arrow').click( function(e){

        e.preventDefault();
        var target = $(this).attr('href'),
        	target_close = $(this).attr('data-close');

        $(target_close).hide();
        $(target).fadeIn(500);
    });

	var slider = document.getElementById("myRange");
	var output = document.getElementById("demo");
	if (output != undefined) {
		output.innerHTML = slider.value;

		slider.oninput = function() {
		  output.innerHTML = this.value;
		}
	}

})

function DefaultCheckForm(from) {
	var check = true;
	from.find('input.required, textarea.required, select.required').each(function(){
		if(!DefualtCheckfield($(this))){
			check = false;
		}
		$(this).change(function(){
			DefualtCheckfield($(this));
		})
	})
	from.find('input.checked, textarea.checked, select.checked').each(function(){
		if($(this).val() != '' && !DefualtCheckfield($(this))){
			check = false;
		}
		$(this).change(function(){
			DefualtCheckfield($(this));
		})
	})
	from.find('div.chosen-check').each(function(){
		check_group = false;
		options_group = $(this);
		options_group.find('input').each(function(){
			if ( $(this).is(':checked') || $(this).hasClass('input-percentage')){
				check_group = true;
			}
		})

		if(check_group) {
			$(this).removeClass('error');
			return true;
		} else {
			$(this).addClass('error');
			check = false;
		}
		
	})
	return check;
}
 
function DefualtCheckfield(el) {

	if ((el.hasClass('name') || el.hasClass('text')) && el.val().length < 1 ){
		el.addClass('error');
		return false;
	}  else if (el.hasClass('email') && !IsEmail(el.val())) {
		el.addClass('error');
		return false;
	}  else if (el.hasClass('id') &&  parseInt(el.val()) <= 0) {
		el.addClass('error');
		return false;
	}  else if (el.hasClass('int') &&  ( el.val() == '' || parseInt(el.val()) <= 0) ) {
		el.addClass('error');
		return false;
	}  else if (el.hasClass('password') &&  el.val().replace(/â€¢/g, '').length <= 4) {
		el.addClass('error');
		return false;
	}  else if (el.hasClass('link') &&  !ValidURL(el.val()) && !ValidURL('http://'+el.val()) ) {
		el.addClass('error');
		return false;
	} else {
		el.removeClass('error');
		return true;
	}
}

function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function ValidURL(str) {
	return str.match(/^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/);
}

function setNotice(mess, theme, delay, position) {

	if (delay == undefined) {
		delay = 6000;
	}
	if (position == undefined) {
		position = 'top';
	}

	var options = {
		appendTo: "body",
		customClass: 'cstm_notice',
		type: "info",
		offset:
		{
		   from: position,
		   amount: 30
		},
		align: "right",
		minWidth: 250,
		maxWidth: 400,
		delay: delay,
		allowDismiss: true,
		spacing: 10
	}

	if ($.simplyToast != undefined) {
		$.simplyToast(mess, theme, options);
	} else {
		alert(mess);
	}
}

function initStars() {
	var Loadblock = $('body');

	if (window.rating != undefined) {
       Loadblock.find('.c-rating:not(.init)').each(function(){

            var input_rating = $(this).find('input.rating_val');
            var readonly = false;
            if ($(this).attr('data-readonly') != undefined &&  $(this).attr('data-readonly'))
                readonly = true;

            $(this).addClass('init');
            window.rating(this, input_rating.val() , 5, function(rating){
                input_rating.val(rating);
            });

        })
    }
}

function resetStars() {

	$('.c-rating__item').remove();
	$('body').find('.c-rating.init').removeClass('init');
	$('input.rating_val').val('0');
	initStars()

}

function SetDefaultSelect(select) {
	var target_insert = select.attr('data-target-insert');
	if ( target_insert != undefined ) {
		$('#'+target_insert).html('<option value=""></option>').attr('disabled', 'disabled');
		SetDefaultSelect($('#'+target_insert));
	}
}




