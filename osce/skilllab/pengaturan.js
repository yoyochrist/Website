$(document).ready(function() {
	
	getData();
	getCompetentDropdown();
	getSessionDropdown();
	getCompetentAddList();

	$('.locationTemplate').hide();
	$('.stationTemplate').hide();

	/*$(".lecturer_name").autocomplete({
		minLength: 2,
		source: "php/search_lecturer.php",
		focus: function( event, ui ) {
			$(".lecturer_name").val(ui.item.value);
			return false;
		},
		select: function( event, ui ) {
			$(".lecturer_name").val(ui.item.value);
			$(".lecturer_id").val(ui.item.id);
		} 
	});*/

	$('.tambahSesi').click(function(){
		$('#addButtonSession').attr('disabled', false);
	});

	$('.tambahKompetensi').click(function(){
		$('#addButtonCompetent').attr('disabled', false);
	});

	$('#formAddBatchCompetent').submit(function() {
		$.ajax({
			url: "php/competent.php?f=addBatch",
			type: "post",
			data: $(this).serialize(),
			success: function(result) {
			       	$('#addCompetent').modal('hide');
				$('#addButtonCompetent').attr('disabled', true);
				$('#txtData').empty();
				$('#addSession').modal('hide');
				getData();
			},
			error: function(result) {
				alert('Tambah kompetensi tidak berhasil!');
			}
		});
		// return false to cancel the form post
		// since javascript will perform it with ajax
		return false;
	});
	
	$('#formAddSession').submit(function() {
		$('#addButtonSession').attr('disabled', true);
		$.ajax({
			url: "php/session.php?f=add",
			type: "post",
			data: $(this).serialize(),
			success: function(result) {
				$('#txtData').empty();
		       	$('#addSession').modal('hide');
				getData();
			},
			error: function(result) {
				alert('Tambah sesi tidak berhasil!');
				// return false to cancel the form post
				// since javascript will perform it with ajax
			}
		});
		return false;
	});
});

function showhide(id)
{
	var e = document.getElementById(id);
	if(e)
	{
		if(e.style.display == 'none')
			e.style.display = 'block';
		else
			e.style.display = 'none';
	}
}

function disenable(id, rule)
{
	if(rule == 1)
	{
		$(id).removeAttr("disabled");
		$(id).focus();
	}
	else
	{
		$(id).attr("disabled", "disabled");
	}
}

function getSessionDropdown()
{
	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=get_session_dropdown',
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data){
				$.each(data.data, function (i, items) {
					$(".sessionList").append("<option value='"+items.id+"'>"+items.name+"</option>");
				});
			}
		}
	});
}

function getCompetentDropdown()
{
	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=get_dropdown&id=competent',
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data){
				$.each(data.data, function (i, items) {
					$(".competentList").append("<option value='"+items.id+"'>"+items.name+"</option>");
				});
			}
		}
	});
}

function getCompetentAddList()
{
	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=get_dropdown&id=competent',
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data){
				$.each(data.data, function (i, items) {
					body = $("body").find(".competentAddTemplate");
					template = $("#competentAddTemplate").find('.txtCompetent');
	                		var c = template.clone().removeClass('hidden').addClass("competentField");
					$('.competentCheckbox',c).attr('id', 'competentCheckbox'+items.id).attr('value',items.id);
					$('.competentName',c).text(items.name);
					$('.competentTextbox',c).attr('disabled', 'disabled').attr('id', 'competentTextbox'+items.id);
					//$('.subject option').find('value='+items.subject_id).attr('selected', true);
					body.append(c);
					
					$('#competentCheckbox'+items.id).click(function(){
						if ($(this).is(":checked"))
						{
							disenable("#competentTextbox"+items.id,1);
						}
						else
						{
							disenable("#competentTextbox"+items.id,0);
						}
					});
				});
			}
		}
	});
}

