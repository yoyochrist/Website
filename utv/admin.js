$(document).ready(function(){
	getDeviceData();
	getURLData();

	$('#addDevice').click(function(){
		$('#btnAddDevice').attr('disabled', false);
	});

	//Add Period Button
	$('#formAddDevice').submit(function() {
		$('#btnAddDevice').attr('disabled', true);
		$.ajax({
			url: "device.php?f=add",
			type: "post",
			data: $(this).serialize(),
			success: function(result) {
			    $('#addDeviceModal').modal('hide');
				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
			    $('#device').empty();
				getDeviceData();
			},
			error: function(result) {
				alert('Add device unsuccessful!');
			}
		});
		// return false to cancel the form post
		// since javascript will perform it with ajax
		return false;
	});
});

function getURLData()
{
	$.ajax({
		type: 'GET',
		url: 'url.php?f=get',
		async: false,
		dataType: 'json',
		success: function (data) {
			var body = $('#url');
			var template = $('#urlTemplate');

			if(data)
			{
				$.each(data.data, function (i, items) {
					var c = template.clone().removeAttr('id').removeClass('hidden');
					var clone = c;
					$('.editURLModal',clone).attr('id','editURLModal'+items.state);

					$('.formEditURL',clone).attr('id','formEditURL'+items.state);
					$('.urlStatus',clone).text(items.state);
					$('.urlText',clone).text(items.url).attr('data-target','#editURLModal'+items.state).text(items.name);
					$('.urlStatusValue',clone).attr('value',items.state);
					$('.urlTextValue',clone).attr('value',items.url);
					
					body.append(clone);

					$('#formEditURL'+items.state).submit(function() {
						$.ajax({
							url: "url.php?f=update",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#url').empty();
								getURLData();
						        $('#editURLModal'+items.id).modal('hide');
						        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
							},
							error: function(result) {
								alert('Change URL unsuccessful!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});
				});
			}
		}
	});
}

function getDeviceData()
{
	$.ajax({
		type: 'GET',
		url: 'device.php?f=get',
		async: false,
		dataType: 'json',
		success: function (data) {
			var body = $('#device');
			var template = $('#deviceTemplate');

			if(data)
			{
				$.each(data.data, function (i, items) {
					var c = template.clone().removeAttr('id').removeClass('hidden');
					var clone = c;
					$('.editDeviceModal',clone).attr('id','editDeviceModal'+items.id);
					$('.formEditDevice',clone).attr('id','formEditDevice'+items.id);
					
					$('.ipAddress',clone).text(items.ipaddress);
					$('.ipAddressText',clone).attr('value',items.ipaddress);
					
					$('.deviceName',clone).text(items.name);
					$('.deviceNameText',clone).attr('value',items.name);
					
					$('.statusSelected',clone).val(items.state);
					$('.idText',clone).attr('value',items.id);
					
					if(items.state == 'on')
					{
						$('.status',clone).text(items.state).attr('data-target','#editDeviceModal'+items.id).attr('style','color:green');
					}
					else
					{
						$('.status',clone).text(items.state).attr('data-target','#editDeviceModal'+items.id).attr('style','color:red');
					}

					$('.deleteDeviceModal',clone).attr('id','deleteDeviceModal'+items.id);
					$('.deleteDevice',clone).attr('data-target','#deleteDeviceModal'+items.id);
					$('.formDeleteDevice',clone).attr('id','formDeleteDevice'+items.id);
					body.append(clone);
					
					$('#formEditDevice'+items.id).submit(function() {
						$.ajax({
							url: "device.php?f=update",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#device').empty();
								getDeviceData();
						        $('#editDeviceModal'+items.id).modal('hide');
						        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
							},
							error: function(result) {
								alert('Change device properties unsuccessful!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});
	
					$('#formDeleteDevice'+items.id).submit(function() {
						$.ajax({
							url: "device.php?f=delete",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#device').empty();
								getDeviceData();
						        $('#deleteDeviceModal'+items.id).modal('hide');
						        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
							},
							error: function(result) {
								alert('Delete device properties unsuccessful!');
							}
						});
						// return false to cancel the form post
						// since javascript will perform it with ajax
						return false;
					});
				});
			}
		}
	});
}