<?php
session_start();
$nim = $_SESSION['nomor'];
//$update = mysql_query("UPDATE tb_user SET status = 'sudah' WHERE nim = '$nim'");

//$query=mysql_query("select * from tb_kuesioner where nim='$nim' and tahun_id=(select max(tahun_id) from tb_kuesioner) limit 1");
//$datamhs=mysql_fetch_array($query);


$tgl=date("j F Y");
$waktu=date("H:i:s");
//$insert=mysql_query("insert into tb_mhs_done values('$nim','$datamhs[1]','$datamhs[3]','$tgl','$waktu','$datamhs[0]')");
unset($_SESSION['rfid']);
unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['no']);
unset($_SESSION['participant']);
header("location:index.php");
?>