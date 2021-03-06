<?php
	class crud
	{

		private $link;
		private $hostDB = "localhost";
		private $userDB = "postgres";
		private $passDB = "ukrida2016";
		private $port = "5432";
		private $database = "admisi";

		public function __construct()
		{
			$this->link = pg_pconnect('host='.$this->hostDB.' port='.$this->port.' dbname='.$this->database.' user='.$this->userDB.' password='.$this->passDB);

			if(mysqli_connect_errno($this->link)) {
				die("ERROR: Could not connect to MySQL: " . mysqli_connect_error());
			}
		}
		
		public function query($sql)
		{
			$result = pg_query($this->link, $sql);
			
			return $result;
		}
		
		public function get($table)
		{
			$sql = "SELECT * FROM `".$table."`;";
			$result = $this->query($sql);
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
		
		public function select($sql)
		{
			$result = $this->query($sql);
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
			$this->select($sql);
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
			$this->execute($sql);
		}

		public function update_array($table,$array,$array_condition)
		{
			$i = 0;
			foreach($array as $index=>$key)
			{
				$column[$i] = $index;
				$value[$i] = $key;
				$i++;
			}

			$j = 0;
			foreach($array_condition as $index=>$key)
			{
				$conditioncol[$j] = $index;
				$conditionval[$j] = $key;
				$j++;
			}

			for($k=0;$j<$i;$k++)
			{
				if($k+1==$i)
				{
					$set = $set."`".$column[$k]."` = '".$value[$k]."'";
				}
				else
				{
					$set =  $set."`".$column[$k]."` = '".$value[$k]."' AND ";
				}
			}

			for($l=0;$l<$j;$l++)
			{
				if($l+1==$j)
				{
					$condition = $condition."`".$conditioncol[$l]."` = '".$conditionval[$l]."'";
				}
				else
				{
					$condition =  $condition."`".$conditioncol[$l]."` = '".$conditionval[$l]."' AND ";
				}
			}

			$sql = "UPDATE `".$table."` SET ".$set." WHERE ".$condition.";";
			$this->execute($sql);
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
			$this->execute($sql);
		}

		public function get_data($id)
		{
			$sql = "SELECT `piconfig`.`ipaddress`, `urlconfig`.`url` FROM `piconfig` JOIN `urlconfig` ON `piconfig`.`state` = `urlconfig`.`id` WHERE `ipaddress` = '".$id."' LIMIT 1";
			$result = $this->query($sql);

			if($result)
			{
				while($row = $result->fetch_assoc())
				{
					$data = $row;
					$items = array("data"=>$data);
				}
			}
			else
			{
				die("Error Message: ". $this->link->error);
			}

			return json_encode($items);
		}

		public function delete($table,$column,$content)
		{
			$sql = "DELETE FROM ".$table." WHERE ".$column." = ".$content;
			$result = $this->query($sql);

			if($result)
			{
			}
			else
			{
				die("Error Message: ". $this->link->error);
			}
		}

		public function execute($sql)
		{
			$result = $this->query($sql);

			if($result)
			{
			}
			else
			{
				die("Error Message: ". $this->link->error);
			}
		}
	}
?>
