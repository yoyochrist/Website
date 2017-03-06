$(document).ready(function() {
   
	$("#lecturer-name").autocomplete({
    	minLength: 2,
      	source: "php/rpt_lecturer.php",
      	focus: function( event, ui ) {
        	$("#lecturer-name").val(ui.item.value);
        return false;
      },
      select: function( event, ui ) {
        $("#lecturer-name").val(ui.item.value);
        $("#lecturer-id").val(ui.item.id);
        
		//return false;
		var id = $("#lecturer-id").val();
		$.ajax({
            url: 'php/rpt_lecturer.php',
            type: 'post',
            dataType: 'json',
			data: 'lecturer_id='+id,
            success: function (data) {
            	if(data){
					$.each(data.data, function (i, items) {
						$("#sesi").append("<option value='"+items.id+"'>"+items.name+"</option>");
					});
				}
            }
        });
      } 
	});
 	
	
 
 	$("form").submit(function(e){
		
		e.preventDefault(e);
		
		var x = $('#lecturer-id').val();
		var y = $('#sesi').val();
		
		if ((x == "" )) {
        	alert("Anda belum mengisi dengan benar");
		} else
			gotoURL(x,y);
	});
	
	
	
	function gotoURL(x,y) {
		var newURL = "reports/lecturer.php?lecturer="+x+"&session="+y;
		window.open(newURL, "_blank");
	}
 
 
 
 
 
 
 });