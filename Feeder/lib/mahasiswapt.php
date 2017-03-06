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
		$table = "mahasiswa_pt";
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
							if($value_dictionary == 'nm_pd')
							{
								//print_r($data[$key_dictionary].' '.$data[$key_dictionary+1]);exit();
								$id_pdRecord = ($ws->GetRecord('mahasiswa',"nm_pd = '{$data[$key_dictionary]}' AND tgl_lahir = '{$data[$key_dictionary+1]}'"));
								//print_r(json_encode($id_pdRecord).'<br/>');
								//print_r($id_pdRecord);exit();
								if(is_null($id_pdRecord['result']['id_pd']))
								{
								}
								else
								{
									$id_pd = $id_pdRecord['result']['id_pd'];
									$record['id_pd'] = $id_pd;
									//print_r($data[$key_dictionary].' '.$data[$key_dictionary+1].' '.$record['id_pd'].'<br/>');
								}
							}
							else if($value_dictionary == 'id_sms')
							{
								if($data[$key_dictionary]=='10')
								{
									$prodi='Pendidikan Dokter';
								}
								else
								{
									if($data[$key_dictionary]=='01')
									{
										$prodi='Magister Manajemen';
									}
									else
									{
										if($data[$key_dictionary]=='21')
										{
											$prodi='Teknik Elektro';
										}
										else
										{
											if($data[$key_dictionary]=='22')
											{
												$prodi='Teknik Sipil';
											}
											else
											{
												if($data[$key_dictionary]=='24')
												{
													$prodi='Teknik Industri';
												}
												else
												{
													if($data[$key_dictionary]=='31')
													{
														$prodi='Manajemen';
													}
													else
													{
														if($data[$key_dictionary]=='32')
														{
															$prodi='Akuntansi';
														}
														else
														{
															if($data[$key_dictionary]=='41')
															{
																$prodi='Teknik Informatika';
															}
															else
															{
																if($data[$key_dictionary]=='42')
																{
																	$prodi='Sistem Informasi';
																}
																else
																{
																	if($data[$key_dictionary]=='50')
																	{
																		$prodi='Psikologi';
																	}
																	else
																	{
																		if($data[$key_dictionary]=='71')
																		{
																			$prodi='Sastra Inggris';
																		}
																		else
																		{
																			$prodi='Profesi Dokter';
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
								$id_smsRecord = ($ws->GetRecord('sms',"nm_lemb ilike '%{$prodi}%' AND website ilike '%ukrida.ac.id%'"));
								$id_sms = $id_smsRecord['result']['id_sms'];
								$record[$value_dictionary] = $id_sms;
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
		$table = "mahasiswa_pt";
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
							if($value_dictionary == 'nm_pd')
							{
								//print_r($data[$key_dictionary].' '.$data[$key_dictionary+1]);exit();
								$id_pdRecord = ($ws->GetRecord('mahasiswa',"nm_pd = '{$data[$key_dictionary]}' AND tgl_lahir = '{$data[$key_dictionary+1]}'"));
								//print_r(json_encode($id_pdRecord).'<br/>');
								//print_r($id_pdRecord);exit();
								if(is_null($id_pdRecord['result']['id_pd']))
								{
								}
								else
								{
									$id_pd = $id_pdRecord['result']['id_pd'];
									$record['id_pd'] = $id_pd;
									//print_r($data[$key_dictionary].' '.$data[$key_dictionary+1].' '.$record['id_pd'].'<br/>');
								}
							}
							else if($value_dictionary == 'id_sms')
							{
								if($data[$key_dictionary]=='10')
								{
									$prodi='Pendidikan Dokter';
								}
								else
								{
									if($data[$key_dictionary]=='01')
									{
										$prodi='Magister Manajemen';
									}
									else
									{
										if($data[$key_dictionary]=='21')
										{
											$prodi='Teknik Elektro';
										}
										else
										{
											if($data[$key_dictionary]=='22')
											{
												$prodi='Teknik Sipil';
											}
											else
											{
												if($data[$key_dictionary]=='24')
												{
													$prodi='Teknik Industri';
												}
												else
												{
													if($data[$key_dictionary]=='31')
													{
														$prodi='Manajemen';
													}
													else
													{
														if($data[$key_dictionary]=='32')
														{
															$prodi='Akuntansi';
														}
														else
														{
															if($data[$key_dictionary]=='41')
															{
																$prodi='Teknik Informatika';
															}
															else
															{
																if($data[$key_dictionary]=='42')
																{
																	$prodi='Sistem Informasi';
																}
																else
																{
																	if($data[$key_dictionary]=='50')
																	{
																		$prodi='Psikologi';
																	}
																	else
																	{
																		if($data[$key_dictionary]=='71')
																		{
																			$prodi='Sastra Inggris';
																		}
																		else
																		{
																			$prodi='Profesi Dokter';
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
								$id_smsRecord = ($ws->GetRecord('sms',"nm_lemb ilike '%{$prodi}%' AND website ilike '%ukrida.ac.id%'"));
								$id_sms = $id_smsRecord['result']['id_sms'];
								$record[$value_dictionary] = $id_sms;
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
			for($k = 0; $k<$i; $k++)
			{
				echo $run['result'][$k]['id_pd'];
			}
			//print_r($run);
			fclose($handle);
		}
	}
?>
