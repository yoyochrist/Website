$(document).ready(function() {
	//getData();
	getSubjectDropdown();
	getCompetentDropdown();
	getPeriodDropdown();

	$('.sessionTemplate').hide();
	$('.locationTemplate').hide();
	$('.stationTemplate').hide();
	$('.tambahSesi').hide();

	$('#tambahPeriode').click(function(){
		$('#btnAddPeriod').attr('disabled', false);
	});

	//Add Period Button
	$('#formAddPeriod').submit(function() {
		$('#btnAddPeriod').attr('disabled', true);
		$.ajax({
			url: "php/period.php?f=add",
			type: "post",
			data: $(this).serialize(),
			success: function(result) {
			        $('#addPeriod').modal('hide');
				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
			        //$('#txtData').empty();
				//getData();
			},
			error: function(result) {
				alert('Tambah periode tidak berhasil!');
			}
		});
		// return false to cancel the form post
		// since javascript will perform it with ajax
		return false;
	});

	$('#formAddSession').submit(function() {
		$('#addButtonSession'+items.id).attr('disabled', true);
		$.ajax({
			url: "php/session.php?f=add",
			type: "post",
			data: $(this).serialize(),
			success: function(result) {
				//$('#sessionT'+items.id).empty();
			       	$('#addSession').modal('hide');
				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
				/*getSessionData(items.id, items.name, items.count);
				if(items.count == 0)
				{
					$('.session',clone).attr('style','color:red;');
					$('.period-wrapper',clone).attr('style','background:#F0F0F0;padding:5px;color:red;');
					$('.hapusPeriod',clone).attr('disabled', true).removeAttr('href').removeAttr('data-confirm', '');
					$('#tambahKompetensi'+items.id).attr('disabled', false);
				        $('#addSession'+items.id).modal('hide');
				       	$('body').removeClass('modal-open');
					$('.modal-backdrop').remove();
				}*/
			},
			error: function(result) {
				alert('Tambah sesi tidak berhasil!');
			}
		});
		// return false to cancel the form post
		// since javascript will perform it with ajax
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
					$(".periodList").append("<option value='"+items.id+"'>"+items.name+"</option>");
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

function getCompetencyList(str)
{
	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=get_competent&id='+str,
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data){
				$.each(data.data, function (i, items) {
					body = $("body").find(".editCompetencyForm[data-id='"+str+"']");
					template = $("#competencyForm").find('.txtCompetencyForm');
	                	        var c = template.clone().removeAttr('id').removeClass('hidden').addClass("competencyList");
					$('.competencyCheckbox',c).attr('id', 'competentCheckbox'+str+items.competent_id).attr('value',items.competent_id);
					$('.competencyName',c).text(items.competent_name);
					$('.competencyTextbox',c).attr('disabled', 'disabled').attr('value',items.weight).attr('id', 'competentTextbox'+str+items.competent_id);
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
				});
			}
		}
	});
}

function getCompetencyDescList(str)
{

	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=get_competent&id='+str,
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data)
			{
				$.each(data.data, function (i, items) {					
					body = $("body").find(".kompetensiDesc[data-id='"+str+"']");
					template = $("#competencyDesc").find('.txtCompetencyDesc');
	        	    var c = template.clone().removeAttr('id').removeClass('hidden').addClass("competencyDescList");

					$('.competencyName',c).text(items.competent_name);
					$('.competencyWeight',c).text(items.weight);

					/*$('.deleteCompetencyForm',c).attr('id','deleteCompetentForm'+str+items.competent_id);
					$('.hapusKompetensi',c).('id','hapusKompetensi'+str+items.competent_id).attr('data-target','#deleteCompetentForm'+str+items.competent_id);
					$('.formDeleteCompetency',c).attr('id','formDeleteCompetent'+str+items.competent_id);
					$('.competentID',c).attr('value',items.competent_id);*/

					body.append(c);

					/*$('#formDeleteCompetent'+str+items.competent_id).submit(function() {
						$.ajax({
							url: "php/competent.php?f=delete",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#competentT'+code).empty();
						        $('#hapusKompetensi'+code+items.competent_id).modal('hide');
						        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
							},
							error: function(result) {
								alert('Delete kompetensi tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});*/
				});
			}
		}
	});
}

