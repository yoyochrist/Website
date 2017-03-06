<?php
	function get_grade_all()
	{
		$sql = "SELECT * FROM grade";
		$result = mysql_query($sql);
		return(mysql_fetch_array($result));
	}

	function get_grade($gradeID)
	{
		$sql = "SELECT * FROM mahasiswa WHERE nim='$nim'";
		$result = mysql_query($sql);
		return(mysql_fetch_array($result));
	}

	function delete_grade($gradeID)
	{
		$sql = "DELETE FROM grade WHERE grade_id = '$gradeID'";
	}
?>
