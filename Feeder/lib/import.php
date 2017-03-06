<?php
	include('webservice.php');
	
	if(function_exists($_GET['f'])) {
		/*if($_GET['id'])
		{
			$_GET['f']($_GET['id']);
		}
		else*/
		{
			$_GET['f']();
		}
	}
	
	function InsertSingle()
	{
		$table = $_GET['table'];
		if(isset($_POST['submit']))
		{
			$ws = new webservice();

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
					$records[] = $record; //Don't ever name array of record with "data" because your line already declared as "data"
				}
				$i++;
			}
			
			foreach($records as $record)
			{
				//Insert one by one record per column
				$run = $ws->InsertRecord($table,json_encode($record));
				print_r($run);
			}
			fclose($handle);
		}
	}
	
	function InsertBatch()
	{
		$table = $_GET['table'];
		if(isset($_POST['submit']))
		{
			$ws = new webservice();

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
					$records[] = $record; //Don't ever name array of record with "data" because your line already declared as "data"
				}
				$i++;
			}
			
			$run = $ws->InsertRecordSet($table,json_encode($records));
			print_r($run);
			
			for($k = 0; $k < $i; $k++)
			{
				echo $run['result'][$k]['id_pd'];
			}
			fclose($handle);
		}
	}
?>
