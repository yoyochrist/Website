<?php
	include('crud.php');

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
		$crud = new crud();

		$table = "period";
		$column = "exam_type";
		$condition = "'SL'";
		$items = $crud->get_data_id($table, $column, $condition);
		print_r($items);
	}

	function add()
	{
		$crud = new crud();

		$name = $_POST['name'];
		$start = $_POST['date_start'];
		$end = $_POST['date_end'];
		$subject = $_POST['subjekTambah'];
		$exam_type = 'SL';

		$sql = "INSERT period(`name`,`date_start`,`date_end`,`subject_id`,`exam_type`) VALUES ('".$name."','".$start."','".$end."','".$subject ."','".$exam_type."')";
		$run = $crud->query($sql);
		if($run)
		{
			print_r($run);			
		}
	}

	function update()
	{
		$crud = new crud();

		$name = $_POST['name'];
		$start = $_POST['date_start'];
		$end = $_POST['date_end'];
		$id = $_POST['id'];

		$sql = "UPDATE period SET `name` = '".$name."', `date_start` = '".$start."', `date_end` = '".$end."' WHERE `id` = '".$id."'";
		$run = $crud->query($sql);
		if($run)
		{
			print_r($run);			
		}
		else
		{
			header("Refresh:0; url=index.php");
		}
	}

	function delete()
	{
		$id = $_POST['id'];
		$crud = new crud();
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
		$crud = new crud();
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
