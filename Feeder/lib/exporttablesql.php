<?php
	$table = $_GET['table'];
	
	// output headers so that the file is downloaded rather than displayed
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename="'.$table.'_export_'.date("Y-m-d").'.csv"');

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');
	
	$json_recordset = file_get_contents('http://192.168.14.211/Feeder/lib/table.php?f=GetDictionary&table='.$table);
	$val_recordset = json_decode($json_recordset, true);
	$getRecordset = $val_recordset['result'];

	foreach($getRecordset as $key_recordset => $value_recordset)
	{
		$getDictionary[] = $value_recordset['column_name'];
		$getType[] = $value_recordset['type'];;
	}
	
	foreach ($getDictionary as $key_dictionary => $value_dictionary){
		$columns[] = $value_dictionary;
	}
	
	
	foreach ($getType as $key_dictionary => $value_dictionary){
		$columns[] = $value_dictionary;
	}
	// output the column headings
	fputcsv($output, $columns);
?>