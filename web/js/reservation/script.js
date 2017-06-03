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

	//Ставит статусмашину в ремонт----------------------------------------------
	$( ".set_status" ).click(function() {
		$('#statusReser').val('repairs');
		$('#form_addres').submit();
	});
	//--------------------------------------------------------------------------		

	
	//Ставит статусмашину в ремонт----------------------------------------------
	$( ".set_filter_status" ).click(function() {
		var status = $(this).data('status');
		$('#status_car').val(status);
		$('#filter_cars').submit();
	});
	//--------------------------------------------------------------------------		

	$( ".table_cal .cal_day" ).click(function() {
		var sdate = $(this).data('date');
		$('#sdate').val(sdate);
		$('#sdate_temp').val(sdate);
		$('#edate').val(sdate);
		$('#cal_modal').modal('show');
		
		$('.date_pic2').daterangepicker({
			singleDatePicker: true,
			dateLimit: true,
			startDate: sdate,
			locale: {
				format: 'DD.MM.YYYY'
			}			
		});
	
	});
	
	$( ".c_info" ).hover(
		function() {
			$(this).children('.c_tooltip').show();
			$(this).children('.status_icon').addClass('active_status');
		}, function() {
			$(this).children('.c_tooltip').hide();
			$(this).children('.status_icon').removeClass('active_status');
		}
	);
	

});