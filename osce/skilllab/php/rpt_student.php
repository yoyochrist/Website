<?php

require_once('../content/dbcontroller.php');
$conn = new DBController();

	
if(isset($_POST['student'])){
	
	$student = $_POST['student'];

	$sql = "SELECT student_id FROM grade a JOIN period b ON a.period_id=b.id WHERE b.active=1 AND student_id='$student'";
	$result=$conn->runQueryO($sql);
  
  	$total=$result->num_rows;
	
	if($total>0)	
		print '1';
	else 
		print '0';

}
	
?>