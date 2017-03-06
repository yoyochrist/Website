$(document).ready(function(){
	setInterval(checkTime, 1000); //60 seconds between checks
	function checkTime(){
		$.ajax({
			url: 'checkTime.php',
			success: function(refresh)
			{
				if(refresh == "true")
				{
					location.reload(true);
				}	
			}
		});
	}
});
