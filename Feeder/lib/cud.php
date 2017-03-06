<?php
	require_once('webservice.php');
	
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

	function InsertRecordSet($table, $data)
	{
		$ws = new webservice();
		
		$ws->InsertRecordSet($table, $data);
	}
	
	function UpdateRecordSet($table, $data)
	{
		$ws = new webservice();
		
		$ws->UpdateRecordSet($table, $data);
	}
	
	function DeleteRecordSet($table, $data)
	{
		$ws = new webservice();
		
		$ws->DeleteRecordSet($table, $data);
	}
	
	function InsertRecord($table, $data)
	{
		$ws = new webservice();
		
		$ws->InsertRecord($table, $data);
	}
	
	function UpdateRecord($table, $data)
	{
		$ws = new webservice();
		
		$ws->UpdateRecord($table, $data);
	}
	
	function DeleteRecord($table, $data)
	{
		$ws = new webservice();
		
		$ws->DeleteRecord($table, $data);
	}
?>