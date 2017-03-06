<form class="form-group col-md-6"  action="index.php?mod=perinact" method="post">
	<label>Tanggal Mulai</label>
	<input class="form-control" type="date" name="date_start" value="<?php echo date('Y-m-d');?>">
	<label>Tanggal Berakhir</label>
	<input class="form-control" type="date" name="date_end" value="<?php echo date('Y-m-d');?>">
	<div class="col-md-6">
		<a class="form-control btn btn-primary" href="index.php?mod=per">Kembali</a>
	</div>
	<div class="col-md-6">
		<input class="form-control btn-primary" type="submit" name="tambah" value="Tambah">
	</div>
</form>
