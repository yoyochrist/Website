$(document).ready(function() {
	
	
	$("form").submit(function(e){
		
		e.preventDefault(e);
		
		var id = document.forms["form"]["student"].value;
		
		if (id == "") 
        	alert("Anda belum mengisi dengan benar");
		else {
			
			$.ajax({
				type:"POST",
				url: "php/rpt_student.php",
				data: 'student='+id,
				success: function(response){
					if (response==1)
						gotoURL(id);
					else 
						alert('NIM tidak ditemukan!');
				}
				
			});
			
		}
	});
	
	
	
	function gotoURL(id) {
		var newURL = "reports/students.php?id=" + id;
		window.open(newURL, "_blank");
		
	}
	
	
	
	
	
	
	
});