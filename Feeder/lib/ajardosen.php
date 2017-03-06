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
		$table = "ajar_dosen";
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
						//print_r($key_dictionary.' '.$value_dictionary.'<br/>');
						if($data[$key_dictionary] == null)
						{
							//Populate data into record array
							if($value_dictionary == 'id_sp')
							{
								$pt = 'Universitas Kristen Krida Wacana';
								$id_spRecord = ($ws->GetRecord('satuan_pendidikan',"nm_lemb ilike '%{$pt}%'"));
								$id_sp = $id_spRecord['result']['id_sp'];
								$record[$value_dictionary] = $id_sp;
							}
							else
							{
							}
						}
						else
						{	
							if($value_dictionary == 'nidn')
							{
								//print_r($data[$key_dictionary].' '.$data[$key_dictionary+1]);exit();
								//echo $data[$key_dictionary].'<br>';                                                                                                           
								$id_reg_ptkRecord = ($ws->GetRecord('dosenpt',"nidn ilike '{$data[$key_dictionary]}%'"));
								//print_r(json_encode($id_reg_ptkRecord).'<br/>');
								//print_r($id_reg_ptkRecord);//exit();
								if(isset($id_reg_ptkRecord['result']['id_reg_ptk']) == FALSE || is_null(($id_reg_ptkRecord['result']['id_reg_ptk'])) == TRUE)
								{
								}
								else
								{
									$id_reg_ptk = $id_reg_ptkRecord['result']['id_reg_ptk'];
									$record['id_reg_ptk'] = $id_reg_ptk;
									//print_r($data[$key_dictionary].' '.$record['id_reg_ptk'].'<br/>');
								}
							}
							else if($value_dictionary == 'kode_mk')
							{
								//print_r($data[$key_dictionary].' '.$data[$key_dictionary+1]);exit();
								//echo $data[$key_dictionary].'<br>';                                                                                                           
								$id_mkRecord = ($ws->GetRecord('mata_kuliah',"kode_mk ilike '%{$data[$key_dictionary]}%'"));
								$id_mk = $id_mkRecord['result']['id_mk'];
								//print_r($id_mk);
								$id_klsRecord = ($ws->GetRecord('kelas_kuliah',"id_mk = '{$id_mk}' AND id_smt ilike '{$data[$key_dictionary+1]}%'"));
								//print_r(json_encode($id_klsRecord).'<br/>');
								//print_r($id_klsRecord);//exit();
								if(isset($id_klsRecord['result']['id_kls']) == FALSE || is_null(($id_klsRecord['result']['id_kls'])) == TRUE)
								{
								}
								else
								{
									$id_kls = $id_klsRecord['result']['id_kls'];
									$record['id_kls'] = $id_kls;
									//print_r($data[$key_dictionary].' '.$record['id_kls'].'<br/>');
								}
							}
							else
							{
								$record[$value_dictionary] = $data[$key_dictionary];
							}
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
		$table = "ajar_dosen";
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
						//print_r($key_dictionary.' '.$value_dictionary.'<br/>');
						if($data[$key_dictionary] == null)
						{
							//Populate data into record array
							if($value_dictionary == 'id_sp')
							{
								$pt = 'Universitas Kristen Krida Wacana';
								$id_spRecord = ($ws->GetRecord('satuan_pendidikan',"nm_lemb ilike '%{$pt}%'"));
								$id_sp = $id_spRecord['result']['id_sp'];
								$record[$value_dictionary] = $id_sp;
							}
							else
							{
							}
						}
						else
						{	
							if($value_dictionary == 'nidn')
							{
								//print_r($data[$key_dictionary].' '.$data[$key_dictionary+1]);exit();
								//echo $data[$key_dictionary].'<br>';                                                                                                           
								$id_reg_ptkRecord = ($ws->GetRecord('dosenpt',"nidn ilike '{$data[$key_dictionary]}%'"));
								//print_r(json_encode($id_reg_ptkRecord).'<br/>');
								//print_r($id_reg_ptkRecord);//exit();
								if(isset($id_reg_ptkRecord['result']['id_reg_ptk']) == FALSE || is_null(($id_reg_ptkRecord['result']['id_reg_ptk'])) == TRUE)
								{
								}
								else
								{
									$id_reg_ptk = $id_reg_ptkRecord['result']['id_reg_ptk'];
									$record['id_reg_ptk'] = $id_reg_ptk;
									//print_r($data[$key_dictionary].' '.$record['id_reg_ptk'].'<br/>');
								}
							}
							else if($value_dictionary == 'kode_mk')
							{
								//print_r($data[$key_dictionary].' '.$data[$key_dictionary+1]);exit();
								//echo $data[$key_dictionary].'<br>';                                                                                                           
								$id_mkRecord = ($ws->GetRecord('mata_kuliah',"kode_mk ilike '%{$data[$key_dictionary]}%'"));
								$id_mk = $id_mkRecord['result']['id_mk'];
								//print_r($id_mk);
								$id_klsRecord = ($ws->GetRecord('kelas_kuliah',"id_mk = '{$id_mk}' AND id_smt ilike '{$data[$key_dictionary+1]}%'"));
								//print_r(json_encode($id_klsRecord).'<br/>');
								//print_r($id_klsRecord);//exit();
								if(isset($id_klsRecord['result']['id_kls']) == FALSE || is_null(($id_klsRecord['result']['id_kls'])) == TRUE)
								{
								}
								else
								{
									$id_kls = $id_klsRecord['result']['id_kls'];
									$record['id_kls'] = $id_kls;
									//print_r($data[$key_dictionary].' '.$record['id_kls'].'<br/>');
								}
							}
							else
							{
								$record[$value_dictionary] = $data[$key_dictionary];
							}
						}
					}

					//echo json_encode($record); //just make sure if the record is populated
					$records[] = $record; //Don't ever name array of record with "data" because your line already declared as "data"
				}
				$i++;
			}
			//exit();
			$run = $ws->InsertRecordSet($table,json_encode($records));
			print_r($run);
			fclose($handle);
		}
	}
?>
