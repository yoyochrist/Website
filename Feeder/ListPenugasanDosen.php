<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta content="MSHTML 6.00.2900.2769" name=GENERATOR>
		<meta content="Universitas Kristen Krida Wacana" name=author>
		<meta content=index,follow name=robots>
		<meta content="" name=description>
		<meta content="UKRIDA, Universitas Kristen Krida Wacana" name=keywords />
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'/>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="jquery/jquery-ui.css">

		<script src="jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
		<script src="jquery/jquery-ui.js"></script>
		<script src="jquery/jquery.redirect.min.js"></script>

		<!-- datepicker -->
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

		<link rel="shortcut icon" href="img/ukrida.ico">
	</head>
	<body>
		<?php
			$table = $_GET['table'];
			
			$json_recordset = file_get_contents('http://localhost/Feeder/lib/table.php?f=GetDictionary&table='.$table);
			$val_recordset = json_decode($json_recordset, true);
			$getRecordset = $val_recordset['result'];
			$getDictionary = array("column_name","pk","type","not_null","desc");
			/*foreach($getRecordset as $key_recordset => $value_recordset)
			{
				$getDictionary = array_keys($value_recordset);
			}*/
			//echo $val_recordset['result'];
			echo '<h2> Deskripsi Tabel '.$_GET['table'].'</h2><a href="http://192.168.14.211/feeder/tablecontent.php?table='.$_GET['table'].'">Lihat Data</a><a href="http://192.168.14.211/feeder">Kembali</a>';
			echo "<table border=1>";
				echo "<thead>";
					echo "<tr>";
						foreach ($getDictionary as $key_dictionary => $value_dictionary){
							$columns[] = $value_dictionary;
							echo "<td>";
								echo $value_dictionary;
							echo "</td>";
						}
					echo "</tr>";
				echo "</thead>";
				foreach($getRecordset as $key_recordset => $value_recordset){
					echo "<tr>";
					foreach($columns as $key_columns => $value_columns)
					{
						echo "<td>";
							if(isset($value_recordset[$value_columns]))
							{
								if($value_recordset[$value_columns] == 1)
								{
									echo "TRUE";
								}
								else
								{
									echo $value_recordset[$value_columns];
								}
							}
						echo "</td>";
					}
					//echo $value_recordset;
					echo "</tr>";
				}
			echo "</table>";
		?>
	</body>
</html>