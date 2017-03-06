<?php
	include('../content/dbcontroller.php');
	$crud = new dbcontroller();
	
	$period = $_POST['period'];
	$session = $_POST['session'];
	$location = $_POST['location'];
	$station = $_POST['station'];
	$nim = $_POST['nim'];

	if(isset($_POST['submit']))
	{
		/*$condition = array(
				`period_id`=>$period,
				`session_id`=>$session,
				`location_id`=>$location,
				`station_id`=>$station
			);
		$competent = $crud->select_array("view_transaction_competent",$condition);
		$sql = "SELECT `period_id`, `session_id`, `location_id`, `station_id`, `lecturer_id`, `lecturer_name`, `subject_id`, `subject_name`, `competent_id`, `competent_name`, `weight` FROM view_transaction_competent WHERE `period_id` = '".$period."' AND `session_id` = '".$session."' AND `location_id` = '".$location."' AND `station_id` = '".$station."'";
		$competent = $crud->select_query($sql);
		$result = json_decode($competent);*/
		
		$sqlstudent = "SELECT `student_id`, `name` FROM student WHERE `student_id` = '".$nim."' LIMIT 1";
		$student_query = $crud->select_query($sqlstudent);
		$student = json_decode($student_query);
				
		foreach($student->data as $number=>$data)
		{
			$nim = $data->student_id;
			$name = $data->name;
			foreach($result->data as $key=>$value)
			{
				/*$insert_array = array(
					`period_id`=>$value->period_id,
					`session_id`=>$value->session_id,
					`location_id`=>$value->location_id,
					`station_id`=>$value->stasion_id,
					`lecturer_id`=>$value->lecturer_id,
					`lecturer_name`=>$value->lecturer_name,
					`subject_id`=>$value->subject_id,,
					`subject_name`=>$value->subject_name,
					`competent_id`=>$value->competent_id,
					`competent_name`=>$value->competent_name,
					`weight`=>$value->weight,
					`student_id`=>$nim,
					`student_name`=>$name,
					`editlog`=>"NOW()";
				);
				$run = $crud->insert_array("grade",$insert_array);*/
				$sqlinsertheader = "INSERT into grade(`period_id`, `session_id`, `location_id`, `station_id`, `subject_id`, `subject_name`, `competent_id`, `competent_name`, `weight`, `student_id`, `student_name`, `editlog`) VALUES('".$value->period_id."', '".$value->session_id."', '".$value->location_id."', '".$value->station_id."', '".$value->subject_id."', '".$value->subject_name."', '".$value->competent_id."', '".$value->competent_name."', '".$value->weight."', '".$nim."', '".$name."', NOW())";
				$run = $crud->query($sqlinsertheader);
				if($run)
				{
					print_r($run);			
				}
			}
		}
	}
?>
