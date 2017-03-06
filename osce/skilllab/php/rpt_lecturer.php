<?php

require_once('../content/dbcontroller.php');
$conn = new DBController();

if(isset($_GET['term'])){

	$searchTerm = $_GET['term'];
	
	
	$sql = "SELECT DISTINCT a.lecturer_id as id, a.lecturer_name as value FROM grade a JOIN period b ON a.period_id=b.id WHERE b.active=1 AND a.lecturer_name LIKE '%".$searchTerm."%'";

	$items = $conn->select_query2($sql);
	print_r($items);
	
}
	
if(isset($_POST['lecturer_id'])){
	
	$lecturer = $_POST['lecturer_id'];

	$sql = "SELECT DISTINCT a.id,a.name FROM session a JOIN period b ON a.period_id=b.id JOIN grade c ON c.session_id=a.id WHERE b.active=1 AND lecturer_id='$lecturer'";
	$items = $conn->select_query($sql);
	print_r($items);

}
	
?>