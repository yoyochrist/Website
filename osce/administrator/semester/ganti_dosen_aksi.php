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
	$room = $_POST['room'];

	//sql statement select
	$sqlsession = "SELECT `student_id` FROM participant JOIN session ON `session_id` = `session`.`id` WHERE `session_id` = '".$session."' AND `active` = 1";
	$resultsession = mysqli_query($link, $sqlsession);
	if(mysqli_num_rows($resultsession) > 0)
	{
		while($rowsession = mysqli_fetch_array($resultsession))
		{
			$sqlroom = "SELECT `id` FROM station WHERE `name` = 'Station ".$station.$room."'";
			$resultroom = mysqli_query($link, $sqlroom);
			$rowroom = mysqli_fetch_row($resultroom);

			$sqlupdategrade = "UPDATE `grade` SET `lecturer_id` = '".$lecturer."' WHERE `student_id` = '".$rowsession['student_id']."' AND `station_id` = '".$rowroom[0]."' AND `exam_type` = 'SR' AND `session_id` = '".$session."' AND `global_scale` IS NULL";
			mysqli_query($link,$sqlupdategrade);
		}
		echo "Penguji berhasil diubah";
		echo '<a class="btn btn-primary" href="index.php?mod=srnla">Kembali</a>';
	}
	else
	{
		echo "Tidak ada partisipan yang terdaftar pada sesi ini";
		echo '<a class="btn btn-primary" href="index.php?mod=srnla">Kembali</a>';
	}
?>
