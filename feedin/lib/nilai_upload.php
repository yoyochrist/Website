<?php
	include('crud.php');

	if(isset($_POST['submit']))
	{
		$crud = new crud();

		if(is_uploaded_file($_FILES['filename']['tmp_name']))
		{
			echo "<h3>"."File ".$_FILES['filename']['name']." uploaded successfully."."</h3>";
		}

		$file = $_FILES['filename']['tmp_name'];
		$handle = fopen($file, "r");
		$i = 0;
		
		while (($data = fgetcsv($handle, 10000, ";")) !== false) 
		{
			//Get column CSV
			if($i == 0)
			{
				foreach($data as $key => $value)
				{
					//Defining each column of CSV
					$columns[] = $value;
				}
			}
			if($i > 0)
			{
				foreach ($columns as $key_dictionary => $value_dictionary)
				{
					//Check if data is filled by null value
					if($data[$key_dictionary] != null)
					{
						//Populate data into record array
						$record[$value_dictionary] = $data[$key_dictionary];
					}
				}
				//echo json_encode($record); //just make sure if the record is populated
				//$records[] = $record; //Don't ever name array of record with "data" because your line already declared as "data"
				
				$table="nilai";
				$run = $crud->insert_array($table,$record);
				if($run)
				{
					print_r($run);			
				}
			}
			$i++;
		}
		fclose($handle);
	}
	else
	{
		echo "File gagal diunggah";
	}
?>
