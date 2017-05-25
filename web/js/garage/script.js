/**
 * Скрипт горожа
 */

$(document).ready(function(){
	
	//открыть окно создания авто------------------------------------------------
	$( "#new_car" ).click(function() {
	   $('#form_edit_car_modal').modal('show');
	   $('#Fcar')[0].reset();
	});
	//--------------------------------------------------------------------------	
	
	//удаление авто------------------------------------------------
	$( ".remove_car" ).click(function() {
		
		if (!confirm("Вы подтверждаете удаление?")) return false;
		 
		var id = $(this).parent('td').parent('tr').data('idcar');

		$.ajax({
			type: 'POST',
			url: '/garage/ajax/',
			dataType:'JSON',
			data: {
				action: 'delCar',
				id: id,
				_csrf: csrf
			},
			success: function(json){
				if(json.ERROR != null){
					mshow('success', json.ERROR);
					alert();
				}else{
					mshow('success', json.OK);
					$('[data-idcar='+id+']').remove();
				}
			}
		});
		return false;
	});
	//--------------------------------------------------------------------------	
	
	//открыть окно для редактирования  авто------------------------------------------------
	$( ".click_edit_car td" ).click(function() {
		var id = $(this).parent('tr').data('idcar');
		var temp_name = '';
		$.ajax({
			type: 'POST',
			url: '/garage/ajax/',
			dataType:'JSON',
			data: {
				action: 'getCar',
				id: id,
				_csrf: csrf
			},
			success: function(json){
				if(json.ERROR != null){
					alert('error ajax');
				}else{
					$.each(json, function( key, value ) {
					temp_name = '[name = "Cars['+key+']"]';
						switch ($(temp_name).prop("tagName")){
							case 'INPUT':{
								$(temp_name).val(value);
								break;
							}
							case 'SELECT':{
								$(temp_name).val(value).change();
								break;
							}
						}
					});
					$('#form_edit_car_modal').modal('show');
				}
			}
		});
	

	});
	//--------------------------------------------------------------------------

});