<?php

require_once('../content/dbcontroller.php');
$conn = new DBController();

if(isset($_GET['term'])){

	$searchTerm = $_GET['term'];
	
	
	$sql = "SELECT id, name as value FROM lecturer WHERE b.active=1 AND name LIKE '%".$searchTerm."%'";

	$items = $conn->select_query2($sql);
	print_r($items);
	
}
	
?>