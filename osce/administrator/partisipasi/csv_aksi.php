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
				$sqlparticipant = "INSERT into participant(`session_id`,`student_id`,`room`,`exam_type`,`editlog`) VALUES('$data[0]','$data[1]','$data[2]','$data[3]',NOW())";
				mysqli_query($link,$sqlparticipant);

				if($data[3] == 'SL')
				{
					$sqlcount = 'SELECT CASE WHEN COUNT(`id`) = 0 THEN 0 WHEN COUNT(`id`) != 0 THEN MAX(`id`) END FROM `grade`';
					$count = mysqli_query($link, $sqlcount);
					$rowcount = mysqli_fetch_row($count);
					$counter = $rowcount[0]+1;

					$sqlroom = "SELECT `id` FROM station WHERE `name` = 'Station $data[2]'";
					$resultroom = mysqli_query($link, $sqlroom);
					$rowroom = mysqli_fetch_row($resultroom);

					$sqlinsertheader = "INSERT into grade(`grade_id`, `session_id`,`student_id`,`station_id`,`editlog`) VALUES('$counter','$data[0]', '$data[1]', '$rowroom[0]', NOW())";
					mysqli_query($link,$sqlinsertheader);
				}
				else
				{
					$sqlroom = "SELECT `id` FROM station WHERE `name` LIKE '%".$data[2]."'";
					$resultroom = mysqli_query($link, $sqlroom);
					
					while($rowroom = mysqli_fetch_assoc($resultroom))
					{
						$sqlcount = 'SELECT CASE WHEN COUNT(`grade_id`) = 0 THEN 0 WHEN COUNT(`grade_id`) != 0 THEN MAX(`grade_id`) END FROM `grade`';
						$count = mysqli_query($link, $sqlcount);
						$rowcount = mysqli_fetch_row($count);
						$counter = $rowcount[0]+1;

						$sqlinsertheader = "INSERT into grade(`grade_id`, `session_id`,`student_id`,`station_id`,`editlog`) VALUES('$counter','$data[0]', '$data[1]', '".$rowroom['id']."', NOW())";
						mysqli_query($link,$sqlinsertheader);
					}
				}
			}
			$i++;
		}
		fclose($handle);

		echo "Peserta berhasil dijadwalkan";
		echo '<a class="btn btn-primary" href="index.php?mod=slnla">Kembali</a>';
	}
	else
	{
		echo "File gagal diunggah";
		echo '<a class="btn btn-primary" href="index.php?mod=slnla">Kembali</a>';
	}
?>
