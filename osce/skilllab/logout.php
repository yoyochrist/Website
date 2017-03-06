<?php
session_start();


unset($_SESSION['id']);
unset($_SESSION['name']);
header("location:http://192.168.14.229/id_server/checkid.php");
?>