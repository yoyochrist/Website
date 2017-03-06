<?php
	class crud
	{

		private $link;
		private $hostDB = "192.168.14.229";
		private $userDB = "root";
		private $passDB = "";
		private $database = "osce";

		public function __construct()
		{
			$this->link = new mysqli($this->hostDB, $this->userDB, $this->passDB, $this->database);

			if(mysqli_connect_errno($this->link)) {
				die("ERROR: Could not connect to MySQL: " . mysqli_connect_error());
			}
		}

		public function get_data($table)
		{
			$sql = "SELECT * FROM `".$table."` ORDER BY `id` DESC";
			$result = $this->link->query($sql);

			if($result)
			{
				while($row = $result->fetch_assoc())
				{
					$data[] = $row;
					$items = array("data"=>$data);
				}
			}
			else
			{
				die("Error Message: ". $this->link->error);
			}

			return json_encode($items);
		}

		public function get_data_asc($table)
		{
			$sql = "SELECT * FROM `".$table."` ORDER BY `id` ASC";
			$result = $this->link->query($sql);

			if($result)
			{
				while($row = $result->fetch_assoc())
				{
					$data[] = $row;
					$items = array("data"=>$data);
				}
			}
			else
			{
				die("Error Message: ". $this->link->error);
			}

			return json_encode($items);
		}

		public function get_data_limit($table, $limit)
		{
			$sql = "SELECT * FROM `".$table."` LIMIT ".$limit;
			$result = $this->link->query($sql);

			if($result)
			{
				while($row = $result->fetch_assoc())
				{
					$data[] = $row;
					$items = array("data"=>$data);
				}
			}
			else
			{
				die("Error Message: ". $this->link->error);
			}

			return json_encode($items);
		}

		public function get_data_distinct($table, $column, $condition)
		{
			$sql = "SELECT DISTINCT ".$column." FROM `".$table."` WHERE ".$condition;
			$result = $this->link->query($sql);

			if($result)
			{
				while($row = $result->fetch_assoc())
				{
					$data[] = $row;
					$items = array("data"=>$data);
				}
			}
			else
			{
				die("Error Message: ".$this->link->error.' '.$sql);
			}

			return json_encode($items);
		}

		public function get_data_id($table,$column,$content)
		{
			$sql = "SELECT * FROM `".$table."` WHERE `".$column."` = ".$content;
			$result = $this->link->query($sql);

			if($result)
			{
				while($row = $result->fetch_assoc())
				{
					$data[] = $row;
					$items = array("data"=>$data);
				}
			}
			else
			{
				die("Error Message: ". $this->link->error);
			}

			return json_encode($items);
		}

		public function delete_data($table,$column,$content)
		{
			$sql = "DELETE FROM ".$table." WHERE ".$column." = ".$content;
			$result = $this->link->query($sql);

			if($result)
			{
			}
			else
			{
				die("Error Message: ". $this->link->error);
			}
		}

		public function query($sql)
		{
			$result = $this->link->query($sql);

			if($result)
			{
			}
			else
			{
				die("Error Message: ". $this->link->error);
			}
		}

		public function select_query($sql)
		{
			$result = $this->link->query($sql);
			if($result)
			{
				while($row = $result->fetch_assoc())
				{
					$data[] = $row;
					$items = array("data"=>$data);
				}
				return json_encode($items);
			}
			else
			{
				die("Error Message: ". $this->link->error);
			}
		}

		public function max($table)
		{
			$sql = "SELECT COUNT(*) AS `max_id` FROM ".$table;
			$result = $this->link->query($sql);
			if($result)
			{
				$row = $result->fetch_object();
				$data = $row->max_id;

				return $data;
			}
			else
			{
				die("Error Message: ". $this->link->error);
			}
		}
	}
?>
