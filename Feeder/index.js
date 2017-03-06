$(document).ready(function() {
	getData();
});

function getData()
{
	$.ajax({
		type: 'GET',
		url: 'lib/table.php?f=ListTable',
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
					$('.tableName',clone).text(items.table).attr('href','tabledictionary.php?table='+items.table);
					$('.tableType',clone).text(items.jenis);
					$('.tableDesc',clone).text(items.keterangan);
					body.append(clone);
				});
			}
		}
	});
}

