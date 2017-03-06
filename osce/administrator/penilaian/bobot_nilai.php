<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}

	$sqlstation = "SELECT `id`,`name` FROM station";
	$sqlsession = "SELECT `id`,`name`,`time_start`,`time_end` FROM session WHERE active='1'";
	$sqlquestion = "SELECT DISTINCT `grade_detail`.`question_id`,`question`.`item` FROM grade_detail JOIN question ON `grade_detail`.`question_id` = `question`.`id`";
?>
<form class="from-group" action="index.php?mod=weiact" method="post">
	<label>Station ID</label>
	<select class="form-control" name="station">
		<?php
			if($resultstation = mysqli_query($link, $sqlstation))
			{
				if(mysqli_num_rows($resultstation) > 0)
				{
					while($rowstation = mysqli_fetch_array($resultstation))
					{
						echo '<option value="'.$rowstation[0].'">'.$rowstation[1].'</option>';
					}
				}
			}
		?>	
	</select>
	<label>Session ID</label>
	<select class="form-control" name="session">
		<?php
			if($resultsession = mysqli_query($link, $sqlsession))
			{
				if(mysqli_num_rows($resultsession) > 0)
				{
					while($rowsession = mysqli_fetch_array($resultsession))
					{
						echo '<option value="'.$rowsession[0].'">'.$rowsession[1].' ('.$rowsession[2].' s/d '.$rowsession[3].')'.'</option>';
					}
				}
			}
		?>
	</select>
	<label>Bobot Nilai</label>
	<input class="form-control" type="text" name="nilai" placeholder="Bobot Nilai">
	<div class="col-md-6">
		<a class="form-control btn btn-primary" href="index.php?mod=mhs">Kembali</a>
	</div>
	<div class="col-md-6">
		<input class="form-control btn-primary" name="bobot" type="submit" value="Beri Bobot">
	</div>
</form>
