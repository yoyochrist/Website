$(document).ready(function() {
	var grade_id;
	var global_id;
	var edit_window = $("#frmGrade").dialog({
	  autoOpen: false,
      height: 380,
      width: 480,
      modal: true});
	
	var global_window = $("#frmGlobal").dialog({
	  autoOpen: false,
      height: 240,
      width: 480,
      modal: true});
	
	
	$(".btnEditAction").button().on("click", function() {
		openEditBox($(this).attr("id"));
	});
	
	$(".btnGlobalAction").button().on("click", function() {
		openGlobalBox($(this).attr("id"));
	});
	
	$("form").submit(function(e){
		var valid = true;
		var msg = '';
		$('div[class^="grade-content"]').each(function () {
			var x = $(this).text();
			
			if (!x.trim()) {
            	msg += 'Nilai Kompetensi ';
				valid = false;
				return false;  
       		}
    	});
		if ($("#global-content").text()=="") {
			if(!valid){msg += 'dan ';} else {msg += 'Nilai ';}
			msg += 'Global Rating ';
            valid = false;
		}
		
		if (!valid){
			alert(msg+' belum diisi!');
			e.preventDefault(e);
		} else {}
		
	});
	
});


function openEditBox(id) {
	edit_window = $("#frmGrade").dialog({
      buttons: 
	  {
        	"Simpan": editComment
	  },
	   
	  close: function() {
		 edit_window.dialog( "close" );
      }
    });
	edit_window.dialog("open");
	grade_id = id;
	var grade = $("#gradedetail_" + grade_id + " .grade-content").html();
	var quest = $("#questdetail_" + grade_id).html();
	var comment = $("#commentdetail_" + grade_id).html();
	$("#question").text(quest); 
	switch(grade) {
		case "0":
			$('input[value=0]').click();
			break;
		case "1":
			$('input[value=1]').click();
			break;
		case "2":
			$('input[value=2]').click();			
			break;
		case "3":
			$('input[value=3]').click();
			break;
		default:
			$('input[value=0]').click();
			break;
	}
	$('textarea[name=qcomment]').val(comment);	 
	
}

function openGlobalBox(id) {
	global_window = $("#frmGlobal").dialog({
      buttons: 
	  {
        	"Simpan": globalComment
	  },
	   
	  close: function() {
		 global_window.dialog( "close" );
      }
    });
	global_window.dialog("open");
	var global = $("#global-content").html();
	global_id = id;
	
	switch(global) {
		case "Tidak Lulus":
			$('input[value=0]').click();
			break;
		case "Border Line":
			$('input[value=1]').click();
			break;
		case "Lulus":
			$('input[value=2]').click();			
			break;
		case "Superior":
			$('input[value=3]').click();
			break;

	}	 
	
}

function editComment() {
	edit_window.dialog( "close" );
	callAction('edit',grade_id);
} 

function globalComment() {
	global_window.dialog( "close" );
	callAction('global',global_id);
} 




function callAction(action,id) {
	var queryString;
	switch(action) {
		case "edit":
			queryString = 'action='+action+'&gradedetail_id='+ id + '&txtgrade='+ $('input[name=radiograde]:checked').val() +'&txtcomment=' + $('textarea[name=qcomment]').val();
		break;
		case "global":
			queryString = 'action='+action+'&id='+ id + '&txtglobal='+ $('input[name=radioglobal]:checked').val() +'&detail='+ id;
		break;
	}	 
	jQuery.ajax({
	url: "tulis_nilai.php",
	data:queryString,
	type: "POST",
	success:function(data){
		switch(action) {
			case "edit":
				$("#gradedetail_" + id + " .grade-content").html(data);
				$("#gradedetail_" + id + " .grade-content").addClass("bold");
				$("#commentdetail_" + id).html($('textarea[name=qcomment]').val());
			break;
			case "global":
				$("#global-content").html(data);
				$("#global-content").addClass("bold");
			break;
		}
		if ($('textarea[name=qcomment]').val()){
			$("[id^=commentdetail]").removeClass('hide');
		}
		$('textarea[name=qcomment]').val('')
		$("#txtmessage").val('');
		$("#edit-message").val('');
	},
	error:function (){}
	});
}