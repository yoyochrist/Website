<?php
	require_once('webservice.php');
	require_once('crud.php');
	
	$column_mahasiswa_feeder = array();
	$json_mahasiswa_recordset = file_get_contents('http://localhost/Feedin/lib/table.php?f=GetDictionary&table=mahasiswa');
	$val_mahasiswa_recordset = json_decode($json_mahasiswa_recordset, true);
	$getmahasiswaRecordset = $val_mahasiswa_recordset['result'];
	foreach($getmahasiswaRecordset as $key_recordset => $value_recordset)
	{
		$column_mahasiswa_feeder[] = $value_recordset["column_name"];
	}
	json_encode($column_mahasiswa_feeder);

	$ws = new webservice();
	$crud = new crud();
		
	$id_mahasiswaRecord = ($ws->GetRecordSet('mahasiswa',"","","",""));
	//echo json_encode($id_reg_pdRecord['result']);
	if(is_null($id_mahasiswaRecord['result']))
	{
	}
	else
	{
		//echo '<br/>';
		foreach($id_mahasiswaRecord['result'] as $array)
		{
			foreach($array as $key=>$value)
			{
				//echo $key.' '.$value;
				if($value != '' && $key != 'kd_mahasiswa')
				{
					if(in_array($key,$column_mahasiswa_feeder))
					{
						//echo '<br/>'.$key.' '.$value;
						$record[$key] = $value;
						//echo $value;
					}
				}
			}
			//echo json_encode($record);
			//$record_mahasiswa[] = $record;
			$run_mahasiswa = $crud->insert_array("mahasiswa",$record);
		}
		//echo json_encode($record_mahasiswa);
			
		//echo json_encode($run_mahasiswa);
		//$record['id_reg_pd'] = $id_reg_pd;
	}
?>