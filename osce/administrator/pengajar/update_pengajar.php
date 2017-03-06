<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	
	$sql = "SELECT `id`,`name` FROM `lecturer` WHERE `id` = '".$_GET['id']."' LIMIT 1";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_row($result);
?>
<form class="form-group col-md-6" action="index.php?mod=lecinact" method="post">
	<input class="form-control" name="id" type="text" value="<?php echo $row[0]; ?>">
	<input class="form-control" name ="name" type="text" value="<?php echo $row[1]; ?>">
	<input class="form-control" name="oldpswd" type="password" placeholder="Password Lama">
	<input class="form-control" name="pswd" type="password" placeholder="Password Baru">
	<input class="form-control" name="confpswd" type="password" placeholder="Konfirmasi Password">
	<div class="col-md-6">
		<a class="form-control btn btn-primary" href="index.php?mod=lec">Kembali</a>
	</div>
	<div class="col-md-6">
		<input class="form-control btn-primary" type="submit" name="ubah" value="Ubah">
	</div>
</form>
