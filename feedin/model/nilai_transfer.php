<?php
	include('..lib/crud.php');

	if(function_exists($_GET['f'])) {
		$_GET['f']();
	}

	function get()
	{
		$crud = new crud();

		$table = "piconfig";
		$items = $crud->get($table);
		print_r($items);
	}

	function add()
	{
		$crud = new crud();

		$ipAddress = $_POST['ipAddress'];
		$status = $_POST['status'];
		$name = $_POST['name'];
		
		$insert_array = array(
							'ipaddress'=>$ipAddress,
							'name'=>$name,
							'state'=>$status
						);
		$table='piconfig';
		$run = $crud->insert_array($table,$insert_array);
		if($run)
		{
			print_r($run);			
		}
	}

	function update()
	{
		$crud = new crud();

		$id = $_POST['idUpdate'];
		$ipAddress = $_POST['ipAddressUpdate'];
		$status = $_POST['statusUpdate'];
		$name = $_POST['nameUpdate'];

		/* $update_array = array(
							'ipaddress'=>$ipAddress,
							'name'=>$name,
							'state'=>$status
						);
		$condition=array('id'=>$id); */
		$table='piconfig';
		$sql = "UPDATE `piconfig` SET `ipaddress` = '".$ipAddress."', `name` = '".$name."', `state` = '".$status."' WHERE `id` = '".$id."';";
		// $run = $crud->update_array($table,$update_array,$condition);
		$run = $crud->execute($sql);
		if($run)
		{
			print_r($run);			
		}
	}

	function delete()
	{
		$crud = new crud();
		
		$id = $_POST['id'];
		$table = "piconfig";
		$column = "id";
		$items = $crud->delete($table,$column,$id);
		if($items)
		{
			print_r($items);
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
