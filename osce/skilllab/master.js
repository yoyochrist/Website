$(document).ready(function() {
	getLocationData();
	getStationData();
	getLecturerData();
	getStudentData();
	getCompetentData();
	getSubjectData();

	$('.lokasi').hide();
	$('.station').hide();
	$('.mahasiswa').hide();
	$('.dosen').hide();
	$('.subjek').hide();
	$('.kompetensi').hide();
	$("select#pilihan").change(function () {
		var selections;

		$(this).children(':selected').each(function (index, option) {
			selections = (option.value);
		});

		if(selections == 'lokasi')
		{
			$('.station').hide();
			$('.mahasiswa').hide();
			$('.dosen').hide();
			$('.kompetensi').hide();
			$('.subjek').hide();
		}
		else if(selections == 'station')
		{
			$('.lokasi').hide();
			$('.mahasiswa').hide();
			$('.dosen').hide();
			$('.kompetensi').hide();
			$('.subjek').hide();
		}
		else if(selections == 'mahasiswa')
		{
			$('.lokasi').hide();
			$('.station').hide();
			$('.dosen').hide();
			$('.kompetensi').hide();
			$('.subjek').hide();
		}
		else if(selections == 'dosen')
		{
			$('.lokasi').hide();
			$('.station').hide();
			$('.mahasiswa').hide();
			$('.kompetensi').hide();
			$('.subjek').hide();
		}
		else if(selections == 'kompetensi')
		{
			$('.lokasi').hide();
			$('.station').hide();
			$('.mahasiswa').hide();
			$('.dosen').hide();
			$('.subjek').hide();
		}
		else if(selections == 'subjek')
		{
			$('.lokasi').hide();
			$('.station').hide();
			$('.mahasiswa').hide();
			$('.dosen').hide();
			$('.kompetensi').hide();
		}
		else
		{
			$('.lokasi').hide();
			$('.station').hide();
			$('.mahasiswa').hide();
			$('.dosen').hide();
			$('.kompetensi').hide();
			$('.subjek').hide();
		}
		$("."+selections).show();
	});

	$('.formAddStudent').submit(function() {
		$.ajax({
			url: "php/student.php?f=add_master",
			type: "post",
			data: $(this).serialize(),
			success: function(result) {
			        $('.dataConfirmAddStudentModal').modal('hide');
			        $('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
				$('.mahasiswaRow').remove();
				getStudentData();
			},
			error: function(result) {
				alert('Tambah mahasiswa tidak berhasil!');
			}
		});
		// return false to cancel the form post
		// since javascript will perform it with ajax
		return false;
	});

	$('.formAddSubject').submit(function() {
		$.ajax({
			url: "php/subject.php?f=add_master",
			type: "post",
			data: $(this).serialize(),
			success: function(result) {
			        $('.dataConfirmAddSubjectModal').modal('hide');
			        $('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
				$('.subjekRow').remove();
				getSubjectData();
			},
			error: function(result) {
				alert('Tambah subjek tidak berhasil!');
			}
		});
		// return false to cancel the form post
		// since javascript will perform it with ajax
		return false;
	});

	$('.formAddCompetent').submit(function() {
		$.ajax({
			url: "php/competent.php?f=add_master",
			type: "post",
			data: $(this).serialize(),
			success: function(result) {
			        $('#dataConfirmAddCompetentModal').modal('hide');
			        $('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
				$('.kompetensiRow').remove();
				getCompetentData();
			},
			error: function(result) {
				alert('Tambah kompeten tidak berhasil!');
			}
		});
		// return false to cancel the form post
		// since javascript will perform it with ajax
		return false;
	});

	$('.formAddLocation').submit(function() {
		$.ajax({
			url: "php/location.php?f=add_master",
			type: "post",
			data: $(this).serialize(),
			success: function(result) {
			        $('#dataConfirmAddLocationModal').modal('hide');
			        $('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
				$('.locationRow').remove();
				getLocationData();
			},
			error: function(result) {
				alert('Tambah lokasi tidak berhasil!');
			}
		});
		// return false to cancel the form post
		// since javascript will perform it with ajax
		return false;
	});


	$('.formAddStation').submit(function() {
		$.ajax({
			url: "php/station.php?f=add_master",
			type: "post",
			data: $(this).serialize(),
			success: function(result) {
			        $('.dataConfirmAddStationModal').modal('hide');
			        $('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
				$('.stationRow').remove();
				getStationData();
			},
			error: function(result) {
				alert('Tambah station tidak berhasil!');
			}
		});
		// return false to cancel the form post
		// since javascript will perform it with ajax
		return false;
	});

	$('.formAddLecturer').submit(function() {
		$.ajax({
			url: "php/lecturer.php?f=add_master",
			type: "post",
			data: $(this).serialize(),
			success: function(result) {
			        $('.dataConfirmAddLecturerModal').modal('hide');
			        $('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
				$('.dosenRow').remove();
				getLecturerData();
			},
			error: function(result) {
				alert('Tambah dosen tidak berhasil!');
			}
		});
		// return false to cancel the form post
		// since javascript will perform it with ajax
		return false;
	});
});

function getSubjectData()
{
	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=data&id=subject',
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data)
			{
				$.each(data.data, function (i, items) {
					var body = $('#txtSubjek');
					var template = $('.templateSubjek');

        	        	        var c = template.clone().removeClass('templateSubjek').removeClass('hide').addClass('subjekRow');
					var clone = c;

					$('.subjekName', clone).text(items.name);
					$('.dataConfirmDeleteSubjectModal',clone).attr('id','dataConfirmDeleteSubjectModal'+items.id);
					$('.formDeleteSubject',clone).attr('id','formDeleteSubject'+items.id);
					$('.hapusSubjek', clone).attr('data-target','#dataConfirmDeleteSubjectModal'+items.id);
					$('.idSubjectDeleteClass',clone).attr('value',items.id);

					$('.dataConfirmEditSubjectModal',clone).attr('id','dataConfirmEditSubjectModal'+items.id);
					$('.formEditSubject',clone).attr('id','formEditSubject'+items.id);
					$('.editSubjek', clone).text(items.id).attr('data-target','#dataConfirmEditSubjectModal'+items.id);
					$('.idSubjectClass', clone).attr('value',items.id)
					$('.nameSubjectClass',clone).attr('value',items.name);

					body.append(clone);

					$('#formEditSubject'+items.id).submit(function() {
						$.ajax({
							url: "php/subject.php?f=edit_master",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
							        $('#dataConfirmEditSubjectModal'+items.id).modal('hide');
							        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								$('.subjekRow').remove();
								getSubjectData();
							},
							error: function(result) {
								alert('Ubah subjek tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});

					$('#formDeleteSubject'+items.id).submit(function() {
						$.ajax({
							url: "php/subject.php?f=delete_master",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
							        $('#dataConfirmDeleteSubjectModal'+items.id).modal('hide');
							        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								$('.subjekRow').remove();
								getSubjectData();
							},
							error: function(result) {
								alert('Hapus subjek tidak berhasil!');
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

function getCompetentData()
{
	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=data&id=competent',
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data)
			{
				$.each(data.data, function (i, items) {
					var body = $('#txtKompetensi');
					var template = $('.templateKompetensi');

        	        	        var c = template.clone().removeClass('templateKompetensi').removeClass('hide').addClass('kompetensiRow');
					var clone = c;

					$('.kompetensiName', clone).text(items.name);
					$('.dataConfirmDeleteCompetentModal',clone).attr('id','dataConfirmDeleteCompetentModal'+items.id);
					$('.formDeleteCompetent',clone).attr('id','formDeleteCompetent'+items.id);
					$('.hapusKompetensi', clone).attr('data-target','#dataConfirmDeleteCompetentModal'+items.id);
					$('.idCompetentDeleteClass',clone).attr('value',items.id);

					$('.dataConfirmEditCompetentModal',clone).attr('id','dataConfirmEditCompetentModal'+items.id);
					$('.dataConfirmDeleteCompetentModal',clone).attr('id','dataConfirmDeleteCompetentModal'+items.id);
					$('.formEditCompetent',clone).attr('id','formEditCompetent'+items.id);
					$('.formDeleteCompetent',clone).attr('id','formDeleteCompetent'+items.id);
					$('.editKompetensi', clone).text(items.id).attr('data-target','#dataConfirmEditCompetentModal'+items.id);
					$('.idCompetentClass', clone).attr('value',items.id)
					$('.nameCompetentClass',clone).attr('value',items.name);
					$('.hapusKompetensi',clone).attr('data-target','#dataConfirmDeleteCompetentModal'+items.id);
					body.append(clone);

					$('#formEditCompetent'+items.id).submit(function() {
						$.ajax({
							url: "php/competent.php?f=edit_master",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
							        $('#dataConfirmEditCompetentModal'+items.id).modal('hide');
							        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								$('.kompetensiRow').remove();
								getCompetentData();
							},
							error: function(result) {
								alert('Ubah kompetensi tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});

					$('#formDeleteCompetent'+items.id).submit(function() {
						$.ajax({
							url: "php/competent.php?f=delete_master",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
							        $('#dataConfirmDeleteCompetentModal'+items.id).modal('hide');
							        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								$('.kompetensiRow').remove();
								getCompetentData();
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

function getLocationData()
{
	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=data&id=location',
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data)
			{
				$.each(data.data, function (i, items) {
					var body = $('#txtLocation');
					var template = $('.templateLocation');

        	        	        var c = template.clone().removeClass('templateLocation').removeClass('hide').addClass('locationRow');
					var clone = c;

					$('.locationName', clone).text(items.name);
					$('.dataConfirmEditLocationModal',clone).attr('id','dataConfirmEditLocationModal'+items.id);
					$('.dataConfirmDeleteLocationModal',clone).attr('id','dataConfirmDeleteLocationModal'+items.id);
					$('.formEditLocation',clone).attr('id','formEditLocation'+items.id);
					$('.formDeleteLocation',clone).attr('id','formDeleteLocation'+items.id);
					$('.editLokasi', clone).text(items.id).attr('data-target','#dataConfirmEditLocationModal'+items.id);
					$('.idLocationClass', clone).attr('value',items.id)
					$('.nameLocationClass',clone).attr('value',items.name);
					$('.idDeleteClass',clone).attr('value',items.id);
					$('.hapusLokasi',clone).attr('data-target','#dataConfirmDeleteLocationModal'+items.id);
					body.append(clone);

					$('#formEditLocation'+items.id).submit(function() {
						$.ajax({
							url: "php/location.php?f=edit_master",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
							        $('#dataConfirmEditLocationModal'+items.id).modal('hide');
							        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								$('.locationRow').remove();
								getLocationData();
							},
							error: function(result) {
								alert('Ubah lokasi tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});

					$('#formDeleteLocation'+items.id).submit(function() {
						$.ajax({
							url: "php/location.php?f=delete_master",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
							        $('#dataConfirmDeleteLocationModal'+items.id).modal('hide');
							        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								$('.locationRow').remove();
								getLocationData();
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

function getStationData()
{
	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=data&id=station',
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data)
			{
				$.each(data.data, function (i, items) {
					var body = $('#txtStation');
					var template = $('.templateStation');

        	        	        var c = template.clone().removeClass('templateStation').removeClass('hide').addClass('stationRow');
					var clone = c;

					$('.stationName', clone).text('Station '+items.name);
					$('.dataConfirmEditStationModal',clone).attr('id','dataConfirmEditStationModal'+items.id);
					$('.dataConfirmDeleteStationModal',clone).attr('id','dataConfirmDeleteStationModal'+items.id);
					$('.formEditStation',clone).attr('id','formEditStation'+items.id);
					$('.formDeleteStation',clone).attr('id','formDeleteStation'+items.id);
					$('.editStation', clone).text(items.id).attr('data-target','#dataConfirmEditStationModal'+items.id);
					$('.hapusStation',clone).attr('data-target','#dataConfirmDeleteStationModal'+items.id);
					$('.idStationClass', clone).attr('value',items.id);
					$('.nameStationClass',clone).attr('value',items.name);
					body.append(clone);
	
					$('#formEditStation'+items.id).submit(function() {
						$.ajax({
							url: "php/station.php?f=edit_master",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
							        $('#dataConfirmEditStationModal'+items.id).modal('hide');
							        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								$('.stationRow').remove();
								getStationData();
							},
							error: function(result) {
								alert('Ubah station tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});

					$('#formDeleteStation'+items.id).submit(function() {
						$.ajax({
							url: "php/station.php?f=delete_master",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
							        $('#dataConfirmDeleteStationModal'+items.id).modal('hide');
							        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								$('.stationRow').remove();
								getStationData();
							},
							error: function(result) {
								alert('Hapus station tidak berhasil!');
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

function getLecturerData()
{
	$.ajax({
		type: 'GET',
		url: 'php/lecturer.php?f=get_data',
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data)
			{
				$.each(data.data, function (i, items) {
					var body = $('#txtDosen');
					var template = $('.templateDosen');

        	        	        var c = template.clone().removeClass('templateDosen').removeClass('hide').addClass('dosenRow');
					var clone = c;

					$('.dosenName', clone).text(items.name);
					$('.dataConfirmEditLecturerModal',clone).attr('id','dataConfirmEditLecturerModal'+items.id);
					$('.dataConfirmDeleteLecturerModal',clone).attr('id','dataConfirmDeleteLecturerModal'+items.id);
					$('.formEditLecturer',clone).attr('id','formEditLecturer'+items.id);
					$('.formDeleteLecturer',clone).attr('id','formDeleteLecturer'+items.id);
					$('.editDosen', clone).text(items.id).attr('data-target','#dataConfirmEditLecturerModal'+items.id);
					$('.idLecturerClass', clone).attr('value',items.id);
					$('.nameLecturerClass',clone).attr('value',items.name);
					$('.hapusDosen',clone).attr('data-target','#dataConfirmDeleteLecturerModal'+items.id);
					body.append(clone);

					$('#formEditLecturer'+items.id).submit(function() {
						$.ajax({
							url: "php/lecturer.php?f=edit_master",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
							        $('#dataConfirmEditLecturerModal'+items.id).modal('hide');
							        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								$('.dosenRow').remove();
								getLecturerData();
							},
							error: function(result) {
								alert('Ubah dosen tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});

					$('#formDeleteLecturer'+items.id).submit(function() {
						$.ajax({
							url: "php/lecturer.php?f=delete_master",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
							        $('#dataConfirmDeleteLecturerModal'+items.id).modal('hide');
							        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								$('.dosenRow').remove();
								getLecturerData();
							},
							error: function(result) {
								alert('Hapus dosen tidak berhasil!');
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

function getStudentData()
{
	$.ajax({
		type: 'GET',
		url: 'php/student.php?f=get_data',
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data)
			{
				$.each(data.data, function (i, items) {
					var body = $('#txtMahasiswa');
					var template = $('.templateMahasiswa');
        		                var c = template.clone().removeClass('templateMahasiswa').removeClass('hide').addClass('mahasiswaRow');
					var clone = c;

					$('.mahasiswaName', clone).text(items.name);
					$('.dataConfirmEditStudentModal',clone).attr('id','dataConfirmEditStudentModal'+items.id);
					$('.dataConfirmDeleteStudentModal',clone).attr('id','dataConfirmDeleteStudentModal'+items.id);
					$('.formEditStudent',clone).attr('id','formEditStudent'+items.id);
					$('.formDeleteStudent',clone).attr('id','formDeleteStudent'+items.id);
					$('.editMahasiswa', clone).text(items.id).attr('data-target','#dataConfirmEditStudentModal'+items.id);
					$('.idStudentClass', clone).attr('value',items.id)
					$('.nameStudentClass',clone).attr('value',items.name);
					$('.hapusMahasiswa',clone).attr('data-target','#dataConfirmDeleteStudentModal'+items.id);

					body.append(clone);

					$('#formEditStudent'+items.id).submit(function() {
						$.ajax({
							url: "php/student.php?f=update_master",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
							        $('#dataConfirmEditStudentModal'+items.id).modal('hide');
							        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								$('.mahasiswaRow').remove();
								getStudentData();
							},
							error: function(result) {
								alert('Ubah mahasiswa tidak berhasil!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});

					$('#formDeleteStudent'+items.id).submit(function() {
						$.ajax({
							url: "php/student.php?f=delete_master",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
							        $('#dataConfirmDeleteStudentModal'+items.id).modal('hide');
							        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								$('.mahasiswaRow').remove();
								getStudentData();
							},
							error: function(result) {
								alert('Hapus mahasiswa tidak berhasil!');
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
