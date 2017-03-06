<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	
	$sql = "SELECT `id`,`period_id`,`name`,`time_start`,`time_end`, `active` FROM `session` WHERE `id` = '".$_GET['id']."' LIMIT 1";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_row($result);
	$sqlperiod = "SELECT `date_start`,`date_end` FROM period WHERE `id`='".$row[1]."'";
	$period = mysqli_query($link, $sqlperiod);
	$rowperiod = mysqli_fetch_row($period);
?>
<form class="form-group col-md-6" action="index.php?mod=sesmhs&id=<?php echo $row[0];?>" method="post">
	<table>
		<tr>
			<td>
				<label>Kode Periode</label>
			</td>
			<td>
				<?php echo $rowperiod[0].' s/d '.$rowperiod[1];?>
			</td>
		</tr>
		<tr>
			<td>
				<label>Nama Sesi</label>
			</td>
			<td>
				<?php echo $row[2];?>
			</td>
		</tr>
		<tr>
			<td>
				<label>Tanggal Mulai</label>
			</td>
			<td>
				<?php echo $row[3];?>
			</td>
		</tr>
		<tr>
			<td>
				<label>Tanggal Berakhir</label>
			</td>
			<td>
				<?php echo $row[4];?>
			</td>
		</tr>
		<tr>
			<td>
				<label>Aktif</label>
			</td>
			<td>
				<?php
					if($row[5] == 0)
					{
						echo "Non Aktif";
					}
					else
					{
						echo "Aktif";
					}
				?>
			</td>
		</tr>
	</table>
	<div class="col-md-6">
		<a class="form-control btn btn-primary" href="index.php?mod=ses">Kembali</a>
	</div>
	<div class="col-md-6">
		<input class="btn btn-primary" type="submit" name = "tambah" value = "Tambah Mahasiswa">
	</div>
</form>
