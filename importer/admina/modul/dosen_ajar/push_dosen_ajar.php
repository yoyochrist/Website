<?php
//include "inc/config.php";
include "../../lib/nusoap/nusoap.php";

include "../../inc/config.php";

include "../../lib/prosesupdate/ProgressUpdater.php";


$config = $db->fetch_single_row('config_user','id',1);

if ($config->live=='Y') {
	$url = 'http://'.$config->url.':'.$config->port.'/ws/live.php?wsdl'; // gunakan live
} else {
	$url = 'http://'.$config->url.':'.$config->port.'/ws/sandbox.php?wsdl'; // gunakan sandbox
}
//untuk coba-coba
// $url = 'http://pddikti.uinsgd.ac.id:8082/ws/live.php?wsdl'; // gunakan live bila

$client = new nusoap_client($url, true);
$proxy = $client->getProxy();



# MENDAPATKAN TOKEN
$username = $config->username;
$password = $config->password;
$result = $proxy->GetToken($username, $password);
$token = $result;

//$token = 'acdbbc82c3b29f99e9096dab1d5eafb4';


	$id_sms = '';
	$id_mk = '';
	$id_reg_ptk = '';
	$nidn = '';
	$id_ptk = '';
	$sks_mk = '';
	$sks_tm = '';
	$sks_prak = '';
	$sks_prak_lap = '';
	$sks_sim = '';
	$temp_data = array();
	$sukses_count = 0;
	$sukses_msg = '';
	$error_count = 0;
	$error_msg = array();
	$temp_result = array();

	//get id npsn
	$filter_sp = "npsn='".$config->id_sp."'";
	$get_id_sp = $proxy->GetRecord($token,'satuan_pendidikan',$filter_sp);

	$id_sp = $get_id_sp['result']['id_sp'];

$table1 = 'kelas_kuliah';

	$arr_data = $db->fetch_custom("select ajar_dosen.id as id_dosen_ajar,ajar_dosen.*,jurusan.kode_jurusan from ajar_dosen inner join jurusan on ajar_dosen.kode_jurusan=jurusan.kode_jurusan where jurusan.kode_jurusan='".$_GET['jurusan']."' and ajar_dosen.semester='".$_GET['sem']."' and status_error!=1 and nidn!=''");

	//print_r($arr_data);

/*	$arr_data = $db->fetch_custom("select kelas_kuliah.*,jurusan.kode_jurusan from kelas_kuliah inner join jurusan on kelas_kuliah.kode_jurusan=jurusan.kode_jurusan where jurusan.kode_jurusan='705' and kelas_kuliah.semester='20141' limit 5,5");
*/



$options = array(
    'filename' => $_GET['jurusan'].'_progress.json',
    'autoCalc' => true,
    'totalStages' => 1
);
$pu = new Manticorp\ProgressUpdater($options);



$stageOptions = array(
    'name' => 'This AJAX process takes a long time',
    'message' => 'But this will keep the user updated on it\'s actual progress!',
    'totalItems' => $arr_data->rowCount(),
);


$pu->nextStage($stageOptions);



