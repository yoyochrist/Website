<script src="guide.js"></script>


<div>
	<div class="spacer"></div>
    <div align="center"><p>Selamat datang di menu Administrator. Berikut adalah panduan langkah per langkah untuk pengaturan Tes Skill Lab.</p></div>
	<div class="panel panel-info class">
      <div class="panel-heading"><h4><strong>1 - Tambah Periode dan Subyek</h4></strong></div>
      <div class="panel-body">
      	<p>You'll need your email address and last name to create your Turnitin account password and set your security information; this information can be found in your welcome email. You can then log into Turnitin and begin customizing your account.</p>
      <!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" id="tambahPeriode" data-toggle="modal" data-target="#addPeriod">Tambah</button>
      </div>
    </div>
    <div class="spacer"></div>
    <div class="panel panel-info class">
      <div class="panel-heading"><h4><strong>2 - Tambah Sesi</h4></strong></div>
      <div class="panel-body"><p>You'll need your email address and last name to create your Turnitin account password and set your security information; this information can be found in your welcome email. You can then log into Turnitin and begin customizing your account.</p>
      <button type="button" class="btn btn-primary" id="tambahSesi" data-toggle="modal" data-target="#addSession">Tambah</button>
      </div>
    </div>
    <div class="spacer"></div>
   <div class="panel panel-info class">
      <div class="panel-heading"><h4><strong>3 - Pengaturan Subjek, Kompetensi dan Penguji</h4></strong></div>
      <div class="panel-body"><p>You'll need your email address and last name to create your Turnitin account password and set your security information; this information can be found in your welcome email. You can then log into Turnitin and begin customizing your account.</p>
      <a href="index.php?mod=set" class="btn btn-primary">Pengaturan</a>
      </div>
    </div>

</div>


<!-- Modal -->
	<div class="modal fade" id="addSession" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Tambah Sesi</h4>
				</div>
				<div class="modal-body">
					<form id="formAddSession" action="" method="">
						<label>Kode/Nama Periode</label>
						<select class="form-control periodList" name="id">
							<option value="0">Pilih Periode</option>
						</select>
						<label>Nama Sesi</label>
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
								<button type="submit" class="btn btn-primary" id="addButtonSession">Tambah</button>
							</div>
						</div>
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
							<option value="0">Pilih Subjek</option>
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
