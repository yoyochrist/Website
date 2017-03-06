<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	
	$sql = "SELECT * FROM session WHERE active = 1";
?>
<form class="form-group col-md-5" action="index.php?mod=mhsinact" method="post">
	<label>Sesi</label>
	<select class="form-control" name="sessionID">
		<option value="#">Pilih Sesi</option>
	<?php
		if($result = mysqli_query($link, $sql))
		{
			if(mysqli_num_rows($result) > 0)
			{
				while($row = mysqli_fetch_array($result))
				{
					echo '<option value="'.$row['id'].'">'.$row['time_start'].' s/d '.$row['time_end'].'</option>';
				}
			}
		}
	?>
	</select>
	<label>Tipe Ujian</label>
	<div class="select">
		<input type="radio" name="exam_type" value="SL"> Skill Lab
		<input type="radio" name="exam_type" value="SR"> Semester
	</div>
	<label>Koridor</label>
	<input class="form-control" type="text" name="room" placeholder="Contoh: 1A untuk SL atau A untuk semester" required>
	<label>NIM</label>
	<input class="form-control" name="studentID" type="text" placeholder="NIM" required>
	<div class="col-md-6">
		<a class="form-control btn btn-primary" href="index.php?mod=mhs">Kembali</a>
	</div>
	<div class="col-md-6">
		<input class="form-control btn-primary" type="submit" name="tambah" value="Tambah">
	</div>
</form>
