$(document).ready(function() {
	getData();
});

function getData()
{
	$.ajax({
		type: 'GET',
		url: 'php/table.php?f=akademik',
		async: false,
		dataType: 'json',
		success: function (data) {
			var body = $('#txtData');
			var template = $('.template');

			if(data)
			{
				$.each(data.data, function (i, items) {
        		                var c = template.clone().removeClass('template').removeClass('hide').addClass('mahasiswaRow');
					var clone = c;
					$('.periodname',clone).text(items.period_name);
					$('.sessionname',clone).text(items.session_name);
					$('.date',clone).text(items.time_start+' s/d '+items.time_end);
					$('.location',clone).text(items.location_used);
					$('.station',clone).text(items.station_available);

					body.append(clone);
				});
			}
		}
	});
}