function getCompetentData(str, name, count, code)
{

	$.ajax({
		type: 'GET',
		url: 'php/subject.php?f=get_data&id='+str,
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data)
			{
				$.each(data.data, function (i, items) {
					body = $("body").find(".kompetensiTemplate[data-id='"+code+"']");
					template = $("#kompetensiTemplate").find('.txtCompetent');
					var c = template.clone().removeAttr('id').removeClass('hidden').addClass("dataCompetent");
					$('.showDescription',c).attr('id','showDescription'+code);
					$('.deskripsiKompetensi',c).attr('data-target','#showDescription'+code);
					$('.kompetensiDesc',c).attr("data-id", str);
					$('.periodID',c).attr('value',str);
					$('.pDesc',c).text(str+' - '+name);
	
					$('.subjectDesc',c).text(items.subject_id+' - '+items.subject_name);
					$('.addCompetency',c).attr('id','addCompetent'+code);
					$('.tambahKompetensi',c).attr('id', 'tambahKompetensi'+code).attr('data-target','#addCompetent'+code);
					$('.editCompetency',c).attr('id','editCompetent'+code);
					$('.ubahKompetensi',c).attr('id', 'ubahKompetensi'+str).attr('data-target','#editCompetent'+code);
					$('.tambahKompetensi',c).attr('id', 'tambahKompetensi'+code);
					$('.editCompetencyForm',c).attr("data-id", code);
					$('.formEditCompetency',c).attr('id','formEditCompetent'+code);
					$('.formAddCompetency',c).attr('id','formAddCompetent'+code);

					body.append(c);
					getCompetencyList(str);	
					getCompetencyDescList(str);

					$('#formAddCompetent'+code).submit(function() {
						$.ajax({
							url: "php/competent.php?f=add",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#kompetensiT'+code).empty();
						        $('#addCompetent'+code).modal('hide');
								$('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								getCompetentData(str, name, count, code);
							},
							error: function(result) {
								alert('Tambah kompetensi tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});
		
					$('#formEditCompetent'+code).submit(function() {
						$.ajax({
							url: "php/competent.php?f=update",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#kompetensiT'+code).empty();
					        	$('#editCompetent'+code).modal('hide');
					        	$('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								getCompetentData(str, name, count, code);
							},
							error: function(result) {
								alert('Ubah kompetensi tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});
				});
			}
			else
			{
				body = $("body").find(".kompetensiTemplate[data-id='"+code+"']");
				template = $("#kompetensiTemplate").find('.txtCompetent');
       				var c = template.clone().removeAttr('id').removeClass('hidden').addClass("dataCompetent");
				$('.showDescription',c).attr('id','showDescription'+code);
				$('.deskripsiKompetensi',c).attr('data-target','#showDescription'+code);
				$('.kompetensiDesc',c).attr("data-id", code);
				$('.periodID',c).attr('value',str);
				$('.pDesc',c).text(str+' - '+name);

				$('.addCompetency',c).attr('id','addCompetent'+code);
				$('.tambahKompetensi',c).attr('id', 'tambahKompetensi'+code).attr('data-target','#addCompetent'+code);
				$('.ubahKompetensi',c).attr('id', 'ubahKompetensi'+code);
				$('.competencyForm',c).attr("data-id", code);
				$('.formAddCompetency',c).attr('id','formAddCompetent'+code);
				$('.formEditCompetency',c).attr('id','formEditCompetent'+code);
				$('.kompetensiDesc',c).attr('class', 'col-md-12').text('Kompetensi belum diatur sampai saat ini');
				body.append(c);

				$('#ubahKompetensi'+code).attr('disabled', true);
				if(count == 0)
				{
					$('#tambahKompetensi'+code).attr('disabled', true);
				}

				$('#formAddCompetent'+code).submit(function() {
					$.ajax({
						url: "php/competent.php?f=add",
						type: "post",
						data: $(this).serialize(),
						success: function(result) {
							$('#kompetensiT'+code).empty();
					        $('#addCompetent'+code).modal('hide');
					        $('body').removeClass('modal-open');
							$('.modal-backdrop').remove();
							getCompetentData(str, name, count, code);
						},
						error: function(result) {
							alert('Tambah kompetensi tidak berhasil!');
						}
					});
					// return false to cancel the form post
					// since javascript will perform it with ajax
					return false;
				});
			}
		}
	});
}

function getCompetentData(str, name, count, code)
{

	$.ajax({
		type: 'GET',
		url: 'php/competent.php?f=get_data&id='+str,
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data)
			{
				$.each(data.data, function (i, items) {
					body = $("body").find(".kompetensiTemplate[data-id='"+code+"']");
					template = $("#kompetensiTemplate").find('.txtCompetent');
					var c = template.clone().removeAttr('id').removeClass('hidden').addClass("dataCompetent");
					$('.showDescription',c).attr('id','showDescription'+code);
					$('.deskripsiKompetensi',c).attr('data-target','#showDescription'+code);
					$('.kompetensiDesc',c).attr("data-id", str);
					$('.periodID',c).attr('value',str);
					$('.pDesc',c).text(str+' - '+name);
	
					$('.subjectDesc',c).text(items.subject_id+' - '+items.subject_name);
					$('.addCompetency',c).attr('id','addCompetent'+code);
					$('.tambahKompetensi',c).attr('id', 'tambahKompetensi'+code).attr('data-target','#addCompetent'+code);
					$('.editCompetency',c).attr('id','editCompetent'+code);
					$('.ubahKompetensi',c).attr('id', 'ubahKompetensi'+str).attr('data-target','#editCompetent'+code);
					$('.tambahKompetensi',c).attr('id', 'tambahKompetensi'+code);
					$('.editCompetencyForm',c).attr("data-id", code);
					$('.formEditCompetency',c).attr('id','formEditCompetent'+code);
					$('.formAddCompetency',c).attr('id','formAddCompetent'+code);

					body.append(c);
					getCompetencyList(str);	
					getCompetencyDescList(str);

					$('#formAddCompetent'+code).submit(function() {
						$.ajax({
							url: "php/competent.php?f=add",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#kompetensiT'+code).empty();
						        $('#addCompetent'+code).modal('hide');
								$('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								getCompetentData(str, name, count, code);
							},
							error: function(result) {
								alert('Tambah kompetensi tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});
		
					$('#formEditCompetent'+code).submit(function() {
						$.ajax({
							url: "php/competent.php?f=update",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#kompetensiT'+code).empty();
					        	$('#editCompetent'+code).modal('hide');
					        	$('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								getCompetentData(str, name, count, code);
							},
							error: function(result) {
								alert('Ubah kompetensi tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});
				});
			}
			else
			{
				body = $("body").find(".kompetensiTemplate[data-id='"+code+"']");
				template = $("#kompetensiTemplate").find('.txtCompetent');
       				var c = template.clone().removeAttr('id').removeClass('hidden').addClass("dataCompetent");
				$('.showDescription',c).attr('id','showDescription'+code);
				$('.deskripsiKompetensi',c).attr('data-target','#showDescription'+code);
				$('.kompetensiDesc',c).attr("data-id", code);
				$('.periodID',c).attr('value',str);
				$('.pDesc',c).text(str+' - '+name);

				$('.addCompetency',c).attr('id','addCompetent'+code);
				$('.tambahKompetensi',c).attr('id', 'tambahKompetensi'+code).attr('data-target','#addCompetent'+code);
				$('.ubahKompetensi',c).attr('id', 'ubahKompetensi'+code);
				$('.competencyForm',c).attr("data-id", code);
				$('.formAddCompetency',c).attr('id','formAddCompetent'+code);
				$('.formEditCompetency',c).attr('id','formEditCompetent'+code);
				$('.kompetensiDesc',c).attr('class', 'col-md-12').text('Kompetensi belum diatur sampai saat ini');
				body.append(c);

				$('#ubahKompetensi'+code).attr('disabled', true);
				if(count == 0)
				{
					$('#tambahKompetensi'+code).attr('disabled', true);
				}

				$('#formAddCompetent'+code).submit(function() {
					$.ajax({
						url: "php/competent.php?f=add",
						type: "post",
						data: $(this).serialize(),
						success: function(result) {
							$('#kompetensiT'+code).empty();
					        $('#addCompetent'+code).modal('hide');
					        $('body').removeClass('modal-open');
							$('.modal-backdrop').remove();
							getCompetentData(str, name, count, code);
						},
						error: function(result) {
							alert('Tambah kompetensi tidak berhasil!');
						}
					});
					// return false to cancel the form post
					// since javascript will perform it with ajax
					return false;
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
			if(data){
				$.each(data.data, function (i, items) {
					body = $("body").find(".stationTemplate[data-id='"+code+"']");
					template = $("#stationTemplate").find('.txtStation');
	                var c = template.clone().removeAttr('id').removeClass('hidden').addClass("dataStation");
					$('.text_transact_id',c).attr('value',items.id);
					$('.jadwalPengujiModal',c).attr("id", "jadwalPengujiModal"+code+items.id);

					$('.deleteStationForm',c).attr('id','hapusStation'+code+items.id);
					$('.hapusStation',c).attr('data-target','#hapusStation'+code+items.id);
					$('.formDeleteStation',c).attr('id','formDeleteStation'+code+items.id);
					$('.idStationClass',c).attr('value',items.transact_station_id);

					if(items.lecturer_name)
					{
						$('.jadwalPenguji',c).text(items.lecturer_name).attr('data-target','#jadwalPengujiModal'+code+items.id);
					}
					else
					{
						$('.jadwalPenguji',c).text('Penguji belum dijadwalkan').attr('data-target','#jadwalPengujiModal'+code+items.id);
					}
					$('.formAssignLecturer',c).attr('id','formAssignLecturer'+code+items.id);

					$('.stationname',c).text('Station '+items.station_name);
					body.append(c);

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
							url: "lecturer.php?f=add",
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
					$('.locationname',c).text(items.location_name);
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

function getSessionData(str, name, count)
{

	$.ajax({
		type: 'GET',
		url: 'php/session.php?f=get_data&pid='+str,
		async: false,
		dataType: 'json',
		success: function (data) {

			if(data){
				$.each(data.data, function (i, items) {
					body = $("body").find(".sessionTemplate[data-id='"+str+"']");
					template = $("#sessionTemplate").find('.txtSession');
			                var c = template.clone().removeAttr('id').removeClass('hidden').addClass("dataSession");

					$('.txtSession',c).attr('data-id',items.id);
					$('.editSessionForm',c).attr('id','ubahSession'+items.id);
					$('.editSession',c).attr('data-target','#ubahSession'+items.id).text(items.name);

					$('.deleteSessionForm',c).attr('id','hapusSession'+items.id);
					$('.hapusSession',c).attr('data-target','#hapusSession'+items.id);
					$('.formDeleteSession',c).attr('id','formDeleteSession'+items.id);
					$('.idSessionClass',c).attr('value',items.id);

					$('.formEditSession',c).attr('id','formEditSession'+items.id);
					$('.editSessionId',c).attr('value',items.id);
					$('.editSessionNameField',c).attr('value',items.name);
					$('.editTimeStartField',c).attr('value',items.time_start);
					$('.editTimeEndField',c).attr('value',items.time_end);

					$('.locationTemplate',c).attr("data-id", items.id);
					$('.locationTemplate',c).attr("id", "locationT"+items.id);
					$('.location',c).attr('id','location'+items.id);

					$('.sessionid',c).text(items.id);
					$('.time',c).text(items.time_start+' s/d '+items.time_end);
					body.append(c);
					getLocationData(items.id);

					$('.kompetensiTemplate',c).attr("data-id", items.id).attr("id", "kompetensiT"+items.id);
					getCompetentData(items.id, items.name, count, items.id);

					$('#location'+items.id).click(function(){
						showhide("locationT"+items.id);
					});

					$('#formDeleteSession'+items.id).submit(function() {
						$.ajax({
							url: "php/session.php?f=delete",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#sessionT'+items.period_id).empty();
								getSessionData(str,name, count);
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
								$('#sessionT'+items.period_id).empty();
								getSessionData(str,name, count);
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
				});
			}
		}
	});
}

function getData()
{
	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=count_period',
		async: false,
		dataType: 'json',
		success: function (data) {
			var body = $('#txtData');
			var template = $('#template');

			if(data)
			{
				$.each(data.data, function (i, items) {
        	        	        var c = template.clone().removeAttr('id').removeClass('hidden');
					var clone = c;
					$('.period-wrapper',clone).attr('style','background:#F0F0F0;padding:5px;');
	
					$('.sessionTemplate',clone).attr("data-id", items.id).attr("id", "sessionT"+items.id);
					$('.session',clone).attr('id','session'+items.id);

					$('.editPeriodForm',clone).attr('id','ubahPeriode'+items.id);
					$('.editPeriod',clone).attr('data-target','#ubahPeriode'+items.id).text(items.name);

					$('.deletePeriodForm',clone).attr('id','hapusPeriode'+items.id);
					$('.hapusPeriod',clone).attr('data-target','#hapusPeriode'+items.id);
					$('.formDeletePeriod',clone).attr('id','formDeletePeriod'+items.id);

					$('.formEditPeriod',clone).attr('id','formEditPeriod'+items.id);
					$('.editPeriodId',clone).attr('value',items.id);
					$('.editPeriodNameField',clone).attr('value',items.name);
					$('.editPeriodDateStartField',clone).attr('value',items.date_start);
					$('.editPeriodDateEndField',clone).attr('value',items.date_end);

					$('.pDesc',clone).text(items.id+' - '+items.name);
					$('.periodID',clone).attr('value',items.id);
					$('.periodIDClass',clone).attr('value',items.id);
					$('.addSession',clone).attr('id','addSession'+items.id);
					$('.submitPeriod',clone).attr('id','submitPeriod'+items.id);
					$('.tambahSesi',clone).attr('id','tambahSesi'+items.id).attr('data-target','#addSession'+items.id);
					$('.addButtonSession').attr('id','addButtonSession'+items.id);
					$('.formAddSession',clone).attr('id','formAddSession'+items.id);

					$('.subjectList',clone).attr('id','subjectList'+items.id);

					if(items.count != 0)
					{
						$('.session',clone).attr('style','color:red;');
						$('.period-wrapper',clone).attr('style','background:#F0F0F0;padding:5px;color:red;');
						$('.hapusPeriod',clone).attr('disabled', true).removeAttr('href').removeAttr('data-confirm', '');
					}

					$('.id',clone).text(items.id);
					$('.date',clone).text(items.date_start+' s/d '+items.date_end);
					body.append(clone);

					$('#tambahSesi'+items.id).click(function(){
						$('#addButtonSession'+items.id).attr('disabled', false);
					});

					getSubjectDropdown("#subjectList"+items.id);
					getSessionData(items.id, items.name, items.count);

					$('#session'+items.id).click(function(){
						showhide("sessionT"+items.id);
						showhide("tambahSesi"+items.id);
					});

					$('#formEditPeriod'+items.id).submit(function() {
						$.ajax({
							url: "php/period.php?f=update",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#txtData').empty();
								getData();
						        $('#ubahPeriode'+items.id).modal('hide');
						        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
							},
							error: function(result) {
								alert('Ubah periode tidak berhasil!');
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
								$('#txtData').empty();
								getData();
						        $('#hapusPeriode'+items.id).modal('hide');
						        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
							},
							error: function(result) {
								alert('Delete periode tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});

					$('#formAddSession'+items.id).submit(function() {
						$('#addButtonSession'+items.id).attr('disabled', true);
						$.ajax({
							url: "php/session.php?f=add",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#sessionT'+items.id).empty();
						        	$('#addSession'+items.id).modal('hide');
								getSessionData(items.id, items.name, items.count);
								if(items.count == 0)
								{
									$('.session',clone).attr('style','color:red;');
									$('.period-wrapper',clone).attr('style','background:#F0F0F0;padding:5px;color:red;');
									$('.hapusPeriod',clone).attr('disabled', true).removeAttr('href').removeAttr('data-confirm', '');
									$('#tambahKompetensi'+items.id).attr('disabled', false);
								        $('#addSession'+items.id).modal('hide');
							        	$('body').removeClass('modal-open');
									$('.modal-backdrop').remove();
								}
							},
							error: function(result) {
								alert('Tambah sesi tidak berhasil!');
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
