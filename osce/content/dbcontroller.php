<?php
class DBController {
	
	private $conn;
	
	private $host = "192.168.14.229";
	private $user = "root";
	private $password = "";
	private $database = "osce";
	

	function __construct() {
		
		date_default_timezone_set('Asia/Jakarta');
		
		$this->conn = new mysqli($this->host,$this->user,$this->password,$this->database);
		if(!empty($conn)) {
			if(mysqli_connect_errno($conn)) {
				die("ERROR: Could not connect to MySQL: " . mysqli_connect_error());
			}
		}
	}
	

	
	
	function login($id, $pswd) {
	  $sql="select * from lecturer where id='$id' and pswd=md5(md5('$pswd'))";
	  $result = $this->conn->query($sql);
	  
	  if($result){
		  if ($result->num_rows()>0){
			 $qry = $result->fetch_array();
			 return 1;
		  }	else return 0;}
	  else return 0;
	}
	
	
	
	//for return multiple row
	function runQuery($sql) {
		$result = $this->conn->query($sql);
		
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
		$result = $this->conn->query($sql);
		
		if($result){
			$row = $result->fetch_assoc(); 
			return $row;
		}
	}

	//for return as an object
	function runQueryO($sql) {
		$result = $this->conn->query($sql);
		
		if($result){
			return $result;
		}
	}


}
	
?>