<?php
	require_once('webservice.php');
	require_once('crud.php');
	
	$column_kurikulum_feeder = array();
	$json_kurikulum_recordset = file_get_contents('http://localhost/Feedin/lib/table.php?f=GetDictionary&table=kurikulum');
	$val_kurikulum_recordset = json_decode($json_kurikulum_recordset, true);
	$getkurikulumRecordset = $val_kurikulum_recordset['result'];
	foreach($getkurikulumRecordset as $key_recordset => $value_recordset)
	{
		$column_kurikulum_feeder[] = $value_recordset["column_name"];
	}

	$ws = new webservice();
	$crud = new crud();
		
	$id_kurikulumRecord = ($ws->GetRecordSet('kurikulum',"","","",""));
	//echo json_encode($id_klsRecord['result']);
	if(is_null($id_kurikulumRecord['result']))
	{
	}
	else
	{
		//echo '<br/>';
		foreach($id_kurikulumRecord['result'] as $array)
		{
			foreach($array as $key=>$value)
			{
				//echo $key.' '.$value;
				if($value != '' && $key != 'id_kurikulum')
				{
					if(in_array($key,$column_kurikulum_feeder))
					{
						//echo '<br/>'.$key.' '.$value;
						$record[$key] = $value;
						//echo $value;
					}
				}
			}
			//echo json_encode($record);
			//$record_kelas[] = $record;
			$run_kelas = $crud->insert_array("kurikulum",$record);
		}
		//echo json_encode($record_kelas);
			
		//echo json_encode($run_kelas);
		//$record['id_kls'] = $id_kls;
	}
?>