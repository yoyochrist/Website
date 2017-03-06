<?php
	function getStudent($id)
	{
		$sql = "SELECT * FROM student WHERE id='$id'";
		$result = mysql_query($sql);
		return(mysql_fetch_array($result));
	}

	function getSubject()
	{
		$sql = "SELECT * FROM student WHERE id='$id'";
		$result = mysql_query($sql);
		return(mysql_fetch_array($result));		
	}

	function format_tanggal_en($tgl)
	{
		$t = implode("-", array_reverse(explode("-", $tgl)));
		return $t;
	}

	function format_tanggal_id($tgl)
	{
		$t = implode("-", array_reverse(explode("-", $tgl)));
		return $t;
	}
?>
