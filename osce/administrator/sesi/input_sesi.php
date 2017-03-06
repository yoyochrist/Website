<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	
	$sql = "SELECT * FROM period";
?>
<form class="form-group col-md-6" action="index.php?mod=sesinact" method="post">
	<!--<input class="form-control" type="text" name="periodID" placeholder="ID Periode">-->
	<label>Kode Periode</label>
	<select class="form-control" name="periodID">
		<?php
			if($result = mysqli_query($link, $sql))
			{
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
						echo '<option value="'.$row['id'].'">'.$row['date_start'].' s/d '.$row['date_end'].'</option>';
					}
				}
			}
		?>
	</select>
	<label>Nama Sesi</label>
	<input class="form-control" type="text" name="nama" placeholder="Nama Sesi">
	<label>Tanggal Mulai</label>
	<input class="form-control" type="datetime-local" name="date_start" value="<?php echo date('Y-m-d\TH:i');?>">
	<label>Tanggal Berakhir</label>
	<input class="form-control" type="datetime-local" name="date_end" value="<?php echo date('Y-m-d\TH:i');?>">
	<label>Aktif</label>
	<select class="form-control" name="active">
		<option value="1">Non Aktif</option>
		<option value="2">Aktif</option>
	</select>
	<div class="col-md-6">
		<a class="form-control btn btn-primary" href="index.php?mod=ses">Kembali</a>
	</div>
	<div class="col-md-6">
		<input class="form-control btn-primary" name="tambah" type="submit" value="Tambah">
	</div>
</form>
