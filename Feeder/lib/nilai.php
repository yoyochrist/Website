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
		$table = "nilai";
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
							if($value_dictionary == 'nipd')
							{
								//print_r($data[$key_dictionary]);//exit();
								$id_reg_pdRecord = ($ws->GetRecord('mahasiswa_pt',"nipd ilike '{$data[$key_dictionary]}%'"));
								//print_r(json_encode($id_reg_pdRecord).'<br/>');
								//print_r($id_reg_pdRecord);exit();
								if(is_null($id_reg_pdRecord['result']['id_reg_pd']))
								{
								}
								else
								{
									$id_reg_pd = $id_reg_pdRecord['result']['id_reg_pd'];
									$record['id_reg_pd'] = $id_reg_pd;
									//print_r($data[$key_dictionary].' '.$record['id_reg_pd'].'<br/>');
								}
							}
							else if($value_dictionary == 'kode_mk')
							{
								//print_r($data[$key_dictionary].' '.$data[$key_dictionary+1]);exit();
								$id_klsRecord = ($ws->GetRecord('kelas_kuliah',"kode_mk = '{$data[$key_dictionary]}' AND id_smt = {$data[$key_dictionary+1]}"));
								//print_r(json_encode($id_pdRecord).'<br/>');
								//print_r($id_pdRecord);exit();
								if(is_null($id_klsRecord['result']['id_kls']))
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
		$table = "nilai";
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
							if($value_dictionary == 'nm_kls' || $value_dictionary == 'id_smt')
							{
							}
							else if($value_dictionary == 'nipd')
							{
								//print_r($data[$key_dictionary]);//exit();
								$id_reg_pdRecord = ($ws->GetRecord('mahasiswa_pt',"nipd ilike '{$data[$key_dictionary]}%'"));
								//print_r(json_encode($id_reg_pdRecord).'<br/>');
								//print_r($id_reg_pdRecord);exit();
								if(is_null($id_reg_pdRecord['result']['id_reg_pd']))
								{
								}
								else
								{
									$id_reg_pd = $id_reg_pdRecord['result']['id_reg_pd'];
									$record['id_reg_pd'] = $id_reg_pd;
									//print_r($data[$key_dictionary].' '.$record['id_reg_pd'].'<br/>');
								}
							}
							/*else if($value_dictionary == 'kode_mk')
							{
								print_r($data[$key_dictionary].' '.$data[$key_dictionary+1].' '.$data[$key_dictionary+2].'<br/>');//exit();
								$id_mkRecord = ($ws->GetRecord('mata_kuliah',"kode_mk ilike '%{$data[$key_dictionary]}%'"));
								$id_mk = $id_mkRecord['result']['id_mk'];
								print_r($id_mk.'<br/>');

								$id_smsRecord = ($ws->GetRecord('sms',"nm_lemb ilike '%Teknik Informatika%' AND website ilike '%ukrida.ac.id%'"));
								$id_sms = $id_smsRecord['result']['id_sms'];
								$id_klsRecord = ($ws->GetRecord('kelas_kuliah',"id_mk = '07be083f-540f-4df2-8a3d-1ff9f95ac280' id_sms = '{$id_sms}' AND nm_kls ilike '%2PITA%' AND id_smt = '20161'"));
								print_r(json_encode($id_klsRecord).'<br/>');
								//print_r($id_klsRecord);exit();
								if($id_klsRecord['result']['id_kls'])
								{
								}
								else
								{
									$id_kls = $id_klsRecord['result']['id_kls'];
									$record['id_kls'] = $id_kls;
									//print_r($data[$key_dictionary].' '.$record['id_kls'].'<br/>');
								} 
							}*/
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
			$run = $ws->InsertRecordSet($table,json_encode($records));
			print_r($run);
			fclose($handle);
		}
	}
	
	function UpdateBatch()
	{
		$table = "nilai";
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
							if($value_dictionary == 'nipd')
							{
								//print_r($data[$key_dictionary]);//exit();
								$id_reg_pdRecord = ($ws->GetRecord('mahasiswa_pt',"nipd ilike '{$data[$key_dictionary]}%'"));
								//print_r(json_encode($id_reg_pdRecord).'<br/>');
								//print_r($id_reg_pdRecord);exit();
								if(is_null($id_reg_pdRecord['result']['id_reg_pd']))
								{
								}
								else
								{
									$id_reg_pd = $id_reg_pdRecord['result']['id_reg_pd'];
									$record['id_reg_pd'] = $id_reg_pd;
									//print_r($data[$key_dictionary].' '.$record['id_reg_pd'].'<br/>');
								}
							}
							/*else if($value_dictionary == 'kode_mk')
							{
								print_r($data[$key_dictionary].' '.$data[$key_dictionary+1].'<br/>');//exit();
								$id_mkRecord = ($ws->GetRecord('mata_kuliah',"kode_mk ilike '%{$data[$key_dictionary]}%'"));
								$id_mk = $id_mkRecord['result']['id_mk'];
								print_r($id_mk.'<br/>');
								$id_klsRecord = ($ws->GetRecord('kelas_kuliah',"id_mk = '{$id_mk}' AND nm_kls ilike '%{$data[$key_dictionary+1]}%' AND id_smt ilike '%{$data[$key_dictionary+2]}%'"));
								print_r(json_encode($id_klsRecord).'<br/>');
								//print_r($id_klsRecord);exit();
								if($id_klsRecord['result']['id_kls'])
								{
								}
								else
								{
									$id_kls = $id_klsRecord['result']['id_kls'];
									$record['id_kls'] = $id_kls;
									//print_r($data[$key_dictionary].' '.$record['id_kls'].'<br/>');
								} 
							}*/
							else
							{
								$record[$value_dictionary] = $data[$key_dictionary];
							}
						}
					}

					//echo json_encode($record); //just make sure if the record is populated
					$records[] = array("key"=>$key, "data"=>$record); //Don't ever name array of record with "data" because your line already declared as "data"
				}
				$i++;
			}
			exit();
			$run = $ws->UpdateRecordSet($table,json_encode($records));
			print_r($run);
			fclose($handle);
		}
	}
	
	function DeleteBatch()
	{
		$table = "nilai";
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
					$id_klsRecord = ($ws->GetRecord('kelas_kuliah',"id_mk = '{$data[$key_dictionary]}' AND nm_kls ilike '%{$data[$key_dictionary+1]}%' AND id_smt ilike '%{$data[$key_dictionary+2]}%'"));
					//echo json_encode($record); //just make sure if the record is populated
					$records[] = array("id_kls"=>$id_klsRecord['result']['id_kls']); //Don't ever name array of record with "data" because your line already declared as "data"
				}
				$i++;
			}
			exit();
			$run = $ws->DeleteRecordSet($table,json_encode($records));
			print_r($run);
			fclose($handle);
		}
	}
	
	function DeleteAll()
	{
		$ws = new webservice();
		
		echo json_encode($ws->GetRecordSetUndecoded("kelas_kuliah","id_smt = '20152'","id_smt","10",""));
		/*foreach($id_klsRecord as $key=>$value)
		{
			echo $key.' '.$value;
		}*/
	}
?>
