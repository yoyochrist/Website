<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php 
require 'secure.inc' ; // to ensure user cannot use this script.php directly

?>
<html>
<head>

<meta name="title" content="UKRIDA APPS"> 
<meta name="description" content="Save ourselves and future generations, On-Line shop, etc" />
<meta name="keywords" content="save the environment,water,water crisis,diy,furniture,supplements,online shop" />
<meta name="googlebot" content="noarchive">
<meta name="author" content="Corian Spirit" />
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<link rel="icon" type="image/png" href="./img/ukrida_icon.png"></link>
<link rel="stylesheet" type="text/css" href="./css/select.css?v=1" ></link>


</head>

<TITLE>SKILL LAB</TITLE>
<body> 

<?php 


global $PHP_SELF,$dirname,$fname, $img_dir, $href;

//--------------------------------------------------------------------------------------------------
function choose()
{
global $PHP_SELF,$href;

$priv = $_SESSION['priv'];
$name = $_SESSION['full_name'];
$rfid = $_SESSION['rfid'];    
  
$href = "http://192.168.14.229/id_server/checkid.php";
  
// header (logo)
echo "<div class=logo>";
echo "<table width=100% border=0 class=tablelogo>";
$img = "./img/". "logout.png"; 
echo "<tr><td align=left width=200><img src='./img/ukrida_logo.png'></td><td><h3>SKILL LAB</h3> 
<p style='margin-top:-15px;'>$name ($rfid - $priv) &nbsp;&nbsp; <a href=$href><img src=$img style='vertical-align:middle;'></a></p></td></tr>";
echo "</table></div><br><br>"; 

echo "<div align=center>";
echo "<h3>PLEASE SELECT YOUR ROLE</h3>";
echo "<a href='$PHP_SELF?action=PENILAI' class=achoice >PENILAI</a><p>";
echo "<a href='$PHP_SELF?action=ADMIN' class=achoice >ADMIN</a><p>";
echo "</div>";


   
}


//--------------------------------------------------------------------------------------------------
function redirect()
{
//print_r($_SESSION); exit;

// get priviledge from Session
// 1 = penilai          --> osce/index.php
// 2 = BAA              --> osce/skilllab/akademik.php
// 3 = penilai or Admin --> osce/skilllab/index.php

$priv = $_SESSION['priv'];

switch ($priv)
   {
   case "1";
      header("Location:index.php");
      break;
   case "2";
      header("Location:/osce/skilllab/akademik.php");
      break;
   case "3";
      choose();
      break;
   default;
      echo "<h3>Unknown priviledge $priv</h3>";
      exit;
   }
}   

   
///////////////////////////////////////// main program \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

if (empty($_REQUEST) or empty($_REQUEST['action']) ) $action = NULL;
else $action = $_REQUEST['action'];

switch ($action)
   {
   case "PENILAI";
      header("Location:index.php");
      break;
   case "ADMIN";
      header("Location:../osce/skilllab/index.php");
      break;

   default;
      redirect();
   }
echo "<div id=hover></div>";

?>
