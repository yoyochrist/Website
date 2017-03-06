<?php
	require_once('webservice.php');
	
	if(isset($_GET['f']) && function_exists($_GET['f'])) {
		/*if($_GET['id'])
		{
			$_GET['f']($_GET['id']);
		}
		else*/
		{
			$_GET['f']();
		}
	}
	
	function ListTable()
	{
		$ws = new webservice();
		
		print_r(json_encode($ws->ListTable()));
	}
	
	function GetDictionary()
	{
		$ws = new webservice();
		$table = $_GET['table'];
		
		print_r(json_encode($ws->GetDictionary($table)));
	}

	//function GetRecord($table, $filter)
	function GetRecord()
	{
		$ws = new webservice();
		$table = $_POST['table']; //Table Name
		//$table = "mahasiswa_pt"; //Table Name
		$filter = $_POST['filter']; //Condition SQL for example WHERE nama_pt LIKE '%UKRIDA%'
		//$filter = "nipd ilike '%412012001%'"; //Condition SQL for example WHERE nama_pt LIKE '%UKRIDA%'
		
		//print_r(json_encode($ws->GetRecord($table,$filter)));
		return (($ws->GetRecord($table,$filter)));
	}
	
	function GetListPenugasanDosen()
	{
		$ws = new webservice();
		$filter = ""; //Condition SQL for example WHERE nama_pt LIKE '%UKRIDA%'
		$order = ""; //Order by column name for example student_id
		$limit = "1"; //Limit data
		$offset = ""; //For pagination
		
		//print_r(json_encode($ws->GetListPenugasanDosen($filter,$order,$limit,$offset)));
		return (($ws->GetListPenugasanDosen($filter,$order,$limit,$offset)));
	}
	
	function GetRecordSetWithoutConditionLimitOne()
	{
		$ws = new webservice();
		$table = $_GET['table']; //Table Name
		$filter = ""; //Condition SQL for example WHERE nama_pt LIKE '%UKRIDA%'
		$order = ""; //Order by column name for example student_id
		$limit = "1"; //Limit data
		$offset = ""; //For pagination
		
		print_r(json_encode($ws->GetRecordSet($table,$filter,$order,$limit,$offset)));
	}
	
	function GetRecordSetWithoutCondition()
	{
		$ws = new webservice();
		$table = $_GET['table']; //Table Name
		//$filter = "id_mk = '07be083f-540f-4df2-8a3d-1ff9f95ac280'"; //Condition SQL for example WHERE nama_pt LIKE '%UKRIDA%'
		$filter = ""; //Condition SQL for example WHERE nama_pt LIKE '%UKRIDA%'
		//$order = "nipd"; //Order by column name for example student_id
		$order = ""; //Order by column name for example student_id
		$limit = "1000"; //Limit data
		$offset = ""; //For pagination
		
		print_r(json_encode($ws->GetRecordSet($table,$filter,$order,$limit,$offset)));
	}
	
	function GetRecordSetFullEngine($table, $filter, $order, $limit, $offset)
	{
		$ws = new webservice();
		$table = $_POST['table']; //Table Name
		$filter = $_POST['filter']; //Condition SQL for example WHERE nama_pt LIKE '%UKRIDA%'
		$order = $_POST['order']; //Order by column name for example student_id
		$limit = $_POST['limit']; //Limit data
		$offset = $_POST['offset']; //For pagination
		
		//print_r(json_encode($ws->GetRecordSet($table,$filter,$order,$limit,$offset)));
		return (($ws->GetRecordSet($table,$filter,$order,$limit,$offset)));
	}
	
	function GetRecordSet($table, $filter)
	{
		$ws = new webservice();
		$table = $_POST['table']; //Table Name
		$filter = $_POST['filter']; //Condition SQL for example WHERE nama_pt LIKE '%UKRIDA%'
		$order = ""; //Order by column name for example student_id
		$limit = ""; //Limit data
		$offset = ""; //For pagination
		
		//print_r(json_encode($ws->GetRecordSet($table,$filter,$order,$limit,$offset)));
		return (($ws->GetRecordSet($table,$filter,$order,$limit,$offset)));
	}
?>