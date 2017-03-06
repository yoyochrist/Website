$(document).ready(function(){
	getDropdown();
	getDeviceData();
	getURLData();

	$('#addDevice').click(function(){
		$('#btnAddDevice').attr('disabled', false);
	});

	$('#addURL').click(function(){
		$('#btnAddURL').attr('disabled', false);
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

	//Add Period Button
	$('#formAddURL').submit(function() {
		$('#btnAddURL').attr('disabled', true);
		$.ajax({
			url: "url.php?f=add",
			type: "post",
			data: $(this).serialize(),
			success: function(result) {
			    $('#addURLModal').modal('hide');
				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
			    $('#url').empty();
				getURLData();
			},
			error: function(result) {
				alert('Add URL unsuccessful!');
			}
		});
		// return false to cancel the form post
		// since javascript will perform it with ajax
		return false;
	});
});

function getDropdown()
{
	$.ajax({
		type: 'GET',
		url: 'url.php?f=get',
		async: false,
		dataType: 'json',
		success: function (data) {
			if(data){
				$.each(data.data, function (i, items) {
					$(".urlnumber").append("<option value='"+items.id+"'>"+items.url+"</option>");
					$(".statusSelected").append("<option value='"+items.id+"'>"+items.url+"</option>");
				});
			}
		}
	});
}

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
					$('.editURLModal',clone).attr('id','editURLModal'+items.id);

					$('.formEditURL',clone).attr('id','formEditURL'+items.id);
					$('.urlStatus',clone).text(items.id);
					$('.urlText',clone).text(items.url).attr('data-target','#editURLModal'+items.id).text(items.name);
					$('.urlStatusValue',clone).attr('value',items.id);
					$('.urlTextValue',clone).attr('value',items.url);

					$('.deleteURLModal',clone).attr('id','deleteURLModal'+items.id);
					$('.deleteURL',clone).attr('data-target','#deleteURLModal'+items.id);
					$('.formDeleteURL',clone).attr('id','formDeleteURL'+items.id);					

					body.append(clone);

					$('#formEditURL'+items.id).submit(function() {
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

					$('#formDeleteURL'+items.id).submit(function() {
						$.ajax({
							url: "url.php?f=delete",
							type: "post",
							data: $(this).serialize(),
							success: function(result) {
								$('#url').empty();
								getURLData();
						        $('#deleteURLModal'+items.id).modal('hide');
						        $('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
							},
							error: function(result) {
								alert('Delete URL unsuccessful!');
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
					
					$('.deviceName',clone).text(items.name).attr('data-target','#editDeviceModal'+items.id);
					$('.deviceNameText',clone).attr('value',items.name);
					
					$('.statusSelected',clone).val(items.state);
					$('.idText',clone).attr('value',items.id);
	
					$('.status',clone).text(items.state);
					
					$('.deleteDeviceModal',clone).attr('id','deleteDeviceModal'+items.id);
					$('.deleteDevice',clone).attr('data-target','#deleteDeviceModal'+items.id);
					$('.formDeleteDevice',clone).attr('id','formDeleteDevice'+items.id);

					$('.refreshDevice',clone).click(function(){
						$.ajax({
							type: "POST",
							headers: {
								'Accept': 'application/json',
								'Content-Type': 'text/plain'
							},
							dataType: "json",
							url: 'http:////'+items.ipaddress+'//refresh.php',
							beforeSend: function (request) {
								request.setRequestHeader("Authorization", "Negotiate");
								request.setRequestHeader("Access-Control-Allow-Origin", "*");
								request.setRequestHeader("Access-Control-Allow-Methods", "GET, POST, PATCH, PUT, OPTIONS, DELETE");
								request.setRequestHeader("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, Authorization");
							},
							async: true,
							success: function (data) {
								$('#messageLabel').text('Refresh Browser');
								$('#messageContent').text('Refresh browser on '+items.ipaddress+' is successful');
								$('#message').modal('show');
							},
							error: function (XMLHttpRequest, textStatus, errorThrown) {
								if(XMLHttpRequest.status == 500)
								{
									$('#messageLabel').text('Refresh Browser');
									$('#messageContent').text('Refresh browser on '+items.ipaddress+' is successful');
									$('#message').modal('show');
								}
								else
								{
									$('#messageLabel').text('Refresh Browser');
									$('#messageContent').text('Refresh browser on '+items.ipaddress+' is successful');
									$('#message').modal('show');
								}
							}                
						});
						//$.post('http:////'+items.ipaddress+'//refresh.php', function( data ) {});
					});

					$('.restartDevice',clone).click(function(){
						$.ajax({
							url: 'http:////'+items.ipaddress+'//restart.php',
							beforeSend: function (request) {
								request.setRequestHeader("Authorization", "Negotiate");
								request.setRequestHeader("Access-Control-Allow-Origin", "*");
								request.setRequestHeader("Access-Control-Allow-Methods", "GET, POST, PATCH, PUT, OPTIONS");
								request.setRequestHeader("Access-Control-Allow-Headers", "Origin, Content-Type, X-Auth-Token");
							},
							async: true,
							success: function (data) {
								$('#messageLabel').text('Restart Browser');
								$('#messageContent').text('Restart browser on '+items.ipaddress+' successful');
								$('#message').modal('show');
							},
							error: function (xhr, textStatus, errorMessage) {
								$('#messageLabel').text('Restart Browser');
								$('#messageContent').text('Restart browser on '+items.ipaddress+' successful');
								$('#message').modal('show');
							}                
						});
						/*$.post('http:////'+items.ipaddress+'//restart.php')
							.done(function() {
								$('#messageLabel').text('Restart Browser');
								$('#messageContent').text('Restart browser on '+items.ipaddress+' successful');
								$('#message').modal('show');
							})
							.fail(function() {
								$('#messageLabel').text('Restart Browser');
								$('#messageContent').text('Restart browser on '+items.ipaddress+' failed, the problem maybe from connection or device');
								$('#message').modal('show');
							});*/
					});

					$('.shutdownDevice',clone).click(function(){
						$.ajax({
							url: 'http:////'+items.ipaddress+'//shutdown.php',
							beforeSend: function (request) {
								request.setRequestHeader("Authorization", "Negotiate");
								request.setRequestHeader("Access-Control-Allow-Origin", "*");
								request.setRequestHeader("Access-Control-Allow-Methods", "GET, POST, PATCH, PUT, OPTIONS");
								request.setRequestHeader("Access-Control-Allow-Headers", "Origin, Content-Type, X-Auth-Token");
							},
							async: true,
							success: function (data) {
								$('#messageLabel').text('Shutdown Browser');
								$('#messageContent').text('Shutdown browser on '+items.ipaddress+' successful');
								$('#message').modal('show');
							},
							error: function (xhr, textStatus, errorMessage) {
								$('#messageLabel').text('Shutdown Browser');
								$('#messageContent').text('Shutdown browser on '+items.ipaddress+' successful');
								$('#message').modal('show');
							}                
						});
						/*$.post('http:////'+items.ipaddress+'//restart.php')
							.done(function() {
								$('#messageLabel').text('Restart Browser');
								$('#messageContent').text('Restart browser on '+items.ipaddress+' successful');
								$('#message').modal('show');
							})
							.fail(function() {
								$('#messageLabel').text('Restart Browser');
								$('#messageContent').text('Restart browser on '+items.ipaddress+' failed, the problem maybe from connection or device');
								$('#message').modal('show');
							});*/
					});
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