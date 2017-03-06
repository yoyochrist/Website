<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}

	//variable simpan masukan	
	$lecturer = $_POST['lecturer'];
	$session = $_POST['session'];
	$station = $_POST['station'];
	$subject = $_POST['subject'];
	$question = $_POST['question'];
	$in = implode(',', $question);

	//sql statement select
	$sqlsession = "SELECT `student_id` FROM participant JOIN session ON `session_id` = `session`.`id` WHERE `session_id` = '".$session."' AND `active` = 1";

	if($resultsession = mysqli_query($link, $sqlsession))
	{
		if(mysqli_num_rows($resultsession) > 0)
		{
			while($rowsession = mysqli_fetch_array($resultsession))
			{
				$sqlcounter = 'SELECT CASE WHEN COUNT(id) = 0 THEN 0 WHEN COUNT(id) != 0 THEN MAX(id) END AS counter FROM grade';
				$resultcounter = mysqli_query($link, $sqlcounter);
				$rowcounter = mysqli_fetch_row($resultcounter);
				$counter = $rowcounter[0]+1;

				$sqlinsertheader = "INSERT grade(`session_id`,`student_id`,`subject_id`,`lecturer_id`,`station_id`,`question`) VALUES('".$session."','".$rowsession[0]."','".$subject."','".$lecturer."','".$station."','".$in."')";
				mysqli_query($link,$sqlinsertheader);
				
				foreach($question as $que_id)
				{
					$sqlinsertdetail = "INSERT grade_detail(`grade_id`,`question_id`) VALUES('".$counter."','".$que_id."')";
					mysqli_query($link,$sqlinsertdetail);
				}
			}
			echo "Data berhasil digenerate";
		}
		else
		{
			echo "Tidak ada partisipan yang terdaftar pada sesi ini";
		}
	}	
?>
