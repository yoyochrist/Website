<?php

include ('dbcontroller.php');

$conn = new DBController();

//date_default_timezone_set('Asia/Jakarta');
$tgl = date('Y-m-d H:i:s');

$id = $_POST['id'];
$pswd = $_POST['pswd'];

$sql="select * from lecturer where id=".$id." and pswd=md5(md5(".$pswd."))";
$result = $conn->runQueryO($sql);
$total = $result->num_rows;


if ($result && $total>0) {
	
	mysqli_query($conn,"UPDATE lecturer SET lastlog='$tgl',hits=hits+1 WHERE id='$id'");
	print mysqli_error();	

	session_start();
	foreach($result as $user) {
		$_SESSION['id'] = $user['id'];
		$_SESSION['name'] = $user['name']; 
	}
	$_SESSION['no'] = 1;
	
	header('Location: ../index.php?mod=reg');
}
else {
	echo '<script>';
	echo 'alert("Proses login tidak berhasil!");';
	echo 'location.href="../index.php"';
	echo '</script>';
}

?>
