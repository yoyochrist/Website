<?php
	$link = mysqli_connect("localhost", "root", "password1234", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	
	$sql = "SELECT * FROM period";
?>
<div class="row col-md-5">
	<form method="post" action="laporan/laporansesi.php">
		<select class="form-control" name="dropsesi">
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
		<input class="btn btn-primary" type="submit" value="Per Sesi">
	</form>
</div>
<div class="row col-md-1"></div>
<div class="row col-md-5">
	<form method="post" action="laporan/laporanstation.php">
		<select class="form-control" name="dropstation">
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
		<input class="btn btn-primary" type="submit" value="Per Station">
	</form>
</div>
