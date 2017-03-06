$(document).ready(function() {
	$(function() {
		
	$(".btnEditAction").click(function() {
		var id = $("#nim_" + $(this).attr("id")).html();
		$.redirect('index.php?mod=nla', {'student_id': id});
		});
	
	$("#btnLogout").click(function() {
		var url = "logout.php";
		$(location).attr('href',url);
		});
	
	$("#btnReport").click(function() {
		var url = "report.php";
		window.open(url, '_blank');
		});
	
	
	
	}) 	
	
	
	
	
})