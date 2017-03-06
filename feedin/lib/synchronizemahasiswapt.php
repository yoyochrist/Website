<?php
	require_once('webservice.php');
	require_once('crud.php');
	
	$column_mahasiswa_pt_feeder = array();
	$json_mahasiswa_pt_recordset = file_get_contents('http://localhost/Feedin/lib/table.php?f=GetDictionary&table=mahasiswa_pt');
	$val_mahasiswa_pt_recordset = json_decode($json_mahasiswa_pt_recordset, true);
	$getmahasiswa_ptRecordset = $val_mahasiswa_pt_recordset['result'];
	foreach($getmahasiswa_ptRecordset as $key_recordset => $value_recordset)
	{
		$column_mahasiswa_pt_feeder[] = $value_recordset["column_name"];
	}

	$ws = new webservice();
	$crud = new crud();
		
	$id_mahasiswa_ptRecord = ($ws->GetRecordSet('mahasiswa_pt',"nipd ilike '%{2010}%'","","",""));
	//echo json_encode($id_reg_pdRecord['result']);
	if(is_null($id_mahasiswa_ptRecord['result']))
	{
	}
	else
	{
		//echo '<br/>';
		foreach($id_mahasiswa_ptRecord['result'] as $array)
		{
			foreach($array as $key=>$value)
			{
				//echo $key.' '.$value;
				if($value != '' && $key != 'kd_mahasiswa_pt')
				{
					if(in_array($key,$column_mahasiswa_pt_feeder))
					{
						//echo '<br/>'.$key.' '.$value;
						$record[$key] = $value;
						//echo $value;
					}
				}
			}
			//echo json_encode($record);
			//$record_mahasiswa_pt[] = $record;
			$run_mahasiswa_pt = $crud->insert_array("mahasiswa_pt",$record);
		}
		//echo json_encode($record_mahasiswa_pt);
			
		//echo json_encode($run_mahasiswa_pt);
		//$record['id_reg_pd'] = $id_reg_pd;
	}
?>