<script src="csv.js"></script>
<div class="col-md-12">
	<div class="col-md-12">
		<h1>Unggah Peserta</h1>
		<p>Mengunggah peserta dengan format CSV seperti tabel ini</p>
	</div>
	<div class="col-md-4">
		<table border=1 class="table">
			<tr>
				<td>period_id</td>
				<td>session_id</td>
				<td>location_id</td>
				<td>station_id</td>
				<td>student_id</td>
			</tr>
		</table>
	</div>
</div>
<form class="form-group col-md-4" id="formCSV" action="php/csv.php" method="post">
	<label>Unggah: </label>
	<input class="form-control" name="filename" type="file"/>
	<div class="col-md-6">
		<input class="form-control btn-primary" id="uploadCSVButton" name="submit" type="submit" value="Unggah">
	</div>
</form>
