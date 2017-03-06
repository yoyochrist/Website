<?php


require_once('content/dbcontroller.php');
include('content/fns.php');

$conn = new DBController();



$action = $_POST["action"];
if(!empty($action)) {
	
	switch($action) {
		case "edit":
	
			//$result = mysqli_query($conn, "UPDATE grade set score='".$_POST['txtgrade']."', comment='".$_POST['txtcomment']."' WHERE  id=".$_POST['gradedetail_id']);
			$sql = "UPDATE grade set score='".$_POST['txtgrade']."', comment='".$_POST['txtcomment']."' WHERE  id=".$_POST['gradedetail_id'];

			if ($conn->runQueryO($sql) === TRUE) {
				echo $_POST['txtgrade'];
			} 
			
			//if($result){
				//echo $_POST['txtgrade'];
			//}
			break;
		
		case "global": 
			session_start();
			$session=getActiveSession();
			$student_id=$_SESSION['student_id'];
			$lecturer_id=$_SESSION['id'];
		
			//$result = mysql_query("UPDATE grade set global_scale= '".$_POST['txtglobal']."' WHERE  id=".$_POST['id']);
			$sql = "UPDATE grade set global_scale= '".$_POST['txtglobal']."' WHERE session_id='$session' AND student_id='$student_id' AND lecturer_id='$lecturer_id'";
			//if($result)
				//echo getGlobalScaleName($_POST["txtglobal"]);
			
			if ($conn->runQueryO($sql) === TRUE) {
				echo getGlobalScaleName($_POST["txtglobal"]);
			} 

				
			break;
	}
}




?>