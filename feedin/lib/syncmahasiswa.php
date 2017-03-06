<?php
	require_once('webservice.php');
	require_once('crud.php');
	
	class syncmahasiswa
	{
		private $column_mahasiswa_feeder = array();
		private $column_mahasiswapt_feeder = array();
		
		public function __construct()
		{
			$json_mahasiswa_recordset = file_get_contents('http://localhost/Feedin/lib/table.php?f=GetDictionary&table=mahasiswa');
			$val_mahasiswa_recordset = json_decode($json_mahasiswa_recordset, true);
			$getMahasiswaRecordset = $val_mahasiswa_recordset['result'];
			foreach($getMahasiswaRecordset as $key_recordset => $value_recordset)
			{
				$this->column_mahasiswa_feeder[] = $value_recordset["column_name"];
			}
			
			$json_mahasiswapt_recordset = file_get_contents('http://localhost/Feedin/lib/table.php?f=GetDictionary&table=mahasiswa_pt');
			$val_mahasiswapt_recordset = json_decode($json_mahasiswapt_recordset, true);
			$getMahasiswaptRecordset = $val_mahasiswapt_recordset['result'];
			foreach($getMahasiswaptRecordset as $key_recordset => $value_recordset)
			{
				$this->column_mahasiswapt_feeder[] = $value_recordset["column_name"];
			}
		}
		
		function synchronize_mahasiswa($nim)
		{
			$ws = new webservice();
			$crud = new crud();
			
			$id_reg_pdRecord = ($ws->GetRecord('mahasiswa_pt',"nipd ilike '{$nim}%'"));
			if(is_null($id_reg_pdRecord['result']['id_reg_pd']))
			{
			}
			else
			{
				$id_reg_pd = $id_reg_pdRecord['result']['id_reg_pd'];
				//echo $id_reg_pdRecord['result']['id_pd'];
				$record_pd = ($ws->GetRecord('mahasiswa',"id_pd = '{$id_reg_pdRecord['result']['id_pd']}'"));
				
				foreach($record_pd['result'] as $key =>$value)
				{
					if($value != '' && $key != 'kd_mahasiswa')
					{
						if(in_array($key,$this->column_mahasiswa_feeder))
						{
							//echo '<br/>'.$key.' '.$value;
							$record_mahasiswa[$key] = $value;
						}
					}
				}
				$run_mahasiswa = $crud->insert_array("mahasiswa",$record_mahasiswa);
				
				//echo '<br/>';
				foreach($id_reg_pdRecord['result'] as $key =>$value)
				{
					if($value != '' && $key != 'kd_mahasiswa')
					{
						if(in_array($key,$this->column_mahasiswapt_feeder))
						{
							//echo '<br/>'.$key.' '.$value;
							$record_mahasiswa_pt[$key] = $value;
						}
					}
				}
				$run_mahasiswa_pt = $crud->insert_array("mahasiswa_pt",$record_mahasiswa_pt);
				//echo json_encode($record_pd);
				//$record['id_reg_pd'] = $id_reg_pd;
				return $id_reg_pd;
			}
		}
	}
?>