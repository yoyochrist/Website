<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	
	$sql = "SELECT * FROM session WHERE active = 1";
?>
<form class="form-group col-md-5" action="index.php?mod=sesmhsin" method="post">
	<input class="form-control" name="id" type="hidden" value="<?php echo $_GET['id'];?>" required>
	<input class="form-control" name="studentID" type="text" placeholder="NIM" required>
	<div class="col-md-6">
		<a class="form-control btn btn-primary" href="index.php?mod=sesdet&id=<?php echo $_GET['id'];?>">Kembali</a>
	</div>
	<div class="col-md-6">
		<input class="form-control btn-primary" type="submit" name="tambah" value="Tambah">
	</div>
</form>
