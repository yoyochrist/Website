<?php

require_once('../content/dbcontroller.php');


	$conn = new DBController();
	$sql = "SELECT a.id,a.name FROM session a JOIN period b ON a.period_id=b.id WHERE b.active=1";
	$items = $conn->select_query($sql);
	print_r($items);


?>