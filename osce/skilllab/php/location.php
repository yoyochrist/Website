<?php
	include('../content/dbcontroller.php');

	if(function_exists($_GET['f'])) {
		if($_GET['sessid'])
		{
			$_GET['f']($_GET['sessid']);
		}
		else
		{
			$_GET['f']();
		}
	}

	function get_data($id)
	{
		$crud = new dbcontroller();
		$table = "view_transaction_station";
		$column = "`session_id`, `period_id`, `period_name`, `session_name`, `location_id`, `location_name`";
		$condition = "`session_id` = '".$id."'";
		$items = $crud->get_data_distinct($table,$column, $condition);
		print_r($items);
	}

	function add()
	{
		$crud = new dbcontroller();

		$name = $_POST['name'];
		$start = $_POST['date_start'];
		$end = $_POST['date_end'];
		$period_id = $_POST['id'];
		$station = $_POST['station'];
		$location = $_POST['location'];

		$count = "select count(*) as max_id from session";
		$items = $crud->select_query($count);
		$decode = json_decode($items);
		$id = $decode->data[0]->max_id+1;

		$sql = "INSERT session(`session_id`, `period_id`,`name`,`time_start`,`time_end`, `station_available`) VALUES ('".$id."','".$period_id."','".$name."','".$start."','".$end."', '".$station."'. '".$location."')";
		$run = $crud->query($sql);
		if($run)
		{
			print_r($run);			
		}
	}

	function add_master()
	{
		$crud = new dbcontroller();
		$name = $_POST['name'];

		$sql = "INSERT location(`name`) VALUES ('".$name."')";
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
		$station = $_POST['station'];
		$id = $_POST['id'];

		$sql = "UPDATE session SET `name` = '".$name."',`time_start` = '".$start."',`time_end`='".$end."', `station_available`='".$station."' WHERE `id` = ".$id;
		$run = $crud->query($sql);
		if($run)
		{
			print_r($run);			
		}
	}

	function edit_master()
	{
		$crud = new dbcontroller();

		$id = $_POST['id'];
		$name = $_POST['name'];

		$sql = "UPDATE location SET `name` = '".$name."' WHERE `id` = '".$id."'";
		$run = $crud->query($sql);

		if($run)
		{
			print_r($run);			
		}
	}

	function delete()
	{
		$id = $_POST['id'];
		$crud = new dbcontroller();
		$table = "transaction_station";
		$column = "location_id";
		$items = $crud->delete_data($table,$column,$id);
		if($items)
		{
			print_r($items);
		}
	}

	function delete_master()
	{
		$id = $_POST['id'];
		$crud = new dbcontroller();
		$table = "location";
		$column = "id";
		$items = $crud->delete_data($table,$column,$id);
		if($items)
		{
			print_r($items);
		}
	}
?>
