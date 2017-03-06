$(document).ready(function() {
	var tableName = 'pekerjaan';
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
					$('.jobID',clone).text(items.id_pekerjaan);
					$('.jobName',clone).text(items.nm_pekerjaan);
					body.append(clone);
				});
			}
		}
	});
}