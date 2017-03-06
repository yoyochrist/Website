<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}

	if(isset($_POST['submit']))
	{
		if(is_uploaded_file($_FILES['filename']['tmp_name']))
		{
			echo "<h3>"."File ".$_FILES['filename']['name']." uploaded successfully."."</h3>";
		}

		$file = $_FILES['filename']['tmp_name'];
		$handle = fopen($file, "r");

		$i = 0;
		while(($data = fgetcsv($handle, 1000, ",")) !== FALSE)
		{
			if($i > 0)
			{
				$sqlroom = "SELECT `id` FROM station WHERE `name` = 'Station $data[3]'";
				$resultroom = mysqli_query($link, $sqlroom);
				$rowroom = mysqli_fetch_row($resultroom);

				$question = explode(";",$data[4]);
				$weight = explode(";",$data[5]);
				$quesweight = array("question"=>$question,"weight"=>$weight);				

				$sqlselectheader = "SELECT `grade_id` FROM `grade` WHERE `session_id` = '$data[0]' AND `station_id` = '$rowroom[0]'";
				$resultselect = mysqli_query($link,$sqlselectheader);

				while($rows = mysqli_fetch_assoc($resultselect))
				{
					$sqlinsertheader = "UPDATE `grade` SET `subject_id` = '$data[1]', `lecturer_id` = '$data[2]', `question` = '$data[4]' WHERE `grade_id` = '".$rows['grade_id']."'";
					mysqli_query($link,$sqlinsertheader);

					for($index = 0; $index < count($quesweight['question']); $index++)
					{
						$sqlinsertdetail = "INSERT grade_detail(`grade_id`,`question_id`,`question_weight`,`editlog`) VALUES('".$rows['grade_id']."','".$quesweight['question'][$index]."','".$quesweight['weight'][$index]."',NOW())";
						mysqli_query($link,$sqlinsertdetail);
					}
				}
			}
			$i++;
		}
		fclose($handle);

		echo "Peserta Skill Lab berhasil dijadwalkan";
		echo '<a class="btn btn-primary" href="index.php?mod=slnla">Kembali</a>';
	}
	else
	{
		echo "File gagal diunggah";
		echo '<a class="btn btn-primary" href="index.php?mod=slnla">Kembali</a>';
	}
?>
