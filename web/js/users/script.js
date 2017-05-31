/**
 * Скрипт горожа
 */

$(document).ready(function(){
	
	//открыть окно создания авто------------------------------------------------
	$( "#new_user" ).click(function() {
	   $('#form_edit_user_modal').modal('show');
	   $('#Fuser')[0].reset();
	});
	//--------------------------------------------------------------------------	
	
	//удаление авто------------------------------------------------
	$( ".remove_user" ).click(function() {
		
		if (!confirm("Вы подтверждаете удаление?")) return false;
		 
		var id = $(this).parent('td').parent('tr').data('iduser');

		$.ajax({
			type: 'POST',
			url: '/users/ajax/',
			dataType:'JSON',
			data: {
				action: 'delUser',
				id: id,
				_csrf: csrf
			},
			success: function(json){
				if(json.ERROR != null){
					mshow('success', json.ERROR);
					alert();
				}else{
					mshow('success', json.OK);
					$('[data-iduser='+id+']').remove();
				}
			}
		});
		return false;
	});
	//--------------------------------------------------------------------------	
	
	//открыть окно для редактирования  авто------------------------------------------------
	$( ".click_edit_user td" ).click(function() {
		var id = $(this).parent('tr').data('iduser');
		var temp_name = '';
		$.ajax({
			type: 'POST',
			url: '/users/ajax/',
			dataType:'JSON',
			data: {
				action: 'getUser',
				id: id,
				_csrf: csrf
			},
			success: function(json){
				if(json.ERROR != null){
					alert('error ajax');
				}else{
					$.each(json, function( key, value ) {
						temp_name = '[name = "User['+key+']"]';
						switch ($(temp_name).prop("tagName")){
							case 'INPUT':{
								$(temp_name).val(value);
								break;
							}
							case 'SELECT':{
								if(key === 'roles' && value != null){
									$(temp_name).val(value.item_name).change();
								}else{
									$(temp_name).val(value).change();
								}
								
								break;
							}
						}
					});
					$('#myUserLabel').html('Редактировать автомобиль: ' + json.brand + ' ' + json.model + ' (' + json.number + ')');
					$('#form_edit_user_modal').modal('show');
				}
			}
		});
	

	});
	//--------------------------------------------------------------------------

});