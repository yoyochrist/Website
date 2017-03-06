<?php

require_once('../content/dbcontroller.php');
$conn = new DBController();

if(isset($_POST['period_id'])){
	
	$period = $_POST['period_id'];

	$sql = "UPDATE period SET active=0";
	$items = $conn->query($sql);
	
	$sql = "UPDATE period SET active=1 WHERE id='$period'";
	$items = $conn->query($sql);
	
	
}
	
?>