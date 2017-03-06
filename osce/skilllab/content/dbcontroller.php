<?php
	class dbcontroller
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


		public function select_query($sql){
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

		public function select_array($table,$array)
		{
			$i = 0;
			foreach($array as $index=>$key)
			{
				$column[$i] = $index;
				$value[$i] = $key;
				$i++;
			}

			for($j=0;$j<$i;$j++)
			{
				if($j+1==$i)
				{
					$condition = $condition."`".$column[$j]."` = '".$value[$j]."'";
				}		
				else
				{
					$condition =  $condition."`".$column[$j]."` = '".$value[$j]."' AND ";
				}
			}

			$sql = "SELECT * FROM `".$table."` WHERE ".$condition.";";
			$this->select_query($sql);
		}

		public function insert_array($table,$array)
		{
			$i = 0;
			foreach($array as $index=>$key)
			{
				$column[$i] = $index;
				$value[$i] = $key;
				$i++;
			}

			$columns = '(';
			$values = '(';
			for($j=0;$j<$i;$j++)
			{
				if($j+1==$i)
				{
					$columns = $columns."`".$column[$j]."`)";
					$values =  $values."'".$value[$j]."');";
				}		
				else
				{
					$columns = $columns."`".$column[$j]."`,";
					$values =  $values."'".$value[$j]."',";
				}
			}
			$sql = "INSERT INTO `".$table."`".$columns." VALUES ".$values;
			$this->query($sql);
		}

		public function delete_array($table,$array)
		{
			$i = 0;
			foreach($array as $index=>$key)
			{
				$column[$i] = $index;
				$value[$i] = $key;
				$i++;
			}

			for($j=0;$j<$i;$j++)
			{
				if($j+1==$i)
				{
					$condition = $condition."`".$column[$j]."` = '".$value[$j]."'";
				}		
				else
				{
					$condition =  $condition."`".$column[$j]."` = '".$value[$j]."' AND ";
				}
			}

			$sql = "DELETE FROM `".$table."` WHERE ".$condition.";";
			$this->query($sql);
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
		
		

		//for return multiple row
		function runQuery($sql) {
		$result = $this->link->query($sql);
		
		if($result){
			while($row = $result->fetch_assoc()) {
				$resultset[] = $row;
			}		
			if(!empty($resultset))
				return $resultset;
		
			}
		}

		//for return only a row
		function runQueryS($sql) {
			$result = $this->link->query($sql);
			
			if($result){
				$row = $result->fetch_assoc(); 
				return $row;
			}
		}

		//for return as an object
		function runQueryO($sql) {
			$result = $this->link->query($sql);
			
			if($result){
				return $result;
			}
		}
		
		
		public function select_query2($sql){
			$result = $this->link->query($sql);
			if($result)
			{
				while($row = $result->fetch_assoc())
				{
					$data[] = $row;
					
				}
				return json_encode($data);
			}
			else
			{
				die("Error Message: ". $this->link->error);
			}
		}		

		

		
	}
?>
