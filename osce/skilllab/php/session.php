<?php
	include('../content/dbcontroller.php');

	if(function_exists($_GET['f'])) {
		if(isset($_GET['pid']))
		{
			$_GET['f']($_GET['pid']);
		}
		else
		{
			$_GET['f']();
		}
	}

	function get_data()
	{
		$crud = new dbcontroller();
		$sql = "SELECT session.id, session.name, session.time_start, session.time_end, session.period_id, period.name AS period_name FROM session JOIN period ON session.period_id = period.id WHERE period.active = 1";
		$items = $crud->select_query($sql);
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

		$count = "SELECT `id` FROM session ORDER BY `id` DESC LIMIT 1";
		$items = $crud->select_query($count);
		$decode = json_decode($items);
		$id = (is_null($decode->data[0]->id)?0:$decode->data[0]->id)+1;

		$sql = "INSERT session(`period_id`,`name`,`time_start`,`time_end`, `station_available`, `location_used`) VALUES ('".$period_id."','".$name."','".$start."','".$end."', '".$station."', '".$location."')";
		$run = $crud->query($sql);
		if($run)
		{
			print_r($run);
		}
		else
		{
			for($i = 1; $i <= $location; $i++)
			{
				for($j = 1; $j <= $station; $j++)
				{
					$template_competent = "SELECT DISTINCT `competent_id`,`competent_name`,`weight`, `subject_id` FROM `view_transaction_competent` WHERE `period_id` = '".$period_id."';";
					$run_template = $crud->select_query($template_competent);
					$template = json_decode($run_template);
					$subject = $template->data[0]->subject_id;

					//$sqltransaction = "INSERT transaction_station(`period_id`,`session_id`,`location_id`,`station_id`, `subject_id`) VALUES ('".$period_id."','".$id."','".$i."','".$j."','".$subject."')";
					$sqltransaction = "INSERT transaction_station(`period_id`,`session_id`,`location_id`,`station_id`) VALUES ('".$period_id."','".$id."','".$i."','".$j."')";
					$runtransaction = $crud->query($sqltransaction);
				}
			}
		}
	}

	function update()
	{
		$crud = new dbcontroller();

		$name = $_POST['name'];
		$start = $_POST['date_start'];
		$end = $_POST['date_end'];
		$id = $_POST['id'];

		$sql = "UPDATE session SET `name` = '".$name."',`time_start` = '".$start."',`time_end`='".$end."' WHERE `id` = ".$id;
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
		$table = "session";
		$column = "id";
		$items = $crud->delete_data($table,$column,$id);
		if($items)
		{
			print_r($items);
		}
		else
		{
			$table_station = "transaction_station";
			$column_station = "session_id";
			$items_station = $crud->delete_data($table_station,$column_station,$id);
			if($items_station)
			{
				print_r($items_station);
			}
		}
	}
?>
