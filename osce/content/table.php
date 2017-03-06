<?php
	include('../skilllab/content/dbcontroller.php');

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

	function data($table)
	{
		$crud = new dbcontroller();
		$items = $crud->get_data_asc($table);
		print_r($items);
	}

	function akademik()
	{
		$crud = new dbcontroller();
		$sql = "SELECT `period`.`id`,`period`.`name` AS `period_name`,`period`.`date_start`,`period`.`date_end`,`session`.`id`,`session`.`name`  AS `session_name`,`session`.`time_start`,`session`.`time_end`,`session`.`station_available`,`session`.`location_used` FROM `period` JOIN `session` ON `period`.`id` = `session`.`period_id` ORDER BY `session`.`id` DESC LIMIT 1;";
		$items = $crud->select_query($sql);
		print_r($items);
	}

	function monitoring()
	{
		$crud = new dbcontroller();
		$sql = "SELECT station_id, count(distinct student_id) as `total_student`, cast(count(`final_comment`)/count(distinct `competent_id`) as decimal(2)) as `graded` FROM osce.grade WHERE period_id = (SELECT id from period WHERE active = 1) and session_id = (select id from session where NOW() BETWEEN time_start AND time_end) group by station_id;";
		$items = $crud->select_query($sql);
		print_r($items);
	}

	function finalscore()
	{
		$crud = new dbcontroller();
		$sql = "SELECT a.student_id,a.session_id,sum(a.score*a.weight)/sum(4*a.weight)*100 as nilai,d.name 
		FROM grade a 
		LEFT JOIN session b ON a.session_id=b.id 
		LEFT JOIN student d ON a.student_id=d.id
		WHERE a.session_id=1 and a.period_id = 1
		GROUP BY a.student_id;";
		$items = $crud->select_query($sql);
		print_r($items);
	}

	function get_dropdown($table)
	{
		$crud = new dbcontroller();
		$items = $crud->get_data($table);
		print_r($items);
	}

	function get_session_dropdown()
	{
		$crud = new dbcontroller();
		$sql = "SELECT * FROM session WHERE period_id = (SELECT id FROM period WHERE active = 1)";
		$items = $crud->select_query($sql);
		print_r($items);
	}

	function get_competent($id)
	{
		$crud = new dbcontroller();
		$sql = "SELECT DISTINCT session_id, subject_id, competent_id, competent_name, weight FROM view_transaction_competent WHERE session_id = ".$id;
		$items = $crud->select_query($sql);
		print_r($items);
	}

	function count_period()
	{
		$crud = new dbcontroller();
		$sql = "SELECT a.id, a.name, a.date_start, a.date_end, (SELECT COUNT(*) FROM session WHERE session.period_id = a.id) AS count FROM period a WHERE a.exam_type = 'SL' ORDER BY id DESC";
		$items = $crud->select_query($sql);
		print_r($items);
	}
	
	function describe($id)
	{
		$crud = new dbcontroller();
		$describe = "DESCRIBE ".$id;
		$items = $crud->select_query($describe);
		print_r($items);
	}

	function test_query()
	{
		$crud = new dbcontroller();
		$describe = "SELECT `period_id`, `session_id`, `location_id`, `station_id`, `lecturer_id`, `lecturer_name`, `subject_id`, subject_name`, competent_id`, `competent_name`, `weight` FROM view_transaction_competent WHERE `period_id` = '5' AND `session_id` = '7' AND `location_id` = '1' AND `station_id` = '1'";
		$items = $crud->select_query($describe);
		print_r($items);
	}
?>
