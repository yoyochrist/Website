$(document).ready(function() {		
	$.ajax({
		type: 'GET',
		url: 'content/table.php?f=data&id=location',
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data){
				$.each(data.data, function (i, items) {
					$(".room").append("<option value='"+items.id+"'>"+items.name+"</option>");
				});
			}
		}
	});
	
	$.ajax({
		type: 'GET',
		url: 'content/table.php?f=data&id=station',
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data){
				$.each(data.data, function (i, items) {
					$(".station").append("<option value='"+items.id+"'>"+items.name+"</option>");
				});
			}
		}
	});
})