$(document).ready(function() {
	$(function() {
		var pos = { my: "center center", at: "top+150", of: window };
		
		$("#doConfirm").dialog({
			autoOpen: false,
			resizeable: false,
      		width: 540,
			modal: true,
			position: pos,
			buttons: {
				"Beri Penilaian ": function() {
          			window.location.href = "index.php?mod=nla";
        		},
				"Batal ": function() {
			  		$(this).dialog( "close" );
					$("#student_id").focus();
				}
		  	}
		});

		$("#doInfo").dialog({
			autoOpen: false,
			resizeable: false,
      		width: 540,
			modal: true,
			position: pos,
			buttons: {
				"Kembali ": function() {
			  		$(this).dialog( "close" );
					$("#student_id").focus();
				}
		  	}
		});
	
	});
	
	$("#btnSubmit").click(function() {
		var ckbox = $('#isFinish');
		if (ckbox.is(':checked')) {    
		 	var url = "index.php?mod=rev";
			$(location).attr('href',url);
		} else {
			var id=$("#student_id").val();
			var action='cek';
			$.ajax({
				type:"POST",
				url: "baca_peserta.php",
				data: 'action='+action+'&student_id='+id,
				success: function(response){
					if (response==1){
						$("#doConfirm").dialog("open");
						$('#body').text('Tunggu...');
						$('#body').load("baca_peserta.php?student_id="+id);
					} else {
						$("#doInfo").dialog("open");
						$('#body2').text('Tunggu...');
						$('#body2').load("baca_peserta.php?student_id="+id);
					}
									
					$("#student_id").val(''); 
					
				}
				
			});
		}
	})

})