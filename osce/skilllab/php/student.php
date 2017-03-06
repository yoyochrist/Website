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
		$table = "student";
		$items = $crud->get_data($table);
		print_r($items);
	}

	function add_master()
	{
		$crud = new dbcontroller();

		$id = $_POST['snid'];
		$name = $_POST['name'];

		$sql = "INSERT student(`id`, `name`) VALUES('".$id."','".$name."')";
		$run = $crud->query($sql);

		if($run)
		{
			print_r($run);			
		}
	}

	function update_master()
	{
		$crud = new dbcontroller();

		$nim = $_POST['snid'];
		$name = $_POST['name'];

		$sql = "UPDATE student SET `name` = '".$name."', `id` = '".$nim."' WHERE `id` = ".$nim;
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

		$table = "student";
		$column = "id";
		$items = $crud->delete_data($table,$column,$id);

		if($items)
		{
			print_r($items);
		}
	}
?>
