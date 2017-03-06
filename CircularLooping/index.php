<?php
	$corridor = array('A', 'B', 'C');
	$station = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14);
	$student = array('102013001', '102013002', '102013003', '102013004', '102013005', '102013006', '102013007', '102013008', '102013009', '102013010', '102013011', '102013012', '102013013', '102013014');

	foreach($station as $key => $value)
	{
		$output1 = array_slice($student, $key);
		$output2 = array_slice($student, 0,$key);
		$new=array_merge($output1,$output2);
		print_r($new);
		echo '<br/>';
	}
?>