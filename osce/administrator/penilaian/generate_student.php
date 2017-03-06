<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	$sqlsubject = "SELECT `id`,`name` FROM subject";
	$sqlstation = "SELECT `id`,`name` FROM station";
	$sqlsession = "SELECT `id`,`name`,`time_start`,`time_end` FROM session WHERE active='1'";
	$sqlquestion = "SELECT `id`,`item` FROM question";
	$sqllecturer = "SELECT `id`,`name` FROM lecturer";
?>
<form class="from-group" action="index.php?mod=geninact" method="post">
	<label>Subyek</label>
	<select class="form-control" name="subject">
		<?php
			if($resultsubject = mysqli_query($link, $sqlsubject))
			{
				if(mysqli_num_rows($resultsubject) > 0)
				{
					while($rowsubject = mysqli_fetch_array($resultsubject))
					{
						echo '<option value="'.$rowsubject[0].'">'.$rowsubject[1].'</option>';
					}
				}
			}
		?>	
	</select>
	<label>Station</label>
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
	<label>Sesi</label>
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
	<label>Pengajar</label>
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
	<label>Soal</label>
	<?php
		if($resultquestion = mysqli_query($link, $sqlquestion))
		{
			if(mysqli_num_rows($resultquestion) > 0)
			{
				while($rowquestion = mysqli_fetch_array($resultquestion))
				{
					echo '<div class="checkbox">';
					echo '<label><input type="checkbox" name="question[]" value="'.$rowquestion[0].'">'.$rowquestion[1].'</label>';
					echo '</div>';
				}
			}
		}
	?>
	<div class="col-md-6">
		<a class="form-control btn btn-primary" href="index.php?mod=mhs">Kembali</a>
	</div>
	<div class="col-md-6">
		<input class="form-control btn-primary" name="generate" type="submit" value="Generate">
	</div>
</form>
