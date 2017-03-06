$(document).ready(function() {
	getStationDropdown();
	getLocationDropdown();
	getSessionDropdown();
	getPeriodDropdown();

	$('#assign').submit(function() {
		$('#addButtonSession').attr('disabled', true);
		$.ajax({
			url: "php/assign_student_act.php",
			type: "post",
			data: $(this).serialize(),
			success: function(result) {
				alert('Tambah Peserta Manual Berhasil!');
			},
			error: function(result) {
				alert('Tambah Peserta Manual Tidak Berhasi!');
				// return false to cancel the form post
				// since javascript will perform it with ajax
			}
		});
		return false;
	});
});

function getStationDropdown()
{
	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=data&id=station',
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data){
				$.each(data.data, function (i, items) {
					$(".station").append("<option value='"+items.station_id+"'>"+items.name+"</option>");
				});
			}
		}
	});
}

function getLocationDropdown()
{
	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=data&id=location',
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data){
				$.each(data.data, function (i, items) {
					$(".location").append("<option value='"+items.location_id+"'>"+items.name+"</option>");
				});
			}
		}
	});
}

function getSessionDropdown()
{
	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=get_dropdown&id=session',
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data){
				$.each(data.data, function (i, items) {
					$(".session").append("<option value='"+items.session_id+"'>"+items.name+"</option>");
				});
			}
		}
	});
}

function getPeriodDropdown()
{
	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=get_dropdown&id=period',
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data){
				$.each(data.data, function (i, items) {
					$(".period").append("<option value='"+items.period_id+"'>"+items.name+"</option>");
				});
			}
		}
	});
}
