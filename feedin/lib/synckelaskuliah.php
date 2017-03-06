<?php
	require_once('webservice.php');
	require_once('crud.php');
	
	$column_kelas_feeder = array();
	$json_kelas_recordset = file_get_contents('http://localhost/Feedin/lib/table.php?f=GetDictionary&table=kelas_kuliah');
	$val_kelas_recordset = json_decode($json_kelas_recordset, true);
	$getKelasRecordset = $val_kelas_recordset['result'];
	foreach($getKelasRecordset as $key_recordset => $value_recordset)
	{
		$column_kelas_feeder[] = $value_recordset["column_name"];
	}

	$ws = new webservice();
	$crud = new crud();
		
	$id_klsRecord = ($ws->GetRecordSet('kelas_kuliah',"kode_mk ilike 'TET%'","","",""));
	//echo json_encode($id_klsRecord['result']);
	if(is_null($id_klsRecord['result']))
	{
	}
	else
	{
		//echo '<br/>';
		foreach($id_klsRecord['result'] as $array)
		{
			foreach($array as $key=>$value)
			{
				//echo $key.' '.$value;
				if($value != '' && $key != 'id_kelas')
				{
					if(in_array($key,$column_kelas_feeder))
					{
						//echo '<br/>'.$key.' '.$value;
						$record[$key] = $value;
						//echo $value;
					}
				}
			}
			//echo json_encode($record);
			//$record_kelas[] = $record;
			$run_kelas = $crud->insert_array("kelas_kuliah",$record);
		}
		//echo json_encode($record_kelas);
			
		//echo json_encode($run_kelas);
		//$record['id_kls'] = $id_kls;
	}
?>