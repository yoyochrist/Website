<?php
	include('../content/dbcontroller.php');

	if(function_exists($_GET['f'])) {
		if($_GET['id'])
		{
			$_GET['f']($_GET['id']);
		}
		else
		{
			$_GET['f']();
		}
	}

	function get_data()
	{
		$crud = new dbcontroller();

		$table = "period";
		$column = "exam_type";
		$condition = "'SL'";
		$items = $crud->get_data_id($table, $column, $condition);
		print_r($items);
	}

	function get_period()
	{
		$crud = new dbcontroller();

		$sql = "SELECT a.`id`, a.`subject_id`, b.`name` AS `subject_name`, a.`name` AS `period_name`, a.`active`, a.`date_start`, a.`date_end`, a.`exam_type`, (SELECT count(c.`id`) FROM session c WHERE c.period_id = a.id) AS session_count FROM osce.period a JOIN osce.subject b ON a.subject_id = b.id ORDER BY a.`id` DESC";
		$items = $crud->select_query($sql);
		print_r($items);
	}

	function add()
	{
		$crud = new dbcontroller();

		$name = $_POST['name'];
		$start = $_POST['date_start'];
		$end = $_POST['date_end'];
		$subject = $_POST['subjekTambah'];
		$exam_type = 'SL';

		$update = "UPDATE `period` SET `active` = '0'";
		$runInactive = $crud->query($update);
		if($runInactive )
		{
			print_r($runInactive );			
		}

		$sql = "INSERT period(`name`,`date_start`,`date_end`,`subject_id`,`exam_type`, `active`) VALUES ('".$name."','".$start."','".$end."','".$subject ."','".$exam_type."', '1')";
		$run = $crud->query($sql);
		if($run)
		{
			print_r($run);			
		}
	}

	function update()
	{
		$crud = new dbcontroller();

		$name = $_POST['name'];
		$start = $_POST['date_start'];
		$end = $_POST['date_end'];
		$id = $_POST['id'];
		$subject = $_POST['subjekEdit'];
		$active = $_POST['active'];

		$sqlinactive = "UPDATE period SET `active` = '0' WHERE `id` != '".$id."'";
		$runinactive = $crud->query($sqlinactive);
		if($runinactive)
		{
			print_r($runinactive);			
		}
		else
		{
			$sql = "UPDATE period SET `name` = '".$name."', `date_start` = '".$start."', `date_end` = '".$end."', `subject_id` = '".$subject."', `active` = '".$active."' WHERE `id` = '".$id."'";
			$run = $crud->query($sql);
			if($run)
			{
				print_r($run);			
			}
		}
	}

	function delete()
	{
		$id = $_POST['id'];
		$crud = new dbcontroller();
		$table = "period";
		$column = "id";
		$items = $crud->delete_data($table,$column,$id);
		if($items)
		{
			print_r($items);
		}
		else
		{
			header("Refresh:0; url=index.php");
		}
	}

	function test_query()
	{
		$crud = new dbcontroller();
		$sql = "SELECT `period_id`, `session_id`, `location_id`, `station_id`, `lecturer_id`, `lecturer_name`, `subject_id`, subject_name`, competent_id`, `competent_name`, `weight` FROM view_transaction_competent WHERE `period_id` = '5' AND `session_id` = '7' AND `location_id` = '1' AND `station_id` = '1'";
		$items = $crud->select_query($sql);
		$decode = json_decode($items);
		$result = $decode->data;
		foreach($result as $key=>$value)
		{
			print_r($value->period_id);
		}
	}
?>
