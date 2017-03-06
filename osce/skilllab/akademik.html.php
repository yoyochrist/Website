<body style="margin-left:20px;">
	<script src="akademik.js"></script>

	<!-- Button trigger modal -->
	<a href="index.php?mod=upcsv" class="btn btn-primary" role="button" id="csv">
		Tambah Mahasiswa CSV
	</a>
	<a href="index.php?mod=upman" class="btn btn-primary" role="button" id="manual">
		Tambah Mahasiswa Manual
	</a>

	<div id="txtData">
		<div class="col-md-12">
			<div class="col-md-4">
				<h3>Data Sesi Aktif Terakhir</h3>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-1">
				<b>Nama Periode</b>
			</div>
			<div class="col-md-1">
				<b>Nama Session</b>
			</div>
			<div class="col-md-3">
				<b>Tanggal</b>
			</div>
			<div class="col-md-1">
				<b>Lokasi</b>
			</div>
			<div class="col-md-1">
				<b>Station per Lokasi</b>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<br/><br/>
		<div class="col-md-12">
			<p style="color:red">
				<b>Keterangan:</b>
				<ul>
					<li>Upload CSV untuk data mahasiswa per sesi</li>
					<li>Upload manual untuk data mahasiswa susulan</li>
				</ul>
			</p>
		</div>
	</div>

	<div class="col-md-12 template">
		<div class="col-md-1 periodname">
		</div>
		<div class="col-md-1 sessionname">
		</div>
		<div class="col-md-3 date">
		</div>
		<div class="col-md-1 location">
		</div>
		<div class="col-md-1 station">
		</div>
	</div>
</body>
