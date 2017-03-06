<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	
	$sql = "SELECT `id`,`item` FROM `question` WHERE `id` = '".$_GET['id']."' LIMIT 1";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_row($result);
?>
<form class="form-group col-md-6" action="index.php?mod=subupact" method="post">
	<input class="form-control" type="text" name="nama" value="<?php echo $row[1];?>">
	<input class="form-control" type="hidden" name="id" value="<?php echo $row[0];?>">
	<div class="col-md-6">
		<a class="form-control btn btn-primary" href="index.php?mod=que">Kembali</a>
	</div>
	<div class="col-md-6">
		<input class="form-control btn-primary" type="submit" name="ubah" value="Ubah">
	</div>
</form>
