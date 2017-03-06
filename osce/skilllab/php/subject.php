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
		$column = "period_id, period_name, subject_id, subject_name";
		$condition = "period_id = ".$id;
		$items = $crud->get_data_distinct($table, $column, $condition);
		if($items)
		{
			print_r($items);
		}
	}

	function add()
	{
		$crud = new dbcontroller();
		$id = $_POST['id'];
		$subject = $_POST['subjekTambah'];
		
		foreach($decode->data as $transaction)
		{
			$sql = "UPDATE `transaction_station` SET `subject_id` = '".$subject."' WHERE `period_id` = '".$id."';";
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

		$sql = "INSERT subject(`name`) VALUES ('".$name."')";
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

		$sql = "UPDATE subject SET `name` = '".$name."' WHERE `id` = '".$id."'";
		$run = $crud->query($sql);

		if($run)
		{
			print_r($run);			
		}
	}

	function delete_master()
	{
		$id = $_POST['id'];
		$crud = new dbcontroller();
		$table = "subject";
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

		$table = "transaction_station";
		$column = "period_id";
		$id = "1";
		$transact = $crud->get_data_id($table, $column, $id);
		$decode = json_decode($transact);

		foreach($decode->data as $transaction)
		{
			print_r($transaction->id);
		}
	}
?>
