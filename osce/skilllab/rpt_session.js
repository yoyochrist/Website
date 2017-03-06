$(document).ready(function() {
	
	getSubjectDropdown();
	
	$("form").submit(function(e){
		
		e.preventDefault(e);
		
		var item = $("#sesi").val();
		gotoURL(item);
		
	});
	
	
	function gotoURL(sesi) {
		var newURL = "reports/session.php?id=" + sesi;
		window.open(newURL, "_blank");
	}
	
	
	function getSubjectDropdown(){
		$.ajax({
			type: 'GET',
			url: 'php/rpt_session.php',
			async: false,
			dataType: 'json',
			success: function (data) {
				if(data){
					$.each(data.data, function (i, items) {
						$("#sesi").append("<option value='"+items.id+"'>"+items.name+"</option>");
					});
				}
			}
		});
	}
	
});