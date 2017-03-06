$(document).ready(function() {
	$('#closeModal').click(function(){
		$('#uploadCSVButton').attr('disabled', false);
	});

	$('#formCSV').attr('enctype','multipart/form-data');

	//Add Period Button
	/*$('#formCSV').submit(function() {
		$('#uploadCSVButton').attr('disabled', true);
		$.ajax({
			url: "php/csv.php",
			type: "post",
			data: $(this).serialize(),
			success: function(result) {
				alert('Tambah Peserta dengan CSV Berhasil!');
			},
			error: function(result) {
				alert('Tambah Peserta dengan CSV tidak berhasil!');
			}
		});
		// return false to cancel the form post
		// since javascript will perform it with ajax
		return false;
	});*/
});
