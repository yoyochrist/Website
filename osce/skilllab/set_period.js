$(document).ready(function() {
	if( $.fn.dataTable.isDataTable('#myTable')) {
		table = $('#myTable').DataTable();
		table.destroy();
		table = $('#myTable').DataTable( {
			paging: false,
			ordering: false,
			info: false,
			searching: false
		});
	}
	else
	{
		table = $('#myTable').DataTable( {
			paging: false,
			ordering: false,
			info: false,
			searching: false
		});
	}
	getSubjectDropdown();
	getData();
	$('.tambahPeriode').attr('data-toggle','modal').attr('data-target', '#addPeriod');
	
	$('#formAddPeriod').submit(function() {
		$.ajax({
			url: "php/period.php?f=add",
			type: "post",
			data: $(this).serialize(),
			success: function(result) {
			        $('#addPeriod').modal('hide');
			        $('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
				$('.periodRow').remove();
				getData();
			},
			error: function(result) {
				alert('Tambah periode tidak berhasil!');
			}
		});
		// return false to cancel the form post
		// since javascript will perform it with ajax
		return false;
	});
});

function getSubjectDropdown()
{
	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=get_dropdown&id=subject',
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data){
				$.each(data.data, function (i, items) {
					$(".subjectList").append("<option value='"+items.id+"'>"+items.name+"</option>");
				});
			}
		}
	});
}

function getData(){
	$.ajax({
		type: 'GET',
		url: 'php/period.php?f=get_period',
		async: false,
		dataType: 'json',
		success: function (data) {
			var counter = 0;
			if(data)
			{
				$.each(data.data, function (i, items) {
					counter=counter+1;

					var body = $('#myTable');
					var template = $('.templatePeriod');
        	        	        var c = template.clone().removeClass('templatePeriod ').removeClass('hide').addClass('periodRow');
					var clone = c;

					var period_name = items.period_name;
					var session_count = items.session_count;
					var exam_type = items.exam_type;
					var subject_name = items.subject_name;
					var count = counter.toString();
					var date_start = items.date_start;
					var date_end= items.date_end;

					if(items.active == 1)
					{
						$('.periodName', clone).append(period_name.bold()+' ('.bold()+items.id.bold()+')'.bold());
						$('.sessionCount', clone).append(session_count.bold());
						$('.examType', clone).append(exam_type.bold());
						$('.subjectName', clone).append(subject_name.bold());
						$('.count', clone).append(count.bold());
					}
					else
					{
						$('.periodName', clone).text(period_name+' ('+items.id+')');
						$('.sessionCount', clone).text(session_count);
						$('.examType', clone).text(exam_type);
						$('.subjectName', clone).text(subject_name);
						$('.count', clone).append(count);
					}
					
					
					$('.editSesi', clone).attr('id','editSesi'+items.id).attr('data-id',items.id);
					
					$('.subjectList',clone).find("option[value='"+items.subject_id+"']").attr("selected", "selected");
					$('.activeList',clone).find("option[value='"+items.active+"']").attr("selected", "selected");
					$('.dataConfirmEditPeriodModal',clone).attr('id','dataConfirmEditPeriodModal'+items.id);
					$('.dataConfirmDeletePeriodModal',clone).attr('id','dataConfirmDeletePeriodModal'+items.id);
					$('.formEditPeriod',clone).attr('id','formEditPeriod'+items.id);
					$('.formDeletePeriod',clone).attr('id','formDeletePeriod'+items.id);
					$('.editPeriod', clone).attr('data-toggle','modal').attr('data-target','#dataConfirmEditPeriodModal'+items.id);
					$('.idPeriodClass', clone).attr('value',items.id)
					$('.namePeriodClass',clone).attr('value',period_name);
					$('.idDeleteClass',clone).attr('value',items.id);
					$('.date_start',clone).attr('value',date_start);
					$('.date_end',clone).attr('value',date_end);
					$('.hapusPeriod',clone).attr('data-toggle','modal').attr('data-target','#dataConfirmDeletePeriodModal'+items.id);

					body.append(clone);

					//set period yang dipilih sebagai periode aktif
					$("#editSesi"+items.id).click(function(){
						var id = $(this).attr('data-id');
						$.ajax({
							type:"POST",
							url: "php/set_period.php",
							data: 'period_id='+id,
							success: function () {
								window.location.href = "index.php?mod=set";	
							}
						});
					});

					$('#formEditPeriod'+items.id).submit(function() {
						$.ajax({
							url: "php/period.php?f=update",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
							        $('#dataConfirmEditPeriodModal'+items.id).modal('hide');
							        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								$('.periodRow').remove();
								getData();
							},
							error: function(result) {
								alert('Ubah lokasi tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});

					$('#formDeletePeriod'+items.id).submit(function() {
						$.ajax({
							url: "php/period.php?f=delete",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
							        $('#dataConfirmDeletePeriodModal'+items.id).modal('hide');
							        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								$('.periodRow').remove();
								getData();
							},
							error: function(result) {
								alert('Hapus lokasi tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});
				});
			}
		}
	});
}

