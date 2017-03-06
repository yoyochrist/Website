<?php
	require_once('webservice.php');
	require_once('crud.php');
	
	$column_sms_feeder = array();
	$json_sms_recordset = file_get_contents('http://localhost/Feedin/lib/table.php?f=GetDictionary&table=satuan_pendidikan');
	$val_sms_recordset = json_decode($json_sms_recordset, true);
	$getsmsRecordset = $val_sms_recordset['result'];
	foreach($getsmsRecordset as $key_recordset => $value_recordset)
	{
		$column_sms_feeder[] = $value_recordset["column_name"];
	}

	$ws = new webservice();
	$crud = new crud();
		
	$id_smsRecord = ($ws->GetRecordSet('satuan_pendidikan',"","","",""));
	//echo json_encode($id_smsRecord);
	//echo json_encode($id_klsRecord['result']);
	if(is_null($id_smsRecord['result']))
	{
	}
	else
	{
		//echo '<br/>';
		foreach($id_smsRecord['result'] as $array)
		{
			foreach($array as $key=>$value)
			{
				//echo $key.' '.$value;
				if($value != '')
				{
					if(in_array($key,$column_sms_feeder))
					{
						//echo '<br/>'.$key.' '.$value;
						$record[$key] = $value;
						//echo $value;
					}
				}
			}
			//echo json_encode($record);
			//$record_kelas[] = $record;
			$run_kelas = $crud->insert_array("satuan_pendidikan",$record);
		}
		//echo json_encode($record_kelas);
			
		//echo json_encode($run_kelas);
		//$record['id_kls'] = $id_kls;
	}
?>