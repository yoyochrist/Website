<div class="col-md-12">
	<div class="col-md-12">
		<h1>Unggah Dokumen Nilai Transfer</h1>
		<p>Mengunggah dokumen dengan format CSV seperti <a href="lib/exportcsv.php?table=nilai_transfer">ini</a></p>
	</div>
</div>
<form class="form-group col-md-4" id="formCSV" action="lib/nilaitransfer.php?f=InsertBatch" enctype="multipart/form-data" method="post">
	<label>Unggah: </label>
	<input class="form-control" name="filename" type="file"/>
	<div class="col-md-6">
		<a class="form-control btn-primary">Kembali</a>
	</div>
	<div class="col-md-6">
		<input class="form-control btn-primary" id="uploadCSVButton" name="submit" type="submit" value="Unggah">
	</div>
</form>
