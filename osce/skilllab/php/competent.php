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
		$table = "view_transaction_competent";
		$column = "session_id, session_name, subject_id, subject_name";
		$condition = "session_id = ".$id;
		$items = $crud->get_data_distinct($table, $column, $condition);
		print_r($items);
	}

	function add()
	{
		$crud = new dbcontroller();
		$session = $_POST['id'];
		$competentID = $_POST['competentID'];
		$competentWeight = $_POST['weight'];

		$table_transact_id = "transaction_station";
		$column_transact_id = "session_id";
		$transact_station_id = $crud->get_data_id($table_transact_id, $column_transact_id, $session);
		$decode_transact_station_id = json_decode($transact_station_id);
		
		foreach($decode_transact_station_id->data as $transaction_station)
		{
			$count = "SELECT `id` FROM transaction_competent ORDER BY `id` DESC LIMIT 1";
			$items = $crud->select_query($count);
			$decode = json_decode($items);
			$id = (is_null($decode->data[0]->id)?0:$decode->data[0]->id)+1;

			$sql_competent_name = "SELECT `name` FROM `competent` WHERE `id` = '$competentID'";
			$result = $crud->select_query($sql_competent_name);
			$decode_competent = json_decode($result);
			$competentName = $decode_competent->data[0]->name;

			$sql = "INSERT transaction_competent(`transact_competent_id`,`transact_station_id`,`competent_id`,`competent_name`,`weight`) VALUES ('".$id."','".$transaction_station->id."','".$competentID."','".$competentName."','".$competentWeight."')";
			$run = $crud->query($sql);
			if($run)
			{
				print_r($run);			
			}
		}
	}
	
	function addBatch()
	{
		$crud = new dbcontroller();
		$period = $_POST['id'];
		$competentID = $_POST['competentID'];
		$competentWeight = $_POST['weight'];

		$table_transact_id = "transaction_station";
		$column_transact_id = "period_id";
		$transact_station_id = $crud->get_data_id($table_transact_id, $column_transact_id, $period);
		$decode_transact_station_id = json_decode($transact_station_id);
		
		foreach($decode_transact_station_id->data as $transaction_station)
		{
			foreach($competentID as $key=>$value)
			{
				$count = "SELECT `id` FROM transaction_competent ORDER BY `id` DESC LIMIT 1";
				$items = $crud->select_query($count);
				$decode = json_decode($items);
				$id = (is_null($decode->data[0]->id)?0:$decode->data[0]->id)+1;

				$sql_competent_name = "SELECT `name` FROM `competent` WHERE `id` = '$value'";
				$result = $crud->select_query($sql_competent_name);
				$decode_competent = json_decode($result);
				$competentName = $decode_competent->data[0]->name;

				$sql = "INSERT transaction_competent(`transact_competent_id`,`transact_station_id`,`competent_id`,`competent_name`,`weight`) VALUES ('".$id."','".$transaction_station->id."','".$value."','".$competentName."','".$competentWeight[$key]."')";
				$run = $crud->query($sql);
				if($run)
				{
					print_r($run);			
				}
			}
		}
	}

	function update()
	{
		$crud = new dbcontroller();
		$session_id = $_POST['id'];
		$competentID = $_POST['competentID'];
		$competentWeight = $_POST['weight'];

		$table_transact_id = "transaction_station";
		$column_transact_id = "session_id";
		$transact_station_id = $crud->get_data_id($table_transact_id, $column_transact_id, $session_id);
		$decode_transact_station_id = json_decode($transact_station_id);

		foreach($decode_transact_station_id->data as $transaction_station)
		{
			foreach($competentID as $key=>$value)
			{
				$sql = "UPDATE transaction_competent SET `weight` = '".$competentWeight[$key]."' WHERE `transact_station_id` = '".$transaction_station->id."' AND `competent_id` = '$value'";
				$run = $crud->query($sql);
				if($run)
				{
					print_r($run);			
				}
			}
		}
	}

	function delete()
	{
		$crud = new dbcontroller();
		$session_id = $_POST['id'];
		$competent_id = $_POST['competentDeleteID'];

		$table_transact_id = "transaction_station";
		$column_transact_id = "session_id";
		$transact_station_id = $crud->get_data_id($table_transact_id, $column_transact_id, $session_id);
		$decode_transact_station_id = json_decode($transact_station_id);

		foreach($decode_transact_station_id->data as $transaction_station)
		{
			$sql = "DELETE FROM transaction_competent WHERE transact_station_id = '".$transaction_station->id."' AND competent_id = '$competent_id'";
			$run = $crud->query($sql);
			if($run)
			{
				print_r($run);			
			}
		}
	}

	function add_master()
	{
		$crud = new dbcontroller();

		$name = $_POST['name'];

		$sql = "INSERT competent(`name`) VALUES ('".$name."')";
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

		$sql = "UPDATE competent SET `name` = '".$name."' WHERE `id` = '".$id."'";
		$items = $crud->query($sql);

		if($items)
		{
			print_r($items);			
		}
	}

	function delete_master()
	{
		$id = $_POST['id'];
		$crud = new dbcontroller();
		$table = "competent";
		$column = "id";
		$items = $crud->delete_data($table,$column,$id);
		if($items)
		{
			print_r($items);
		}
	}

	function test_query()
	{
		$crud = new dbcontroller();

		$table_transact_id = "transaction_station";
		$column_transact_id = "session_id";
		$session = "19";
		$transact_station_id = $crud->get_data_id($table_transact_id, $column_transact_id, $session);
		print_r($transact_station_id);
	}
?>
