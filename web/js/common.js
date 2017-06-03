

$(document).ready(function(){
	$('.table td').hover(
		function(){
			$(this).closest('tr').addClass('active_tr');
		},
		function(){
			$(this).closest('tr').removeClass('active_tr');  
		}
	);
	
	//только цыфры--------------------------------------------------------------
	$('.js_only-int').on('keyup', function(){
		$(this).val($(this).val().replace (/\D/, ''));
	});
	//--------------------------------------------------------------------------
	
	//запустим активную модалку-------------------------------------------------
	if(active_modal_win.length > 0){
		$('#'+active_modal_win).modal('show');
	}
	//--------------------------------------------------------------------------
	
	//вывод сообщеине ----------------------------------------------------------
		
		if(noty_error.length > 0){
			mshow('error', noty_error);
		}
		if(noty_success.length > 0){
			mshow('success', noty_success);
		}
		if(noty_info.length > 0){
			mshow('alert', noty_info);
		}
	
	//--------------------------------------------------------------------------
	
	

});

	/**
	 * вывод сообщеине 
	 * @param {type} type
	 * @param {type} text
	 * @returns {undefined}
	 */
	function mshow(type, text){
		noty({
			text: text,
			"layout":"topRight", 
			"type":type,
			"textAlign":"center",
			"easing":"swing",
			"animateOpen":{"height":"toggle"},
			"animateClose":{"height":"toggle"},
			"speed":"500000",
			"timeout":"500000",
			"closable":true,
			"closeOnSelfClick":true
		});
	} 
	
	$(function(){
		$('.date_pic').daterangepicker({
			singleDatePicker: true,
			dateLimit: true,
			locale: {
				format: 'DD.MM.YYYY'
			}
		});
	});

