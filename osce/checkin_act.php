<?php
	$room = $_POST['location'];
	$station = $_POST['station'];
	$lecturer_id=$_SESSION['id'];
	$session=getActiveSession();

	$sql_update = "UPDATE grade set lecturer_id='".$lecturer_id."', lecturer_name ='".$name."' WHERE location_id='".$room."' AND station_id='".$station."' AND and session_id = '".$session."''";
	if($conn->runQueryO($sql_update) == true)
	{
		header('http://192.168.14.229/osce/index.php?mod=reg');
	}
?>