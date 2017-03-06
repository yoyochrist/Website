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
	
	function GetListMahasiswaWithoutConditionLimitOne()
	{
		$ws = new webservice();
		$filter = ""; //Condition SQL for example WHERE nama_pt LIKE '%UKRIDA%'
		$order = ""; //Order by column name for example student_id
		$limit = "1"; //Limit data
		$offset = ""; //For pagination
		
		print_r(json_encode($ws->GetListMahasiswa($filter,$order,$limit,$offset)));
	}
	
	function GetListMahasiswaWithoutCondition()
	{
		$ws = new webservice();
		$filter = ""; //Condition SQL for example WHERE nama_pt LIKE '%UKRIDA%'
		$order = ""; //Order by column name for example student_id
		$limit = ""; //Limit data
		$offset = ""; //For pagination
		
		print_r(json_encode($ws->GetListMahasiswa($filter,$order,$limit,$offset)));
	}
	
	function GetListMahasiswa()
	{
		$ws = new webservice();
		$filter = $_GET['filter']; //Condition SQL for example WHERE nama_pt LIKE '%UKRIDA%'
		$order = $_GET['order']; //Order by column name for example student_id
		$limit = $_GET['limit']; //Limit data
		$offset = $_GET['offset']; //For pagination
		
		print_r(json_encode($ws->GetListMahasiswa($filter,$order,$limit,$offset)));
	}
	
	function GetListMahasiswaBelumRegistrasiWithoutCondition()
	{
		$ws = new webservice();
		$limit = ""; //Limit data
		$offset = ""; //For pagination
		
		print_r(json_encode($ws->GetListMahasiswaBelumRegistrasi($limit,$offset)));
	}
	
	function GetListMahasiswaBelumRegistrasi()
	{
		$ws = new webservice();
		$limit = $_GET['limit']; //Limit data
		$offset = $_GET['offset']; //For pagination
		
		print_r(json_encode($ws->GetListMahasiswaBelumRegistrasi($limit,$offset)));
	}
?>