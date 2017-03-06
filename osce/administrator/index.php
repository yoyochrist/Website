<?php 

	include('content/DBControllers.php');
	include("html_head.php");


	if (isset($_GET['title']))
	{
		$title = $_GET['title'];
		$judul = str_replace("-", " ", $title);
		print_header(ucwords($judul));
	}
	else
	{
		print_header("Universitas Kristen Krida Wacana");
	}

	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	} 

	if(!isset($_SESSION['id'])) 
	{
		include('login.php');
	}
	else
	{
		include('utama.php');
	}
?>
</html>
