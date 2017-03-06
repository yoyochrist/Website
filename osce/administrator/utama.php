<body>
	<div id="wrapper">
		<div class="row">
			<div id="wrapper_header">
				<div id="banner">
					<?php include ("content/banner.php");?>
				</div>
	    		</div>
		</div>
		<div class="row">
			<!--bagian utama--> 
			<div id="wrapper_main">
				<div class="col-md-2" id="nav"><!--id="wrapper_nav">-->
					<?php include("nav.php");?>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-9"><!--id="wrapper_admin">-->
					<?php
						if (isset($_GET['mod'])){
							$mod = $_GET['mod'];
							switch($mod) 
							{
								//case master
								case 'main' : $isi='subjek/subjek.php';
									break;
								case 'sub' : $isi='subjek/subjek.php';
									break;
								case 'mhs' : $isi='partisipasi/partisipan.php';
									break;
								case 'slnla' : $isi='skilllab/penilaian.php';
									break;
								case 'srnla' : $isi='semester/penilaian.php';
									break;
								case 'per' : $isi='periode/periode.php';
									break;
								case 'ses' : $isi='sesi/sesi.php';
									break;
								case 'sesdet' : $isi='sesi/sesi_detil.php';
									break;
								case 'lec' : $isi='pengajar/pengajar.php';
									break;
								case 'rep' : $isi='laporan/utama.php';
									break;
								case 'repses' : $isi='laporan/laporansesi.php';
									break;
								case 'que' : $isi='pertanyaan/pertanyaan.php';
									break;
								case 'srgen' : $isi='semester/generate_student.php';
									break;
								case 'srwei' : $isi='semester/bobot_nilai.php';
									break;
								case 'passwd' : $isi='setting/password.php';
									break;

								//case input
								case 'lecin' : $isi='pengajar/input_pengajar.php';
									break;
								case 'sesin' : $isi='sesi/input_sesi.php';
									break;
								case 'sesmhs' : $isi='sesi/input_mahasiswa.php';
									break;
								case 'perin' : $isi='periode/input_periode.php';
									break;
								case 'subin' : $isi='subjek/input_subjek.php';
									break;
								case 'mhsin' : $isi='partisipasi/input_partisipan.php';
									break;
								case 'quein' : $isi='pertanyaan/input_pertanyaan.php';
									break;
								case 'sraslecin' : $isi='semester/assign_dosen.php';
									break;

								//case update
								case 'perup' : $isi='periode/update_periode.php';
									break;
								case 'subup' : $isi='subjek/update_subjek.php';
									break;
								case 'sesup' : $isi='sesi/update_sesi.php';
									break;
								case 'queup' : $isi='pertanyaan/update_pertanyaan.php';
									break;
								case 'lecup' : $isi='pengajar/update_pengajar.php';
									break;
								case 'sruplec' : $isi='semester/ganti_dosen.php';
									break;
								case 'sluplec' : $isi='skilllab/ganti_dosen.php';
									break;

								//case aksi_input
								case 'perinact' : $isi='periode/periode_aksi.php';
									break;
								case 'sesinact' : $isi='sesi/sesi_aksi.php';
									break;
								case 'subinact' : $isi='subjek/subjek_aksi.php';
									break;
								case 'mhsinact': $isi='partisipasi/partisipan_aksi.php';
									break;
								case 'sesmhsin'	: $isi='sesi/aksi_mahasiswa.php';
									break;
								case 'lecinact' : $isi='pengajar/pengajar_aksi.php';
									break;
								case 'geninact' : $isi='semester/generate_student_aksi.php';
									break;
								case 'weiact'	: $isi='semester/bobot_nilai_aksi.php';
									break;

								//case aksi_ubah
								case 'perupact' : $isi='periode/periode_update_aksi.php';
									break;
								case 'pswdact' : $isi='setting/password_aksi.php';
									break;
								case 'subupact' : $isi='subjek/subjek_update_aksi.php';
									break;
								case 'sesupact' : $isi='sesi/sesi_update_aksi.php';
									break;
								case 'sraslecinact' : $isi='semester/assign_dosen_aksi.php';
									break;
								case 'sruplecact' : $isi='semester/ganti_dosen_aksi.php';
									break;
								case 'sluplecact' : $isi='skilllab/ganti_dosen_aksi.php';
									break;

								//case aksi hapus
								case 'sesdel' : $isi='sesi/sesi_delete.php';
									break;
								case 'subdel' : $isi='subjek/subjek_delete.php';
									break;
								case 'perdel' : $isi='periode/periode_delete.php';
									break;
								case 'mhsdel' : $isi='partisipasi/partisipan_delete.php';
									break;
								case 'lecdel' : $isi='pengajar/pengajar_delete.php';
									break;
								case 'quedel' : $isi='pertanyaan/pertanyaan_delete.php';
									break;
								default	: $isi='subjek/subjek.php';
									break;
	
								//case import csv
								case 'komcsv' : $isi='skilllab/csv.php';
									break;
								case 'parcsv' : $isi='partisipasi/csv.php';
									break;
								//case aksi import csv
								case 'komcsvact' : $isi='skilllab/csv_aksi.php';
									break;
								case 'parcsvact' : $isi='partisipasi/csv_aksi.php';
									break;
								//case aksi export csv
							}
						}
					else
						$isi='registrasi.php';
					?>
					<?php include($isi);?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="clear"></div>
			<div id="wrapper_footer" class="clear">
				<?php include('content/footer.php'); ?>
			</div>
		</div>
	</div>
</body>
