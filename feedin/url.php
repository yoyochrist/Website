<?php
	include('crud.php');

	if(function_exists($_GET['f'])) {
		$_GET['f']();
	}

	function get()
	{
		$crud = new crud();

		$table = "urlconfig";
		$items = $crud->get($table);
		print_r($items);
	}

	function add()
	{
		$crud = new crud();

		$url = $_POST['url'];
		$id = $_POST['id'];
		
		$insert_array = array(
					'url'=>$url,
					'id'=>$id
				);
		$table='urlconfig';
		$run = $crud->insert_array($table,$insert_array);
		if($run)
		{
			print_r($run);			
		}
	}

	function update()
	{
		$crud = new crud();

		$url = $_POST['url'];
		$id = $_POST['id'];
		
		/* $update_array = array('url'=>$url);
		$condition=array('state'=>$status); 
		$table='urlconfig';*/
		$sql = "UPDATE `urlconfig` SET `url` = '".$url."' WHERE `id` = '".$id."';";
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
		$table = "urlconfig";
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
