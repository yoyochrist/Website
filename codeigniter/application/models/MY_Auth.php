<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	class MY_Auth extends CI_Model
	{
		function __Construct()
		{
			parent ::__construct();
		}
	
		function validate($username, $password)
		{
			$hash_password = md5($password);
			$q = "SELECT * FROM msuser WHERE msuser_username = '$username' AND msuser_password = '$hash_password' LIMIT 1;";
			$query = $this->db->query($q);
			//$this->db->where('msuser_username', $username);
			//$this->db->where('msuser_password', $hash_password);
			//$this ->db->limit(1);
			//$query = $this->db->get('msuser');
  
			if($query->num_rows == 1)
			{
				return $query->result();
			}
		}
	}
?>