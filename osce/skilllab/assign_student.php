<script src="assign_student.js"></script>
<div class="col-md-12">
	<h2>Jadwalkan Peserta</h2>
	<form class="col-md-4" id="assign">
		<label>Periode</label>
		<select class="period form-control" name="period"></select>
		<label>Sesi</label>
		<select class="session form-control" name="session"></select>
		<label>Lokasi</label>
		<select class="location form-control" name="location"></select>
		<label>Station</label>
		<select class="station form-control" name="station"></select>
		<label>NIM</label>
		<input  class="form-control" type="text" name="nim" />
		<br/>
		<div class="col-md-6">
			<a class="form-control btn-primary" href="index.php?mod=acad">Kembali</a>
		</div>
		<div class="col-md-6">
			<input class="form-control btn-primary" name="submit" type="submit" value="Jadwalkan">
		</div>
	</form>
</div>