$i=1;



	foreach ($arr_data as $value) {

		//print_r($value);
		$nidn = $value->nidn;
		$kode_mk = $value->kode_mk;
		$kelas = $value->nama_kelas;
		$ren_tm = $value->rencana_tatap_muka;
		$rel_tm = $value->tatap_muka_real;
		$semester = $value->semester;

		$kode_prodi = $value->kode_jurusan;

		$filter_ptk = "p.id_sp='".$id_sp."' and p.kode_prodi='".$kode_prodi."'";
		$temp_ptk = $proxy->GetRecord($token,'sms',$filter_ptk);
		if ($temp_ptk['result']) {
			$id_sms = $temp_ptk['result']['id_sms'];
		}



		$filter_nidn = "nidn='".$nidn."'";
		$temp_nidn = $proxy->GetRecord($token,'dosen',$filter_nidn);

		if ($temp_nidn['result']) {
			$id_sdm = $temp_nidn['result']['id_sdm'];
			
		} else {
			$id_sdm = "";
		}

		if ($id_sdm=="") {
		++$error_count;
							$db->update('ajar_dosen',array('status_error' => 2, 'keterangan'=>"<b>NIDN tidak terdaftar di feeder</b>"),'id',$value->id_dosen_ajar);
							$error_msg[] = "<b>NIDN tidak terdaftar di feeder</b>";
		}

		else {

			$filter_ptk = "p.id_sdm='".$id_sdm."'";
		$temp_ptk = $proxy->GetRecord($token,'dosen_pt',$filter_ptk);
		if ($temp_ptk['result']) {
			$id_reg_ptk = $temp_ptk['result']['id_reg_ptk'];

		}

		

		//Filter 
		$filter_mk = "p.id_sms='".$id_sms."' and kode_mk='".$kode_mk."'";
		$temp_mk = $proxy->GetRecord($token,'mata_kuliah',$filter_mk);
		if ($temp_mk['result']) {
			$id_mk = $temp_mk['result']['id_mk'];
			$sks_mk = $temp_mk['result']['sks_mk'];

		}

	

		//Filter kelas kuliah
		$filter_kls = "p.id_mk='".$id_mk."' AND nm_kls='".$kelas."' AND p.id_smt='".$semester."'";
		$temp_kls = $proxy->GetRecord($token,$table1,$filter_kls);

		if (empty($temp_kls['result'])) {
				++$error_count;
				$db->update('ajar_dosen',array('status_error' => 2, 'keterangan'=>"Error, Pastikan Kelas $kode_mk $kelas Sudah dibuat "),'id',$value->id_dosen_ajar);
				$error_msg[] = "Error, Pastikan Kelas $kode_mk $kelas Sudah dibuat ";
		} else {

			$id_kls = $temp_kls['result']['id_kls'];

			$filter_check = "p.id_reg_ptk='".$id_reg_ptk."' and p.id_kls='".$id_kls."'";
			$check = $proxy->GetRecord($token,'ajar_dosen',$filter_check);

			if (empty($check['result'])) {

							$temp_data = array('id_reg_ptk' => $id_reg_ptk,
								 'id_kls' => $id_kls,
						  'sks_subst_tot' => $sks_mk,
						   'sks_tm_subst' => 0,
				  		 'sks_prak_subst' => 0,
				  	 'sks_prak_lap_subst' => 0,
				  	 	  'sks_sim_subst' => 0,
				  	 		'jml_tm_renc' => $ren_tm,
				  	 		'jml_tm_real' => $rel_tm,
				  	 		'id_jns_eval' => 1
				);


				$temp_result = $proxy->InsertRecord($token, "ajar_dosen", json_encode($temp_data));

						if ($temp_result['result']['error_desc']==NULL) {
							++$sukses_count;
							$db->update('ajar_dosen',array('status_error'=>1,'keterangan'=>''),'id',$value->id_dosen_ajar);
						} else {
							++$error_count;
							$db->update('ajar_dosen',array('status_error' => 2, 'keterangan'=>"<b>Error, Pastikan Kelas $kode_mk $kelas Sudah dibuat </b>".$temp_result['result']['error_desc']),'id',$value->id_dosen_ajar);
							$error_msg[] = "<b>Error, Pastikan Kelas $kode_mk $kelas Sudah dibuat </b>".$temp_result['result']['error_desc'];
						}
				
			} else {
				++$error_count;
				$db->update('ajar_dosen',array('status_error' => 2, 'keterangan'=>"Dosen ini sudah ada dikelas"),'id',$value->id_dosen_ajar);
				$error_msg[] = "<b>Error</b>, Dosen ini sudah ada dikelas";

			}

		}


		}

		

		
$i++;
 $pu->incrementStageItems(1, true);


	}


$msg = '';
	$msg =  "<div class=\"alert alert-warning\" role=\"alert\">
			<font color=\"#3c763d\">".$sukses_count." data Dosen Ajar baru berhasil ditambah</font><br />
			<font color=\"#ce4844\" >".$error_count." data tidak bisa ditambahkan </font>";
			if (!$error_count==0) {
				$msg .= "<a data-toggle=\"collapse\" href=\"#collapseExample\" aria-expanded=\"false\" aria-controls=\"collapseExample\">Detail error</a>";
			}
			//echo "<br />Total: ".$i." baris data";
			$msg .= "<div class=\"collapse\" id=\"collapseExample\">";
					$i=1;
					foreach ($error_msg as $pesan) {
							$msg .= "<div class=\"bs-callout bs-callout-danger\">".$i.". ".$pesan."</div><br />";
						$i++;
						}
			$msg .= "</div>
		</div>";


//echo $msg;

$pu->totallyComplete($msg);


