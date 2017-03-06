<?php
// secure checking procedure
// we want to forbid user from executing this file without going thru the login process
// secure.inc is only for admin.php or other php that is not the first (main) php. Do not use on the first/main php. It will fail.

session_start();

//------- 1 check Session Variable 
if (empty($_SESSION)) die ('<div align=center><h2>1 Sorry, you do not have the permission to see this page</h2></div> '); 

//------- 2 check device variable availability 
$check=$_SESSION['device'];
if (empty($check)) die ('2 Sorry , you do not have the permission to see this page '); 

?>