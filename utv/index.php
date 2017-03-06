<!DOCTYPE html>
<html>
	<head>
		<title>UKRIDA TV</title>

		<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<META content="MSHTML 6.00.2900.2769" name=GENERATOR>
		<META content="Universitas Kristen Krida Wacana" name=author>
		<META content=index,follow name=robots>
		<META content="" name=description>
		<META content="UKRIDA, Universitas Kristen Krida Wacana" name=keywords />

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<script src="jquery-2.1.1.min.js" type="text/javascript"></script>

		<link rel="shortcut icon" href="../img/ukrida.ico">
	</head>
	<body>
		<?php
			include('crud.php');
			$crud = new crud();

			if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
			{
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} 
			else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
			{
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			else 
			{
				$ip = $_SERVER['REMOTE_ADDR'];
			}

			$items = $crud->get_data($ip);
			$result = json_decode($items);
			if($result->data)
			{
				$record = $result->data;
				$substr = substr($record->url,0,6);
				if($substr == 'http:/' || $substr == 'https:')
				{
					echo "<iframe src='".$record->url."' style='position:fixed;left:0;right:0;bottom:0;top:0;border:0;width:100%;height:100%'></iframe>";
				}
				else
				{
					echo "<iframe src='http://".$record->url."' style='position:fixed;left:0;right:0;bottom:0;top:0;border:0;width:100%;height:100%'></iframe>";
				}
			}
		?>
	</body>
</html>
