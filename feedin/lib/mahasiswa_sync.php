<?php
	include('webservice.php');
	include('crud.php');
	
	$crud = new crud();
	$ws = new webservice();
	$table="mahasiswa";
	
	//Get Feeder Column
	$json_recordset = file_get_contents('http://localhost/Feedin/lib/table.php?f=GetDictionary&table='.$table);
	$val_recordset = json_decode($json_recordset, true);
	$getRecordset = $val_recordset['result'];
	foreach($getRecordset as $key_recordset => $value_recordset)
	{
		$column_feeder[] = $value_recordset["column_name"];
	}
	//echo json_encode($column_feeder);
	
	//Get Data from Database
	$condition = array("id_pd" => "null");
	$recordset = $crud->select_array($table,$condition);
	//print_r($record);
	
	$rows = json_decode($recordset,true);
	$data = $rows['data'];
	//print_r($data);
	$i=0;
	
	for($j = 0; $j < count($data); $j++)
	{
		//$array = $data[$j];
		foreach($data[$j] as $column =>$column_value)
		{
			if($column_value != '' && $column != 'kd_'.$table)
			{
				if(in_array($column,$column_feeder))
				{
					//echo '<br/>'.$column.' '.$column_value;
					$record[$column] = $column_value;
				}
			}
			else
			{
				if($column == 'kd_'.$table)
				{
					$key = $column_value;
				}
			}
		}
		$keys[] = $key; //It's must because can't get array like $primary_key[] declaration in foreach($data[$j] as $column =>$column_value)
		$records[] = $record;
	}
	//print_r($keys);
		
	//print_r(json_encode($records));
	$run = $ws->InsertRecordSet($table,json_encode($records));
	//print_r($run);
	
	for($k = 0;$k<count($data);$k++)
	{
		$update = $crud->execute("UPDATE `".$table."` SET `id_pd` = '".$run['result'][$k]['id_pd']."' WHERE kd_".$table." = '".$keys[$k]."'");
		//echo $run['result'][$k]['id_pd'];
	}
?>