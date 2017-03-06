<?php

include ('DBController.php');

$db_handle = new DBController();

date_default_timezone_set('Asia/Jakarta');
$tgl = date('Y-m-d H:i:s');

$id = $_POST['id'];
$pswd = $_POST['pswd'];

$sql="select * from userx where id='$id' and pswd=md5(md5('$pswd'))";
$result=$db_handle->runQuery($sql);

$total = $db_handle->numRows($sql);

if ($result && $total>0) {
	
	mysql_query("UPDATE userx SET lastlog='$tgl',hits=hits+1 WHERE id='$id'");
	print mysql_error();	

	//$tgl = str_replace("-", "", date('Y-m-d'));
	
	session_start();
	foreach($result as $user) 
	{
		$_SESSION['id'] = $user['id'];
		$_SESSION['name'] = $user['name']; 
	}
	
	header('Location: ../index.php?mod=reg');
}
else {
	echo '<script>';
	echo 'alert("Proses login tidak berhasil!");';
	echo 'location.href="../index.php"';
	echo '</script>';
}

?>
