$(document).ready(function() {
	setInterval(getData(),9001000);
});

function getData()
{
	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=monitoring',
		async: false,
		dataType: 'json',
		success: function (data) {
			var body = $('#txtData');
			var template = $('.template');

			if(data)
			{
				$.each(data.data, function (i, items) {
		        	var c = template.clone().removeClass('hidden').addClass('row');
					var clone = c;
					
					$('.stationid',c).text(items.station_id);
					$('.studentid',c).text(items.total_student);
					$('.graded',c).text(items.graded);
					if(items.graded == items.total_student)
					{
						$('.row').attr('style','color:green');
					}
					body.append(c);
				});
			}
		}
	});
}