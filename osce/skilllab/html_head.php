<?php 

function print_header($title)
{
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php print $title." - UKRIDA"; ?></title>

		<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<META content="MSHTML 6.00.2900.2769" name=GENERATOR>
		<META content="Universitas Kristen Krida Wacana" name=author>
		<META content=index,follow name=robots>
		<META content="" name=description>
		<META content="UKRIDA, Universitas Kristen Krida Wacana" name=keywords />

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link href="../css/styles.css" rel="stylesheet" type="text/css" />
		<link href="../css/styles2.css" rel="stylesheet" type="text/css" />

		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />

		<link rel="stylesheet" href="../jquery/jquery-ui.css">

		<script src="../jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
		<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="../jquery/jquery-ui.js"></script>

		<link rel="shortcut icon" href="../img/ukrida.ico">
        
       
        
        <!--jquery datatable-->
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="../DataTables-1.10.7/media/css/jquery.dataTables.css">
        <!-- jQuery
        <script type="text/javascript" charset="utf8" src="DataTables-1.10.7/media/js/jquery.js"></script>
        <!-- DataTables -->
        <script type="text/javascript" charset="utf8" src="../DataTables-1.10.7/media/js/jquery.dataTables.js"></script>
        <script>
            $(document).ready(function(){
            $('#myTable').DataTable();});
        </script>
        
        
	</head>

<?php

}

?>
