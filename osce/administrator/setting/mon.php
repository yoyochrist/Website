<?php
	$link = mysqli_connect("localhost", "root", "", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	$sqlstation = "SELECT `grade`.`station_id`, `station`.`name`, `grade`.`session_id`, SUM(CASE WHEN `grade`.`global_scale` IS NOT NULL THEN 1 ELSE 0 END) AS `student_finish`, COUNT(`grade`.`student_id`) AS `total_student` FROM `grade` JOIN `station` ON `grade`.`station_id` = `station`.`id` JOIN `session` ON `grade`.`session_id` = `session`.`id` JOIN `participant` ON `grade`.`student_id` = `participant`.`student_id` WHERE `participant`.`exam_type` = 'SL' AND `session`.`active` = 1 GROUP BY `grade`.`station_id`";
?>

<table>
	<tr>
		<th>Station</th>
		<th>Jumlah Peserta Selesai</th>
	</tr>
</table>
