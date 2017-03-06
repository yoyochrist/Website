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

	function get_data($id)
	{
		$crud = new dbcontroller();
		$table = "lecturer";
		$items = $crud->get_data($table);
		print_r($items);
	}

	function add()
	{
		$crud = new dbcontroller();

		$lecturer = $_POST['lecturer_id'];
		$transaction_id = $_POST['transact_id'];

		$sql = "UPDATE `transaction_station` SET `lecturer_id` = '".$lecturer."' WHERE `id` = '".$transaction_id."';";
		$run = $crud->query($sql);
		if($run)
		{
			print_r($run);			
		}
	}

	function add_master()
	{
		$crud = new dbcontroller();

		$id = $_POST['snid'];
		$name = $_POST['name'];

		$sql = "INSERT lecturer(`id`, `name`) VALUES('".$id."','".$name."')";
		$run = $crud->query($sql);
		if($run)
		{
			print_r($run);			
		}
	}

	function edit_master()
	{
		$crud = new dbcontroller();

		$nid = $_POST['snid'];
		$name = $_POST['name'];

		$sql = "UPDATE lecturer SET `name` = '".$name."', `id` = ".$nid." WHERE `id` = ".$nid;
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

		$sql = "UPDATE period SET `name` = '".$name."', `date_start` = '".$start."', `date_end` = '".$end."' WHERE `id` = '".$id."'";
		$run = $crud->query($sql);
		if($run)
		{
			print_r($run);			
		}
	}

	function delete_master()
	{
		$crud = new dbcontroller();
		$id = $_POST['id'];

		$table = "lecturer";
		$column = "id";
		$items = $crud->delete_data($table,$column,$id);

		if($items)
		{
			print_r($items);
		}
	}
?>
