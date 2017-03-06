<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	class Authentication_Login
	{
		// SET SUPER GLOBAL
		var $CI = NULL;
		public function __construct() {
			$this->CI =& get_instance();
		}
		
		// Fungsi login
		public function login($username, $password) {
			$query = $this->CI->db->get_where('msuser',array('username'=>$username,'password' => $password));
			if($query->num_rows() == 1) {
				$row 	= $this->CI->db->query('SELECT username FROM msuser where username = "'.$username.'"');
				$admin 	= $row->row();
				$this->CI->session->set_userdata('username', $username);
				$this->CI->session->set_userdata('id_login', uniqid(rand()));
				redirect(base_url('Portal'));
			}else{
				$this->CI->session->set_flashdata('sukses','Oops... Username/password salah');
				redirect(base_url('Login'));
			}
			return false;
		}
		
		// Proteksi halaman
		public function cek_login() {
			if($this->CI->session->userdata('username') == '') {
				$this->CI->session->set_flashdata('sukses','Anda belum login');
				redirect(base_url('Login'));
			}
		}
		
		// Fungsi logout
		public function logout() {
			$this->CI->session->unset_userdata('username');
			$this->CI->session->unset_userdata('id_login');
			$this->CI->session->set_flashdata('sukses','Anda berhasil logout');
			redirect(base_url('Login'));
		}
	}
?>