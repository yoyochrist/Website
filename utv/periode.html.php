<body style="margin-left:20px;">
	<script src="periode.js"></script>
	<?php
		echo "<div style='
			position:relative;
			background:#f0f0f0;
			top:-10px;
			left:-20px;
			width:110%;
			padding: 0 0 0 20;
			text-align:center;
			height:100px;
			font-family:calibri;
			font-size:25px;
			color:#000000;
			text-shadow: 1px 1px #ffffff;
			box-shadow: 0px 0px 15px #555555;'>";
		echo "<table width=80% border=0 class=tablelogo>";
		$img = $img_dir."logout.png";
		echo "<tr><td align=left width=200><img src='../img/ukrida.png'></td><td><h2>Skill Lab</h2></td></tr>";
		echo "</table></div>";
	?>

	<a href="master.php" class="btn btn-primary">Data Master</a>
	<p><b>Langkah 1/3: Atur Periode dan Sesi</b><br/>
	<b style="color:orange">Langkah 2/3: Atur Subjek, Kompetensi dan Penguji</b><br/>
	<b style="color:red">Langkah 3/3: Pengaturan Selesai</b></p>
	<p><b>Periode Tersedia:</b></p>
	<p>
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" id="tambahPeriode" data-toggle="modal" data-target="#addPeriod">
			Tambah Periode
		</button>
	</p>
	<div class="row">
		<div class="col-md-9">
			<b>
				<div class="col-md-2">Kode Periode</div>
				<div class="col-md-4">Nama Periode</div>
				<div class="col-md-4">Tanggal Periode</div>
				<div class="col-md-2">Aksi</div>
			</b>
		</div>
		<div class="col-md-12" id="txtData">
		</div>
	</div>

	<p>Warna <font style="color:red">merah</font> menandakan ada sesi di dalamnya
	<br/>Warna hitam menandakan ada sesi di dalamnya dan dapat dihapus
	<br/>Klik salah satu dari periode untuk melihat sesi yang tersedia</p>
	<p>Kompetensi dapat ditambahkan setelah periode terisi sesi</p>

	<!-- Modal -->
	<div class="modal fade" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
						<span aria-hidden="true">&times;</span>		
					</button>
					<h3 class="modal-title" id="dataConfirmLabel">Menghapus Data</h3>
				</div>
				<div class="modal-body">
					<form id="dataConfirmDelete">
						<p class="message"></p>
						<input class="form-control" id="idClass" type="hidden" name="id" value="" />
						<input class="form-control" id="competentIdClass" type="hidden" name="competentID" value="" />
						<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
						<button class="btn btn-primary" type="submit" id="dataConfirmOK">Hapus</a>	
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="addPeriod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Tambah Periode</h4>
				</div>
				<div class="modal-body">
					<form id="formAddPeriod" method="" action="">
						<label>Nama Periode</label>
						<input class="form-control addPeriodName" type="text" name="name"/>
						<label>Tanggal Mulai</label>
						<input class="form-control addDateStart" type="date" name="date_start" value="<?php echo date('Y-m-d');?>"/>
						<label>Tanggal Berakhir</label>
						<input class="form-control addDateEnd" type="date" name="date_end" value="<?php echo date('Y-m-d');?>"/>
						<label>Subjek</label>
						<select class="form-control subjectList" name="subjekTambah">
							<option value="0">Pilih Kompetensi</option>
						</select>
						<div class="row">
							<div class="col-md-8"></div>
							<div class="col-md-4">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
								<button type="submit" class="btn btn-primary" id="btnAddPeriod">Tambah</button>	
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Template for Period -->
	<div class="row col-md-12 hidden" id="template">
		<div class="col-md-9 period-wrapper">
			<div class="col-md-2 period">
				<a href="#" class="session" id=""><b><div class="col-md-2 id"></div></b></a>
			</div>
			<div class="col-md-4"><a class="editPeriod" data-toggle="modal" data-target="">Ubah</a></div>
			<div class="col-md-4 date"></div>
			<div class="col-md-2">
				<a href="" class="btn btn-sm btn-primary hapusPeriod" data-toggle="modal" data-target="">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
			</div>
		</div>
	
		<div class="col-md-12 session-wrapper" style="margin-bottom:5px;">
			<div class="col-md-12 sessionTemplate" id="" >
			</div>
			<div class="row col-md-12">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary tambahSesi" data-toggle="modal" data-target="">
					Tambah Sesi
				</button>
			</div>
		</div>
	
		<!-- Modal -->
		<div class="modal fade editPeriodForm" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Ubah Periode</h4>
					</div>
					<div class="modal-body">
						<form class="formEditPeriod" id="" method="" action="">
							<label>Nama Periode</label>
							<input class="form-control editPeriodId" id="id" type="hidden" name="id" value=""/>
							<input class="form-control editPeriodNameField" id="name" type="text" name="name" value=""/>
							<label>Tanggal Mulai</label>
							<input class="form-control editPeriodDateStartField" id="date_start" type="date" name="date_start" value="">
							<label>Tanggal Berakhir</label>
							<input class="form-control editPeriodDateEndField" id="date_end" type="date" name="date_end" value=""/><br/>
							<div class="row">
								<div class="col-md-8"></div>
								<div class="col-md-4">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
									<button type="submit" class="btn btn-primary submitPeriod">Simpan</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade deletePeriodForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
							<span aria-hidden="true">&times;</span>		
						</button>
						<h3 class="modal-title">Menghapus Data</h3>
					</div>
					<div class="modal-body">
						<form class="formDeletePeriod">
							<p class="message">Anda yakin menghapus periode ini?</p>
							<input class="form-control periodIDClass" type="hidden" name="id" value="" />
							<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
							<button class="btn btn-primary" type="submit" id="btnDeletePeriod">Hapus</a>	
						</form>
					</div>
				</div>
			</div>
		</div>
	
		<!-- Modal -->
		<div class="modal fade addSession" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Tambah Sesi</h4>
					</div>
					<div class="modal-body">
						<form class="formAddSession" id="" action="" method="">
							<label>Kode/Nama Periode</label>
							<div class="pDesc"></div>
							<label>Nama Sesi</label>
							<input class="form-control periodID" type="hidden" name="id" value=""/>
							<input class="form-control" type="text" name="name" />
							<label>Waktu Mulai</label>
							<input class="form-control" type="datetime-local" name="date_start" value="<?php echo date('Y-m-d\TH:i');?>" />
							<label>Waktu Berakhir</label>
							<input class="form-control" type="datetime-local" name="date_end" value="<?php echo date('Y-m-d\TH:i');?>" />
							<label>Jumlah Lokasi</label>
							<input class="form-control" type="number" max="3" name="location" />
							<label>Jumlah Station per Lokasi</label>
							<input class="form-control" type="number" max="14" name="station" /><br/>
							<div class="row">
								<div class="col-md-8"></div>
								<div class="col-md-4">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
									<button type="submit" class="btn btn-primary addButtonSession">Tambah</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Template for Competent -->
	<div class="hidden" id="kompetensiTemplate">
		<div class="row hidden txtCompetent" id="">
			<div class="col-md-4">
				<a class="deskripsiKompetensi" data-toggle="modal"><b>Kompetensi</b></a>
			</div>
			<div class="col-md-6">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-sm btn-primary tambahKompetensi" data-toggle="modal" data-target="">
					Tambah
				</button>
	
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-sm btn-primary ubahKompetensi" data-toggle="modal" data-target="">
					Ubah
				</button>
			</div>
	
			<!-- Modal -->
			<div class="modal fade showDescription" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">Deskripsi Kompetensi</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-3"><b>Nama/Kode Sesi</b></div>
								<div class="pDesc col-md-9"></div>
							</div>
							<div class="row">
								<div class="col-md-3"><b>Subjek</b></div>
								<div class="subjectDesc col-md-9"></div>
							</div>
							<div class="row">
								<div class="col-md-12"><b>Daftar Kompetensi</b></div>
								<div class="row">
									<div class="col-md-1"></div>
									<div class="col-md-2">Nama</div>
									<div class="col-md-1">Bobot</div>
									<div class="col-md-8"></div>
								</div>
								<div class="kompetensiDesc">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	
			<!-- Modal -->
			<div class="modal fade addCompetency" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">Tambah Kompetensi</h4>
						</div>
						<div class="modal-body">
							<form class="formAddCompetency" id="" action="" method="">
								<label>Kode/Nama Sesi</label>
								<div class="pDesc"></div>
								<input class="form-control periodID" type="hidden" name="id" value=""/>
								<label>Kompetensi</label>
								<select class="form-control competentList" name="competentID">
									<option value="0">Pilih Kompetensi</option>
								</select>
								<input class="form-control" type="number" name="weight" value="" placeholder="Bobot"/>
								<div class="row">
									<div class="col-md-8"></div>
									<div class="col-md-4">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
										<button type="submit" class="btn btn-primary">Simpan</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	
			<!-- Modal -->
			<div class="modal fade editCompetency" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">Ubah Kompetensi</h4>
						</div>
						<div class="modal-body">
							<form class="formEditCompetency" id="" action="" method="">
								<label>Kode/Nama Sesi</label>
								<div class="pDesc"></div>
								<input class="form-control periodID" type="hidden" name="id" value=""/>
								<label>Kompetensi</label>
								<div class="col-md-12 editCompetencyForm"></div>
								<div class="row">
									<div class="col-md-8"></div>
									<div class="col-md-4">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
										<button type="submit" class="btn btn-primary">Simpan</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade deleteCompetencyForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
								<span aria-hidden="true">&times;</span>		
							</button>
							<h3 class="modal-title">Menghapus Data</h3>
						</div>
						<div class="modal-body">
							<form class="formDeleteCompetency">
								<p class="message">Anda yakin menghapus kompetensi ini?</p>
								<input class="form-control competentID" type="hidden" name="id" value="" />
								<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
								<button class="btn btn-primary" type="submit" id="btnDeletePeriod">Hapus</a>	
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Template for Competent in addCompetent Form Part -->
	<div class="hidden" id="competencyForm">
		<div class="row col-md-12 hidden txtCompetencyForm" id="">
			<div class="col-md-1">
				<input type="checkbox" class="competencyCheckbox" name="competentID[]" />
			</div>
			<div class="col-md-3">
				<div class="competencyName"></div>
			</div>
			<div class="col-md-8">
				<input type="text" class="form-control competencyTextbox" name="weight[]" />
			</div>
		</div>
	</div>
	
	<!-- Template for Competent in kompetensiDesc Part -->
	<div class="hidden" id="competencyDesc">
		<div class="row col-md-12 hidden txtCompetencyDesc" id="">
			<div class="col-md-3">
				<div class="competencyName"></div>
			</div>
			<div class="col-md-1">
				<div class="competencyWeight"></div>
			</div>
			<div class="col-md-8">
				<a href="" class="btn btn-sm btn-primary hapusKompetensi" data-toggle="modal">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
			</div>
			<div class="col-md-12">
				<div class="message"></div>
			</div>
		</div>
	</div>
	
	<!-- Template for Session -->
	<div class="hidden" id="sessionTemplate" data-id="">
		<div class="row col-md-12 hidden txtSession" id="">
			<hr/>
			<div class="col-md-1">
				<a href="#" class="location" id=""><b>SESSION</b></a>
			</div>
			<div class="col-md-1 sessionid"></div>
			<div class="col-md-2"><a class="editSession" data-toggle="modal" data-target=""></a></div>
			<div class="col-md-4 time"></div>
			<div class="col-md-1">
				<a class="btn btn-sm btn-primary hapusSession" data-toggle="modal" data-target="">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
			</div>
			<div class="col-md-3 kompetensiTemplate"></div>
			<div class="col-md-12 locationTemplate" id="" ></div>
	
			<!-- Modal -->
			<div class="modal fade editSessionForm" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">Edit Sesi</h4>
						</div>
						<div class="modal-body">
							<form class="formEditSession" id="" action="" method="">
								<input class="form-control editSessionId" type="hidden" name="id" value=""/>
								<label>Sesi</label>
								<input class="form-control editSessionNameField" type="text" name="name" value=""/>
								<label>Waktu Mulai</label>
								<input class="form-control editTimeStartField" type="datetime-local" name="date_start" value="">
								<label>Waktu Selesai</label>
								<input class="form-control editTimeEndField" type="datetime-local" name="date_end" value=""/>
								<div class="row">
									<div class="col-md-8"></div>
									<div class=col-md-4>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>	
										<button type="submit" class="btn btn-primary">Simpan</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade deleteSessionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
								<span aria-hidden="true">&times;</span>		
							</button>
							<h3 class="modal-title" id="dataConfirmLabel">Menghapus Data</h3>
						</div>
						<div class="modal-body">
							<form class="formDeleteSession">
								<p class="message">Anda yakin menghapus sesi ini?</p>
								<input class="form-control idSessionClass" type="hidden" name="id" value=""/>
								<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
								<button class="btn btn-primary" type="submit" id="btnDeleteSession">Hapus</a>	
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	

	<!-- Template for Location -->
	<div class="hidden" id="locationTemplate">
		<div class="row col-md-12 hidden txtLocation" id="">
			<hr/>
			<div class="col-md-1">
				<a href="#" class="station" id=""><b>LOCATION</b></a>
			</div>
			<div class="col-md-1 locationname"></div>
			<div class="col-md-2">
				<a class="btn btn-sm btn-primary hapusLokasi" data-toggle="modal" data-target="">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
				<button type="button" class="btn btn-sm btn-primary tambahStation" data-toggle="modal">
					Tambah Station
				</button>
			</div>
			<div class="col-md-12 stationTemplate"></div>
		
			<!-- Modal -->
			<div class="modal fade addStation" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">Tambah Station</h4>
						</div>
						<div class="modal-body">
							<form class="formAddStation">
								<div><b class="textLocationPeriod"></b></div>
								<div><b class="textLocationSession"></b></div>
								<div><b class="textLocationLocation"></b></div>
	
								<input class="form-control location_period_id" type="hidden" name="period_id" />
								<input class="form-control location_session_id" type="hidden" name="session_id" />
								<input class="form-control location_location_id" type="hidden" name="location_id" />
	
								<label>Station</label>
								<input class="form-control" type="number" max="14" name="station_id" /><br/>
								<div class="row">
									<div class="col-md-8"></div>
									<div class="col-md-4">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
										<button type="submit" class="btn btn-primary">Tambah</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade deleteLocationForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
								<span aria-hidden="true">&times;</span>		
							</button>
							<h3 class="modal-title" id="dataConfirmLabel">Menghapus Data</h3>
						</div>
						<div class="modal-body">
							<form class="formDeleteLocation">
								<p class="message">Anda yakin menghapus lokasi ini?</p>
								<input class="form-control idLocationClass" type="hidden" name="id" value=""/>
								<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
								<button class="btn btn-primary" type="submit" id="btnDeleteLocation">Hapus</a>	
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Template for Station -->
	<div class="hidden" id="stationTemplate">
		<div class="row col-md-12 hidden txtStation" id="">
			<div class="col-md-2 stationname"></div>
			<div class="col-md-4 lecturername"><a class="jadwalPenguji" data-toggle="modal"><a></div>
			<div class="col-md-3">
				<a class="btn btn-sm btn-primary hapusStation" data-toggle="modal" data-target="">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
			</div>

			<!-- Modal -->
			<div class="modal fade deleteStationForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
								<span aria-hidden="true">&times;</span>		
							</button>
							<h3 class="modal-title" id="dataConfirmLabel">Menghapus Data</h3>
						</div>
						<div class="modal-body">
							<form class="formDeleteStation">
								<p class="message">Anda yakin menghapus station ini?</p>
								<input class="form-control idStationClass" type="hidden" name="id" value="" />
								<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
								<button class="btn btn-primary" type="submit" id="btnDeleteStation">Hapus</a>	
							</form>
						</div>
					</div>
				</div>
			</div>
		
			<!-- Modal -->
			<div class="modal fade jadwalPengujiModal" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">Jadwalkan Penguji</h4>
						</div>
						<div class="modal-body">
							<form class="formAssignLecturer" id="" action="" method="">
								<input class="form-control text_transact_id" type="hidden" name="transact_id" />
								<label>Nomor Induk Dosen</label>
								<input class="form-control" type="text" name="lecturer_id" /><br/>
								<div class="row">
									<div class="col-md-8"></div>
									<div class="col-md-4">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
										<button type="submit" class="btn btn-primary">Jadwalkan</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
