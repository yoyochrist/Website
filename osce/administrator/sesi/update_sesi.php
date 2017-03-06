<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	
	$sql = "SELECT `id`,`period_id`,`name`,`time_start`,`time_end`, `active` FROM `session` WHERE `id` = '".$_GET['id']."' LIMIT 1";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_row($result);
	$sqlperiod = "SELECT * FROM period";
?>
<form class="form-group col-md-6" action="index.php?mod=sesupact" method="post">
	<input class="form-control" type="hidden" name="id" value="<?php echo $row[0];?>">
	<label>Kode Periode</label>
	<select class="form-control" name="periodID">
		<?php
			if($period = mysqli_query($link, $sqlperiod))
			{
				if(mysqli_num_rows($period) > 0)
				{
					while($rowperiod = mysqli_fetch_array($period))
					{
						if($rowperiod[0] == $row[1])
						{
							echo '<option value="'.$rowperiod['id'].'" selected>'.$rowperiod['date_start'].' s/d '.$rowperiod['date_end'].'</option>';
						}
						else
						{
							echo '<option value="'.$rowperiod['id'].'">'.$rowperiod['date_start'].' s/d '.$rowperiod['date_end'].'</option>';
						}
					}
				}
			}
		?>
	</select>
	<label>Nama Sesi</label>
	<input class="form-control" type="text" name="nama" value="<?php echo $row[2];?>">
	<label>Tanggal Mulai</label>
	<input class="form-control" type="datetime-local" name="date_start" value="<?php $date_start = new DateTime($row[3]); echo date_format($date_start, 'Y-m-d\TH:i');?>">
	<label>Tanggal Berakhir</label>
	<input class="form-control" type="datetime-local" name="date_end" value="<?php $date_end = new DateTime($row[4]); echo date_format($date_end, 'Y-m-d\TH:i');?>">
	<label>Aktif</label>
	<select class="form-control" name="active">
		<?php
			if($row['5'] == 0)
			{
		?>
			<option value="0" selected>Non Aktif</option>
			<option value="1">Aktif</option>
		<?php
			}
			else
			{
		?>
			<option value="0">Non Aktif</option>
			<option value="1" selected>Aktif</option>
		<?php
			}
		?>
	</select>
	<div class="col-md-6">
		<a class="form-control btn btn-primary" href="index.php?mod=ses">Kembali</a>
	</div>
	<div class="col-md-6">
		<input class="form-control btn-primary" name="ubah" type="submit" value="Ubah">
	</div>
</form>
