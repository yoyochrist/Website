<?php
	include('../content/dbcontroller.php');

	if(isset($_POST['submit']))
	{
		$crud = new dbcontroller();

		if(is_uploaded_file($_FILES['filename']['tmp_name']))
		{
			echo "<h3>"."File ".$_FILES['filename']['name']." uploaded successfully."."</h3>";
		}

		$file = $_FILES['filename']['tmp_name'];
		$handle = fopen($file, "r");
		$i = 0;
		
		while (($data = fgetcsv($handle)) !== false) 
		{
			if($i > 0)
			{
				$condition = array(
					`period_id`=>$data[0],
					`session_id`=>$data[1],
					`location_id`=>$data[2],
					`station_id`=>$data[3]
				);
				$competent = $crud->select_array("view_transaction_competent",$condition);
				//echo $data[0].' '.$data[1].' '.$data[2].' '.$data[3].' '.$data[4];
				/*$sql = "SELECT `period_id`, `session_id`, `location_id`, `station_id`, `lecturer_id`, `lecturer_name`, `subject_id`, `subject_name`, `competent_id`, `competent_name`, `weight` FROM `view_transaction_competent` WHERE `period_id` = '".$data[0]."' AND `session_id` = '".$data[1]."' AND `location_id` = '".$data[2]."' AND `station_id` = '".$data[3]."';";
				$competent = $crud->select_query($sql);*/
				$result = json_decode($competent);
//				print_r($result->data);

				$sqlstudent = "SELECT `id`, `name` FROM `student` WHERE `id` = '".$data[4]."' LIMIT 1;";
				$student_query = $crud->select_query($sqlstudent);
				$student = json_decode($student_query);
				//print_r($student->data);
				
				foreach($student->data as $number=>$profile)
				{
					$nim = $profile->id;
					$name = $profile->name;
					foreach($result->data as $key=>$value)
					{
						$insert_array = array(
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
						$run = $crud->insert_array("grade",$insert_array);
						/*$sqlinsertheader = "INSERT into `grade`(`period_id`, `session_id`, `location_id`, `station_id`, `lecturer_id`, `lecturer_name`, `subject_id`, `subject_name`, `competent_id`, `competent_name`, `weight`, `student_id`, `student_name`, `editlog`, `userlog`) VALUES('".$value->period_id."', '".$value->session_id."', '".$value->location_id."', '".$value->station_id."', '".$value->lecturer_id."', '".$value->lecturer_name."', '".$value->subject_id."', '".$value->subject_name."', '".$value->competent_id."', '".$value->competent_name."', '".$value->weight."', '".$nim."', '".$name."', NOW(), 'administrator');";
						$run = $crud->query($sqlinsertheader);*/
						if($run)
						{
							print_r($run);			
						}
					}
				}
			}
			$i++;
		}
		fclose($handle);

		/*$file = $_FILES['filename']['tmp_name'];
		$handle = fopen($file, "r");
		echo "<table class='table'>";
			while (($line = fgetcsv($handle)) !== false) 
			{
			        echo "<tr>";
			        foreach ($line as $cell) 
				{
                			echo "<td>" . htmlspecialchars($cell) . "</td>";
			        }
			        echo "</tr>";
			}
		echo "</table>";
		fclose($handle);

		echo "Peserta berhasil dijadwalkan";
		echo '<a class="btn btn-primary" href="akademik.php">Kembali</a>';*/
	}/*
	else
	{
		echo "File gagal diunggah";
		echo '<a class="btn btn-primary" href="akademik.php">Kembali</a>';
	}*/
?>
