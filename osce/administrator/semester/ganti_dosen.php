<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	$sqlsession = "SELECT `id`,`name`,`time_start`,`time_end` FROM session WHERE active='1'";
	$sqllecturer = "SELECT `id`,`name` FROM lecturer";
?>
<form class="form-group" action="index.php?mod=sruplecact" method="post">
	<label>Sesi</label>
	<select class="form-control" name="session">
		<?php
			if($resultsession = mysqli_query($link, $sqlsession))
			{
				if(mysqli_num_rows($resultsession) > 0)
				{
					while($rowsession = mysqli_fetch_array($resultsession))
					{
						echo '<option value="'.$rowsession[0].'">'.$rowsession[1].'</option>';
					}
				}
			}
		?>
	</select>
	<label>Koridor</label>
	<select class="form-control" name="room">
		<option value="A">A</option>
		<option value="B">B</option>
		<option value="C">C</option>
	</select>
	<label>Station</label>
	<select class="form-control" name="station">
		<option value="1">Station 1</option>
		<option value="2">Station 2</option>
		<option value="3">Station 3</option>
		<option value="4">Station 4</option>
		<option value="5">Station 5</option>
		<option value="6">Station 6</option>
		<option value="7">Station 7</option>
		<option value="8">Station 8</option>
		<option value="9">Station 9</option>
		<option value="10">Station 10</option>
		<option value="11">Station 11</option>
		<option value="12">Station 12</option>
	</select>
	<label>Penguji</label>
	<select class="form-control" name="lecturer">
		<?php
			if($resultlecturer = mysqli_query($link, $sqllecturer))
			{
				if(mysqli_num_rows($resultlecturer) > 0)
				{
					while($rowlecturer = mysqli_fetch_array($resultlecturer))
					{
						echo '<option value="'.$rowlecturer[0].'">'.$rowlecturer[1].'</option>';
					}
				}
			}
		?>
	</select>
	<div class="col-md-6">
		<a class="form-control btn btn-primary" href="index.php?mod=srnla">Kembali</a>
	</div>
	<div class="col-md-6">
		<input class="form-control btn-primary" name="assign" type="submit" value="Assign">
	</div>
</form>
