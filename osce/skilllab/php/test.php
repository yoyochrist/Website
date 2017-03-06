<?php
	include('../content/dbcontroller.php');
	$crud = new dbcontroller();

	$crud->query("DROP TABLE IF EXISTS temp_table");

	$sql="CREATE TEMPORARY TABLE IF NOT EXISTS temp_table AS (
		SELECT a.student_id,a.session_id,sum(a.score*a.weight)/sum(4*a.weight)*100 as nilai, d.name
		FROM grade a 
		LEFT JOIN session b ON a.session_id=b.id 
		LEFT JOIN student d ON a.student_id=d.id
		WHERE a.session_id='1' and a.period_id = '1'
		GROUP BY a.student_id)";
	$crud->query($sql);

	$select = "SELECT * FROM temp_table";
	$items = $crud->select_query($select);
	print_r($items);
?>
