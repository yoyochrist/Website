<?php
	include('crud.php');
	include('webservice.php');
	include('syncmahasiswa.php');

	if(isset($_POST['submit']))
	{
		$crud = new crud();
		$ws = new webservice();
		$syncmahasiswa = new syncmahasiswa();

		if(is_uploaded_file($_FILES['filename']['tmp_name']))
		{
			echo "<h3>"."File ".$_FILES['filename']['name']." uploaded successfully."."</h3>";
		}

		$file = $_FILES['filename']['tmp_name'];
		$handle = fopen($file, "r");
		$table="kuliah_mahasiswa";
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
						if($value_dictionary == 'nipd')
						{
							$id_reg_pdCondition = array("nipd" => $data[$key_dictionary]);
							$id_reg_pdRecord = $crud->select_array("mahasiswa_pt",$id_reg_pdCondition);
							$id_reg_pdRows = json_decode($id_reg_pdRecord,true);

							if(isset($id_reg_pdRows['data'][0]['id_reg_pd']))
							{
								$record['id_reg_pd'] = $id_reg_pdRows['data'][0]['id_reg_pd'];
							}
							else
							{
								$id_reg_pd = $syncmahasiswa->synchronize_mahasiswa($data[$key_dictionary]);
								if(isset($id_reg_pd))
								{
									$record['id_reg_pd'] = $id_reg_pd;
								}
								/*$id_reg_pdRecord = ($ws->GetRecord('mahasiswa_pt',"nipd ilike '{$data[$key_dictionary]}%'"));
								if(is_null($id_reg_pdRecord['result']['id_reg_pd']))
								{
								}
								else
								{
									$id_reg_pd = $id_reg_pdRecord['result']['id_reg_pd'];
									$record['id_reg_pd'] = $id_reg_pd;
								}*/
							}
						}
						else
						{
							//Populate data into record array
							$record[$value_dictionary] = $data[$key_dictionary];
						}
					}
				}
				//echo json_encode($record); //just make sure if the record is populated
				if(isset($record['id_reg_pd']))
				{
					$records[] = $record; //Don't ever name array of record with "data" because your line already declared as "data"
				}
				
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
