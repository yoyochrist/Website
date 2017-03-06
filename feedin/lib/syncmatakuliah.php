<?php
	require_once('webservice.php');
	require_once('crud.php');
	
	$column_mk_feeder = array();
	$json_mk_recordset = file_get_contents('http://localhost/Feedin/lib/table.php?f=GetDictionary&table=mata_kuliah');
	$val_mk_recordset = json_decode($json_mk_recordset, true);
	$getMKRecordset = $val_mk_recordset['result'];
	foreach($getMKRecordset as $key_recordset => $value_recordset)
	{
		$column_mk_feeder[] = $value_recordset["column_name"];
	}

	$ws = new webservice();
	$crud = new crud();
		
	$id_mkRecord = ($ws->GetRecordSet('mata_kuliah',"kode_mk ilike '%SKL%'","","",""));
	//echo json_encode($id_klsRecord['result']);
	if(is_null($id_mkRecord['result']))
	{
	}
	else
	{
		//echo '<br/>';
		foreach($id_mkRecord['result'] as $array)
		{
			foreach($array as $key=>$value)
			{
				//echo $key.' '.$value;
				if($value != '' && $key != 'kd_mk')
				{
					if(in_array($key,$column_mk_feeder))
					{
						//echo '<br/>'.$key.' '.$value;
						if()
						{
							
						}
						else
						{
							$record[$key] = $value;
						}
						//echo $value;
					}
				}
			}
			//echo json_encode($record);
			//$record_kelas[] = $record;
			$run_kelas = $crud->insert_array("mata_kuliah",$record);
		}
		//echo json_encode($record_kelas);
			
		//echo json_encode($run_kelas);
		//$record['id_kls'] = $id_kls;
	}
?>