function getCompetentList(str)
{
	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=get_competent&id='+str,
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data){
				$.each(data.data, function (i, items) {
					body = $("body").find(".competentTemplate[data-id='"+str+"']");
					template = $("#competentTemplate").find('.txtCompetent');
					var c = template.clone().removeClass('hidden').addClass("competentField");
					$('.competentCheckbox',c).attr('id', 'competentCheckbox'+str+items.competent_id).attr('value',items.competent_id).attr('form','formEditCompetent'+str);
					$('.competentName',c).text(items.competent_name).attr('form','formEditCompetent'+str);
					$('.sessionID',c).attr('value',str);
					$('.competentTextbox',c).attr('disabled', 'disabled').attr('value',items.weight).attr('id', 'competentTextbox'+str+items.competent_id).attr('form','formEditCompetent'+str);
					$('.competentHidden',c).attr('value',items.competent_id).attr('id', 'competentHidden'+str+items.competent_id);
					
					$('.formDeleteCompetent',c).attr('id','formDeleteCompetent'+str+items.competent_id);
					//$('.subject option').find('value='+items.subject_id).attr('selected', true);
					body.append(c);
					
					$('#competentCheckbox'+str+items.competent_id).click(function(){
						if ($(this).is(":checked"))
						{
							disenable("#competentTextbox"+str+items.competent_id,1);
						}
						else
						{
							disenable("#competentTextbox"+str+items.competent_id,0);
						}
					});
					
					$('#formDeleteCompetent'+str+items.competent_id).submit(function() {
						alert('Anda yakin untuk menghapus kompetensi ini?');
						$.ajax({
							url: "php/competent.php?f=delete",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#competentT'+str).empty();
								getCompetentList(str);
						        	$('#ubahSession'+str).modal('hide');
						        	$('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
							},
							error: function(result) {
								alert('Hapus kompetensi tidak berhasil!');
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

function getPesertaData(per_id, sess_id, loc_id, stat_id, code)
{
	$.ajax({
		type: 'GET',
		url: 'php/station.php?f=get_student&perid='+per_id+'&sessid='+sess_id+'&locid='+loc_id+'&statid='+stat_id,
		async: false,
		dataType: 'json',
		success: function (data) {
			var counter = 0;
			if(data){
				$.each(data.data, function (i, items) {
					body = $("body").find("#templatePeserta[data-id='"+code+"']");
					template = $(".templatePeserta");
	        		        var c = template.clone().removeClass('templatePeserta').removeClass('hide').addClass("pesertaRow");
					$('.nim',c).text(items.student_id);
					$('.nama',c).text(items.student_name);
					body.append(c);
				});
			}
		}
	});
}

function getStationData(per_id, sess_id, loc_id, code)
{

	$.ajax({
		type: 'GET',
		url: 'php/station.php?f=get_data&perid='+per_id+'&sessid='+sess_id+'&locid='+loc_id,
		async: false,
		dataType: 'json',
		success: function (data) {
			var counter = 0;
			if(data){
				$.each(data.data, function (i, items) {
					body = $("body").find(".stationTemplate[data-id='"+code+"']");
					template = $("#stationTemplate").find('.txtStation');
					counter=counter+1;
					if(counter%2==0)
					{
		        		        var c = template.clone().removeAttr('id').removeClass('hidden').addClass('even').addClass("dataStation");
					}
					else
					{
		        		        var c = template.clone().removeAttr('id').removeClass('hidden').addClass('odd').addClass("dataStation");
					}
					$('#templatePeserta',c).attr("data-id", code+items.station_id);
					$('.text_transact_id',c).attr('value',items.id);
					$('.penguji',c).text(items.lecturer_name);
					$('.jadwalPengujiModal',c).attr("id", "jadwalPengujiModal"+code+items.id);

					$('.pesertaModal',c).attr("id", "pesertaModal"+code+items.id);
					$('.lihatMahasiswa',c).attr('data-target','#pesertaModal'+code+items.id);
					$('.station',c).text("PESERTA STATION "+items.station_id);

					$('.deleteStationForm',c).attr('id','hapusStation'+code+items.id);
					$('.hapusStation',c).attr('data-target','#hapusStation'+code+items.id);
					$('.formDeleteStation',c).attr('id','formDeleteStation'+code+items.id);
					$('.idStationClass',c).attr('value',items.id);

					if(items.lecturer_name)
					{
						$('.jadwalPenguji',c).attr('data-target','#jadwalPengujiModal'+code+items.id);
					}
					else
					{
						$('.jadwalPenguji',c).attr('data-target','#jadwalPengujiModal'+code+items.id);
					}
					$('.formAssignLecturer',c).attr('id','formAssignLecturer'+code+items.id);

					$('.stationname',c).text('Station '+items.station_name);
					body.append(c);
					getPesertaData(items.period_id, items.session_id, items.location_id, items.station_id, code+items.station_id);

					$('#formDeleteStation'+code+items.id).submit(function() {
						$.ajax({
							url: "php/station.php?f=delete",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#stationT'+code).empty();
						      		$('#hapusStation'+code+items.id).modal('hide');
							        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								getStationData(per_id, sess_id, loc_id, code);
							},
							error: function(result) {
								alert('Delete sesi tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});

					$('#formAssignLecturer'+code+items.id).submit(function() {
						$.ajax({
							url: "php/lecturer.php?f=add",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#stationT'+code).empty();
								$('#jadwalPengujiModal'+code+items.id).modal('hide');
							        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								getStationData(per_id, sess_id, loc_id, code);
							},
							error: function(result) {
								alert('Jadwalkan penguji tidak berhasil!');
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

function getLocationData(session_id)
{

	$.ajax({
		type: 'GET',
		url: 'php/location.php?f=get_data&sessid='+session_id,
		async: false,
		dataType: 'json',
		success: function (data) {

			if(data){
				$.each(data.data, function (i, items) {
					body = $("body").find(".locationTemplate[data-id='"+session_id+"']");
					template = $("#locationTemplate").find('.txtLocation');
	  				var c = template.clone().removeAttr('id').removeClass('hidden').addClass("dataLocation");
					var code= items.period_id+session_id+items.location_id;
										
					$('.locationname',c).append(' <a href="#" class="station" id=""><b>LOKASI '+items.location_name+' &nbsp;</b><span class="glyphicon glyphicon-chevron-down"></span></a>');
					
					$('.stationTemplate',c).attr("data-id", code).attr("id", "stationT"+code);

					$('.addStation',c).attr("id", "addStation"+code);
					$('.tambahStation',c).attr("data-target", "#addStation"+code);
					$('.station',c).attr('id','station'+code);
				
					$('.deleteLocationForm',c).attr('id','hapusLokasi'+code);
					$('.hapusLokasi',c).attr('data-target','#hapusLokasi'+code);
					$('.formDeleteLocation',c).attr('id','formDeleteLocation'+code);
					$('.idLocationClass',c).attr('value',items.location_id);

					$('.location_period_id', c).attr('value', items.period_id);
					$('.location_session_id', c).attr('value', items.session_id);
					$('.location_location_id', c).attr('value', items.location_id);

					$('.textLocationPeriod', c).text('Periode: '+items.period_name);
					$('.textLocationSession', c).text('Sesi: '+items.session_name);
					$('.textLocationLocation', c).text('Lokasi: '+items.location_name);
					$('.formAddStation',c).attr('id','formAddStation'+code);

					body.append(c);
					getStationData(items.period_id, session_id, items.location_id, code);

					$('#station'+code).click(function(){
						showhide("stationT"+code);
					});

					$('#formDeleteLocation'+code).submit(function() {
						$.ajax({
							url: "php/location.php?f=delete",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#locationT'+session_id).empty();
							        $('#hapusLokasi'+code).modal('hide');
							        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								getLocationData(session_id);
							},
							error: function(result) {
								alert('Tambah station tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});

					$('#formAddStation'+code).submit(function() {
						$.ajax({
							url: "php/station.php?f=add",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#stationT'+code).empty();
						        	$('#addStation'+code).modal('hide');
						        	$('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								getStationData(items.period_id, session_id, items.location_id, code);
							},
							error: function(result) {
								alert('Tambah station tidak berhasil!');
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

function getData()
{
	$.ajax({
		type: 'GET',
		url: 'php/session.php?f=get_data',
		async: false,
		dataType: 'json',
		success: function (data) {
			var body = $('#txtData');
			var template = $('.template');
			var counter=0;

			if(data)
			{
				$.each(data.data, function (i, items) {
		        	var c = template.clone().removeClass('hidden').attr('id','sessionT'+items.id).addClass('sessionT');
					var clone = c;
					counter=counter+1;
					
					$('.competentTemplate',c).attr('data-id', items.id).attr('id','competentT'+items.id);
					
					$('.editSessionForm',c).attr('id','ubahSession'+items.id);
					$('.sessionName',c).append(items.name.bold() + ' ('.bold() + items.id.bold() + ')'.bold());
					$('.editSession',c).attr('data-target','#ubahSession'+items.id);
					$('.editSession',c).attr('data-target','#ubahSession'+items.id);

					$('.editSesiTab',c).attr('id','editSesiTab'+items.id);
					$('.editKompetensiTab',c).attr('id','editKompetensiTab'+items.id);
					$('.editSesi',c).attr('href','#editSesiTab'+items.id);
					$('.editKompetensi',c).attr('href','#editKompetensiTab'+items.id);

					$('.deleteSessionForm',c).attr('id','hapusSession'+items.id);
					$('.hapusSession',c).attr('data-target','#hapusSession'+items.id);
					$('.formDeleteSession',c).attr('id','formDeleteSession'+items.id);
					$('.idSessionClass',c).attr('value',items.id);

					$('.formEditCompetent',c).attr('id','formEditCompetent'+items.id);
					$('.formAddCompetent',c).attr('id','formAddCompetent'+items.id);
					$('.saveCompetent',c).attr('form','formEditCompetent'+items.id)

					$('.formEditSession',c).attr('id','formEditSession'+items.id);
					$('.editSessionId',c).attr('value',items.id);
					$('.editSessionNameField',c).attr('value',items.name);
					$('.editTimeStartField',c).attr('value',items.time_start);
					$('.editTimeEndField',c).attr('value',items.time_end);

					$('.locationTemplate',c).attr("data-id", items.id).attr("id", "locationT"+items.id);
					$('.location',c).attr('id','location'+items.id);

					$('.sessionid',c).append(items.id.bold()).append(' &nbsp;<span class="glyphicon glyphicon-chevron-down"></span>');

					$('.time',c).text(items.time_start+' s.d. '+items.time_end);
					body.append(c);

					getLocationData(items.id);
					getCompetentList(items.id);
					getSubjectDropdown("#subjectList"+items.id);

					$('#location'+items.id).click(function(){
						if($('.sessionT').css('display') == 'none')
						{
							$('#sessionT'+items.id).addClass('sessionT');
							$('.sessionT').show();
						}
						else
						{
							if(counter!=1)
							{
								$('.sessionT').hide();
								$('#sessionT'+items.id).removeClass('sessionT');
								showhide("sessionT"+items.id);
							}
						}
						showhide("locationT"+items.id);
					});

					$('#formDeleteSession'+items.id).submit(function() {
						$.ajax({
							url: "php/session.php?f=delete",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#txtData').empty();
								getData();
						        $('#hapusSession'+items.id).modal('hide');
						        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
							},
							error: function(result) {
								alert('Delete sesi tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});

					$('#formEditSession'+items.id).submit(function() {
						$.ajax({
							url: "php/session.php?f=update",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#txtData').empty();
								getData();
						        	$('#ubahSession'+items.id).modal('hide');
						        	$('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
							},
							error: function(result) {
								alert('Ubah sesi tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});

					$('#formAddCompetent'+items.id).submit(function() {
						$.ajax({
							url: "php/competent.php?f=add",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#competentT'+items.id).empty();
								getCompetentList(items.id);
						        	$('#ubahSession'+items.id).modal('hide');
						       		$('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
							},
							error: function(result) {
								alert('Edit kompetensi tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});
					
					$('#formEditCompetent'+items.id).submit(function() {
						$.ajax({
							url: "php/competent.php?f=update",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#competentT'+items.id).empty();
								getCompetentList(items.id);
						       		$('#ubahSession'+items.id).modal('hide');
						        	$('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
							},
							error: function(result) {
								alert('Edit kompetensi tidak berhasil!');
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