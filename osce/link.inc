<?php
global $db, $href;

// connect to database -----------------------------------------------------------------------------
$host = 'localhost';
$userid = 'root';
$pword = '';
$dbname  = 'osce';

$db = new PDO( 'mysql:host='.$host.';dbname='.$dbname.';charset=utf8mb4', $userid, $pword, 
array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

// running local or public -------------------------------------------------------------------------
//$href = "http://localhost/id_server/";
$href = "http://192.168.14.229/id_server/checkid.php";

// upload directories ------------------------------------------------------------------------------
//$uploaddir = '/var/www/html/';                          // linux upload directory
$uploaddir = 'c:/';			                        // windows upload directory

// images directory --------------------------------------------------------------------------------
$img_dir = './images/';


// check whether user using computer or mobile phone -----------------------------------------------
require '../MobileDetect/Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

// get user's browser's name -----------------------------------------------------------------------
$u_agent = $_SERVER['HTTP_USER_AGENT'] . "\n\n";
if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
  {   $bname = 'Internet Explorer';   } 
elseif(preg_match('/Edge/i',$u_agent)) 
  {   $bname = 'Microsoft Edge';   } 
elseif(preg_match('/Opera/i',$u_agent) || preg_match('/OPR/i',$u_agent))
  {   $bname = 'Opera';   } 
elseif(preg_match('/Safari/i',$u_agent) )
  {   $bname = 'Safari';   } 
elseif(preg_match('/Firefox/i',$u_agent)) 
  {   $bname = 'Mozilla Firefox';   } 
elseif(preg_match('/Chrome/i',$u_agent)) 
  {   $bname = 'Google Chrome';   } 
elseif(preg_match('/Safari/i',$u_agent)) 
  {   $bname = 'Apple Safari';  } 
elseif(preg_match('/Netscape/i',$u_agent)) 
  {   $bname = 'Netscape';   } 

// set session if not yet started and set navigation -----------------------------------------------
if(session_id() == '' || !isset($_SESSION)) session_start();
$_SESSION['dbname']=$dbname;
$_SESSION['device']=$deviceType;
$_SESSION['browser']=$bname;
$_SESSION['uploaddir'] = $uploaddir;
$_SESSION['page_n'] = 0;                           // starting page number       
$_SESSION['records_per_page'] = 20;
$_SESSION['sort_order'] = 'ASC';
$_SESSION['order_by'] = '';


// setting up timezone is a requirement ------------------------------------------------------------ 
date_default_timezone_set("Asia/Jakarta");
?>