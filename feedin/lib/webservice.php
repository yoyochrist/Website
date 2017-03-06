<?php
	require('../nusoap/nusoap.php');
	require('../nusoap/class.wsdlcache.php');
	
	class webservice
	{

		private $token;
		private $host = "http://localhost:8082/ws/sandbox.php?wsdl"; //Experiment Link
		//private $host = "http://localhost:8082/ws/live.php?wsdl"; //Live Integration Link
		private $user = "031010";
		private $pass = "wacanamujayakrida";
		private $proxy;
		
		public function __construct()
		{
			$client = new nusoap_client($this->host,true);
			$this->proxy = $client->getProxy();
			
			//$result = $this->proxy->GetToken($this->user,$this->pass);
			$this->token = $this->proxy->GetToken($this->user,$this->pass);
			//print_r($this->proxy);exit();
		}
		
		//List Table in Feeder
		public function ListTable()
		{
			return $this->proxy->ListTable($this->token);
		}
		
		//Get Column Table in Feeder
		public function GetDictionary($table)
		{
			return $this->proxy->GetDictionary($this->token,$table);
		}
		
		//Get Record Table
		public function GetRecord($table,$filter)
		{
			return $this->proxy->GetRecord($this->token,$table,urldecode($filter));
		}
		
		//Get Record Set Table
		public function GetRecordSet($table,$filter,$order,$limit,$offset)
		{
			return $this->proxy->GetRecordSet($this->token,$table,urldecode($filter),$order,$limit,$offset);
		}
		
		//Get Record Set Table
		public function GetRecordSetUndecoded($table,$filter,$order,$limit,$offset)
		{
			return $this->proxy->GetRecordSet($this->token,$table,$filter,$order,$limit,$offset);
		}
		
		//Get Deleted Record Set Table
		public function GetDeletedRecordSet($table,$filter,$order,$limit,$offset)
		{
			return $this->proxy->GetDeletedRecordSet($this->token,$table,$table,$filter,$order,$limit,$offset);
		}
		
		//Get Count Record Set Table
		public function GetCountRecordSet($table,$filter)
		{
			return $this->proxy->GetCountRecordSet($this->token,$table,$filter);
		}
		
		//Get Count Deleted Record Set Table
		public function GetCountDeletedRecordSet($table,$filter)
		{
			return $this->proxy->GetCountDeletedRecordSet($this->token,$table,$filter);
		}
		
		//Get Student List
		public function GetListMahasiswa($filter,$order,$limit,$offset)
		{
			return $this->proxy->GetListMahasiswa($this->token,$filter,$order,$limit,$offset);
		}

		//Get Unregistered Student List
		public function GetListMahasiswaBelumRegistrasi($limit,$offset)
		{
			return $this->proxy->GetListMahasiswaBelumRegistrasi($this->token,$limit,$offset);
		}

		//Get Lecturer List
		public function GetListDosen($filter,$order,$limit,$offset)
		{
			return $this->proxy->GetListDosen($this->token,$filter,$order,$limit,$offset);
		}
		
		//Get Penugasan Dosen List
		public function GetListPenugasanDosen($filter,$order,$limit,$offset)
		{
			return $this->proxy->GetListPenugasanDosen($this->token,$filter,$order,$limit,$offset);
		}
		
		//Get Dosen Pembimbing List
		public function GetListDosenPembimbing($filter,$order,$limit,$offset)
		{
			return $this->proxy->GetListDosenPembimbing($this->token,$filter,$order,$limit,$offset);
		}

		//Get Dosen Pengajar List
		public function GetListDosenPengajar($filter,$order,$limit,$offset)
		{
			return $this->proxy->GetListDosenPengajar($this->token,$filter,$order,$limit,$offset);
		}

		//Get Deleted Record Set Table
		public function InsertRecord($table,$data)
		{
			return $this->proxy->InsertRecord($this->token,$table,$data);
		}
		
		//Get Deleted Record Set Table
		public function UpdateRecord($table,$data)
		{
			return $this->proxy->UpdateRecord($this->token,$table,$data);
		}
		
		//Get Deleted Record Set Table
		public function DeleteRecord($table,$data)
		{
			return $this->proxy->DeleteRecord($this->token,$table,$data);
		}
		
		//Get Deleted Record Set Table
		public function InsertRecordSet($table,$data)
		{
			return $this->proxy->InsertRecordSet($this->token,$table,$data);
		}
		
		//Get Deleted Record Set Table
		public function UpdateRecordSet($table,$data)
		{
			return $this->proxy->UpdateRecordSet($this->token,$table,$data);
		}
		
		//Get Deleted Record Set Table
		public function DeleteRecordSet($table,$data)
		{
			return $this->proxy->UpdateRecordSet($this->token,$table,$data);
		}
	}
?>
