/**
 * Скрипт горожа
 */

$(document).ready(function(){
	
	//открыть окно создания авто------------------------------------------------
	$( ".click_bcaledar td" ).click(function() {
		var id = $(this).parent('tr').data('idcar');
		document.location.href = "/reservation/"+id;
	});
	//--------------------------------------------------------------------------		

	//открыть окно создания авто------------------------------------------------
	$( ".click_bcaledar td" ).click(function() {
		var id = $(this).parent('tr').data('idcar');
		document.location.href = "/reservation/"+id;
	});
	//--------------------------------------------------------------------------		

	

});