<?php
	$table = "mahasiswa";
	
	/*if(isset($_POST['submit']))
	{
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
			{*/
				if($table!='mahasiswa' || $table!='mahasiswa_pt')
				{
					$json_recordset = file_get_contents('http://192.168.113.68:88/Feeder/lib/table.php?f=GetRecordSetWithoutConditionLimitOne&table='.$table);
				}
				else
				{
					if($table=='mahasiswa')
					{
						$json_recordset = file_get_contents('http://192.168.113.68:88/Feeder/lib/table.php?f=GetDictionary&table=mahasiswa');
					}
					else
					{
						$json_recordset = file_get_contents('http://192.168.113.68:88/Feeder/lib/table.php?f=GetDictionary&table=mahasiswa_pt');
					}
				}
	
				$val_recordset = json_decode($json_recordset, true);
				$getRecordset = $val_recordset['result'];

				foreach($getRecordset as $key_recordset => $value_recordset)
				{
					$getDictionary = array_keys($value_recordset);
				}
	
				foreach ($getDictionary as $key_dictionary => $value_dictionary){
					$record[$value_dictionary] = "test".$key_dictionary;
				}
				$records[] = $record;
				echo json_encode($record);
			/*}
			$i++;
		}
		$ws->InsertRecordSet($table,$data);
		fclose($handle);
	}*/
?>