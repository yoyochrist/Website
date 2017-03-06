$(document).ready(function() {
	var tableName = 'agama';
	getData(tableName);
});

function getData(str)
{
	$.ajax({
		type: 'post',
		url: '../lib/table.php?f=GetRecordSetWithoutCondition&table='+str,
		async: false,
		dataType: 'json',
		success: function (data) {
			var body = $('#txtData');
			var template = $('#templateData');

			if(data)
			{
				$.each(data.result, function (i, items) {
		        	var c = template.clone().removeClass('hidden').addClass('tableRow');
					var clone = c;
					$('.religionID',clone).text(items.id_agama);
					$('.religionName',clone).text(items.nm_agama);
					body.append(clone);
				});
			}
		}
	});
}