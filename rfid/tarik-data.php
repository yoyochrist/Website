<html>
	<head><title>Contoh Koneksi Mesin Absensi Mengunakan SOAP Web Service</title></head>
	<body bgcolor="#caffcb">

		<H3>Download Log Data</H3>

		<?php
			//$ip = $_GET["ip"];
			//$key = $_GET["key"];
			
			//if($_GET["ip"]=="") 
				$ip="192.168.113.170";
			//if($_GET["key"]=="") 
				$key="0";
		?>

		<form action="tarik-data.php">
			ip Address: <input type="Text" name="ip" value="<?php echo $ip;?>" size=15><br/>
			Comm key: <input type="Text" name="key" size="5" value="<?php echo $key;?>"><br/><br/>

			<input type="Submit" value="Download">
		</form>
		<br/>

		<?php 
			if($ip != "")
			{
		?>
		<table cellspacing="2" cellpadding="2" border="1">
			<tr align="center">
				<td><b>UserID</b></td>
				<td width="200"><b>Tanggal & Jam</b></td>
				<td><b>Verifikasi</b></td>
				<td><b>Status</b></td>
			</tr>
			<?php
				$Connect = fsockopen($ip, "23", $errno, $errstr, 1);
				if($Connect)
				{
					$soap_request="<GetAttLog><ArgComkey xsi:type=\"xsd:integer\">".$key."</ArgComkey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
					$newLine="\r\n";
					fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
					fputs($Connect, "Content-Type: text/xml".$newLine);
					fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
					fputs($Connect, $soap_request.$newLine);
					$buffer="";
					while($Response=fgets($Connect, 1024))
					{
						$buffer=$buffer.$Response;
					}
				}
				else
				{
					echo "Koneksi Gagal";
				}
				
				include("parse.php");
				$buffer=Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
				$buffer=explode("\r\n",$buffer);
				for($a=0;$a<count($buffer);$a++)
				{
					$data=Parse_Data($buffer[$a],"<Row>","</Row>");
					$pin=Parse_Data($data,"<PIN>","</PIN>");
					$datetime=Parse_Data($data,"<DateTime>","</DateTime>");
					$verified=Parse_Data($data,"<Verified>","</Verified>");
					$status=Parse_Data($data,"<Status>","</Status>");
				?>
				<tr align="center">
					<td><?php echo $pin;?></td>
					<td><?php echo $datetime;?></td>
					<td><?php echo $verified;?></td>
					<td><?php echo $status;?></td>
				</tr>
			<?php
				}
			?>
		</table>
		<?php
			}
		?>
	</body>
</html>