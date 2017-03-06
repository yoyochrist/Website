<?php

include "../../inc/config.php";

include "../../lib/prosesupdate/ProgressUpdater.php";


	$data = file_get_contents('http://simak.uinsgd.ac.id/gtakademik/services/my_service/feeder_kelas.php?prodi='.$_GET['jurusan'].'&semester='.$_GET['sem'].'&ask=jumlah');

	  $dta = json_decode($data);
	  $jumlah = $dta->total;


	$sukses_count = 0;
	$sukses_msg = '';
	$error_count = 0;
	$error = array();



		$options = array(
		    'filename' => $_GET['jurusan'].'_progress.json',
		    'autoCalc' => true,
		    'totalStages' => 1
		);
		$new_pu = new Manticorp\ProgressUpdater($options);

		$datas = file_get_contents('http://simak.uinsgd.ac.id/gtakademik/services/my_service/feeder_kelas.php?prodi='.$_GET['jurusan'].'&semester='.$_GET['sem']);
	 		$data = json_decode($datas);
			//let's push first page
			$stageOptions = array(
			    'name' => 'Page $i',
			    'message' => 'Some Message',
			    'totalItems' => $jumlah,
			);

			$new_pu->nextStage($stageOptions);

			foreach ($data->data as $dt) {

			if ($dt->nama_kelas=='') {
					$nama_kelas = "01";
				} else {
					$nama_kelas = $dt->nama_kelas;
				}
				$check = $db->check_exist('kelas_kuliah',array('kode_mk' => $dt->kode_mk,'semester'=>$dt->semester,'nama_kelas'=>$dt->nama_kelas));
				if ($check==true) {
					$error_count++;
					$error[] = $dt->kode_mk." Sudah Ada";
				} else {
					$sukses_count++;
					$data = array(
					'semester' => $dt->semester,
					'kode_mk' => $dt->kode_mk,
					'nama_mk' => $dt->nama_mk,
					'nama_kelas' => $nama_kelas,
					'kode_jurusan' => $dt->kode_jurusan,
					);
					$in = $db->insert('kelas_kuliah',$data);
					$new_pu->incrementStageItems(1, true);
				}

		}

		$msg = '';
		if ((!$sukses_count==0) || (!$error_count==0)) {
			$msg =  "<div class=\"alert alert-warning \" role=\"alert\">
					<font color=\"#3c763d\">".$sukses_count." data Kelas baru berhasil ditambah</font><br />
					<font color=\"#ce4844\" >".$error_count." data tidak bisa ditambahkan </font>";
					
					if (!$error_count==0) {
						$msg .= "<a data-toggle=\"collapse\" href=\"#collapseExample\" aria-expanded=\"false\" aria-controls=\"collapseExample\">Detail error</a>";
					}
					//echo "<br />Total: ".$i." baris data";
					$msg .= "<div class=\"collapse\" id=\"collapseExample\">";
							$i=1;
							foreach ($error as $pesan) {
									$msg .= "<div class=\"bs-callout bs-callout-danger\">".$i.". ".$pesan."</div><br />";
								$i++;
								}
					$msg .= "</div>
				</div>";
		}

		$new_pu->totallyComplete($msg);


