<?php
	include('../content/dbcontroller.php');

	if(function_exists($_GET['f'])) {
		if($_GET['perid'] && $_GET['sessid'] && $_GET['locid'] && $_GET['statid'])
		{
			$_GET['f']($_GET['perid'],$_GET['sessid'],$_GET['locid'],$_GET['statid']);
		}
		else
		{
			if($_GET['perid'] && $_GET['sessid'] && $_GET['locid'])
			{
				$_GET['f']($_GET['perid'],$_GET['sessid'],$_GET['locid']);
			}
			else
			{
				if ($_GET['perid'] && $_GET['sessid'])
				{
					$_GET['f']($_GET['perid'],$_GET['sessid']);
				}
				else
				{	
					if($_GET['perid'])
					{
						$_GET['f']($_GET['perid']);
					}
					else
					{
						$_GET['f']();
					}
				}
			}
		}
	}

	function get_data($perid, $sessid, $locid)
	{
		$crud = new dbcontroller();
		$table = "view_transaction_station";
		$column = "`id`, `period_id`, `session_id`, `location_id`, `station_id`, `station_name`, `lecturer_name`";
		$condition = "`period_id` = $perid AND `session_id` = $sessid AND `location_id` = '".$locid."'";
		$items = $crud->get_data_distinct($table,$column, $condition);
		print_r($items);
	}

	function get_student($perid, $sessid, $locid, $statid)
	{
		$crud = new dbcontroller();
		$table = "grade";
		$column = "`student_id`, `period_id`, `session_id`, `location_id`, `station_id`, `student_name`";
		$condition = "`period_id` = '".$perid."' AND `session_id` = '".$sessid."' AND `location_id` = '".$locid."' AND `station_id` = '".$statid."';";
		$items = $crud->get_data_distinct($table,$column, $condition);
		print_r($items);
	}

	function add()
	{
		$crud = new dbcontroller();

		$period = $_POST['period_id'];
		$session = $_POST['session_id'];
		$station = $_POST['station_id'];
		$location = $_POST['location_id'];

		$sql = "INSERT transaction_station(`period_id`, `session_id`,`location_id`,`station_id`) VALUES ('".$period."','".$session."','".$location."','".$station."')";
		$run = $crud->query($sql);
		if($run)
		{
			print_r($run);
		}
		else
		{
			$sql_competent = "SELECT `competent_id`, `weight` FROM view_transaction_competent WHERE `session_id` = '$session'";
			$transaction_competent = $crud->query($sql_competent);
		}
	}

	function add_master()
	{
		$crud = new dbcontroller();

		$name = $_POST['name'];

		$sql = "INSERT station(`name`) VALUES ('".$name."')";
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

		$sql = "UPDATE station SET `name` = '".$name."' WHERE `id` = '".$id."'";
		$run = $crud->query($sql);

		if($run)
		{
			print_r($run);			
		}
	}

	function delete()
	{
		$crud = new dbcontroller();

		$id = $_POST['id'];
		$table = "transaction_station";
		$column = "id";
		$items = $crud->delete_data($table,$column,$id);
		if($items)
		{
			print_r($items);
		}
		else
		{
			$table_competent = "transaction_competent";
			$column_competent = "transact_station_id";
			$items_competent = $crud->delete_data($table_competent,$column_competent,$id);
			if($items_competent)
			{
				print_r($items_competent);
			}
		}
	}

	function delete_master()
	{
		$crud = new dbcontroller();

		$id = $_POST['id'];
		$table = "station";
		$column = "id";
		$items = $crud->delete_data($table,$column,$id);
		if($items)
		{
			print_r($items);
		}
	}
?>
