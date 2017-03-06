<?php
class DBController {
	private $host = "192.168.14.229";
	private $user = "root";
	private $password = "";
	private $database = "osce";
	
	function __construct() {
		$conn = $this->connectDB();
		if(!empty($conn)) {
			$this->selectDB($conn);
		}
	}
	
	function connectDB() {
		$conn = mysql_connect($this->host,$this->user,$this->password);
		return $conn;
	}
	
	function selectDB($conn) {
		mysql_select_db($this->database,$conn);
	}
	
	
	function login($id, $pswd) {
	  $sql="select * from userx where id='$id' and pswd=md5(md5('$pswd'))";
	  $result = mysql_query($sql);
	  
	  if (mysql_num_rows($result)>0){
		 $qry = mysql_fetch_array($result);
		 return 1;
	  }	else return 0;
	}
	
	
	function runQuery($query) {
		$result = mysql_query($query);
		while($row=mysql_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysql_query($query);
		$rowcount = mysql_num_rows($result);
		return $rowcount;	
	}
}
?>
