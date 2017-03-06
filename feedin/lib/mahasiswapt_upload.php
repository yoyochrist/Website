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
		$table="mahasiswa_pt";
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
				$id_spRecord = $crud->get("satuan_pendidikan");
				$id_spRows = json_decode($id_spRecord,true);
				$record['id_sp'] = $id_spRows['data'][0]['id_sp'];
				
				foreach ($columns as $key_dictionary => $value_dictionary)
				{
					//Check if data is filled by null value
					if($data[$key_dictionary] != null)
					{
						if($value_dictionary == 'nm_pd')
						{
							$id_pdCondition = array("nm_pd" => $data[$key_dictionary], "tgl_lahir"=>$data[$key_dictionary+1]);
							$id_pdRecord = $crud->select_array("mahasiswa",$id_pdCondition);
							$id_pdRows = json_decode($id_pdRecord,true);
							$record['id_pd'] = $id_pdRows['data'][0]['id_pd'];
						}
						else if($value_dictionary == 'id_sms')
						{
							$id_smsCondition = array("kd_sms" => $data[$key_dictionary]);
							$id_smsRecord = $crud->select_array("sms",$id_smsCondition);
							$id_smsRows = json_decode($id_smsRecord,true);
							$record['id_sms'] = $id_smsRows['data'][0]['id_sms'];
						}
						else if($value_dictionary == 'tgl_lahir')
						{
							//Do Nothing
						}
						else
						{
							//Populate data into record array
							$record[$value_dictionary] = $data[$key_dictionary];
						}
					}
				}
				//echo json_encode($record); //just make sure if the record is populated
				$records[] = $record; //Don't ever name array of record with "data" because your line already declared as "data"
				
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
