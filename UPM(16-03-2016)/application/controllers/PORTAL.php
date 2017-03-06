<?php

//session_start(); //we need to start session in order to access it through CI

class PORTAL extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	// Show login page
	public function index() {
		$this->load->view('login_form');
	}

	// Show registration page
	/*public function user_registration_show()
	{
		$this->load->view('registration_form');
	}

	// Validate and store registration data in database
	public function new_user_registration()
	{

		// Check validation for user input in SignUp form
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('registration_form');
		} 
		else 
		{
			$data = array(
					'user_name' => $this->input->post('username'),
					'user_email' => $this->input->post('email_value'),
					'user_password' => $this->input->post('password')
				);
			$result = $this->LOGIN_DATABASE->registration_insert($data);
			if ($result == TRUE) 
			{
				$data['message_display'] = 'Registration Successfully !';
				$this->load->view('login_form', $data);
			}
			else
			{
				$data['message_display'] = 'Username already exist!';
				$this->load->view('registration_form', $data);
			}
		}
	}*/

	// Check for user login process
	public function login() {

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in']))
			{
				$this->load->view('core/admin_page');
			}
			else
			{
				$this->load->view('login_form');
			}
		} 
		else 
		{
			$data = array(
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);
			$result = $this->LOGIN_DATABASE->login($data);
			if ($result == TRUE) 
			{
				$username = $this->input->post('username');
				$result = $this->LOGIN_DATABASE->read_user_information($username);
				if ($result != false) 
				{
					$session_data = array(
							'username' => $result[0]->user_name,
							'idrole' => $result[0]->user_idrole,
						);
					// Add user data in session
					$this->session->set_userdata('logged_in', $session_data);
									
					$role = $this->LOGIN_DATABASE->read_user_role($result[0]->user_idrole);
					if ($role != false) 
					{
						redirect('PORTAL/view');
					}
				}
			} 
			else 
			{
				$data = array("error_message" => "Invalid Username or Password");
				$this->load->view('login_form', $data);
			}
		}
	}
	
	public function view($offset=0)
	{  
		$jml = $this->db->get('trdocument');
	   
		$config['base_url'] = site_url().'/portal/view';
	   
		$config['total_rows'] = $jml->num_rows();
		$config['per_page'] = 25;  
		$config['uri_segment'] = 3; 
	   
	   
		$config['full_tag_open'] = "<ul class='pagination pagination-sm' style='position:relative; top:-25px;'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
	  
		$this->pagination->initialize($config);
	   
		$data['page'] = $this->pagination->create_links();
		
		$data['offset'] = $offset;

		$data['document'] = $this->DOCUMENT_MODEL->get_document($config['per_page'], $offset);
		$data['doclevel'] = $this->DOCUMENT_MODEL->get_dropdown_doc_levellist();
		$data['doctype'] = $this->DOCUMENT_MODEL->get_dropdown_doc_typelist();
		
		$role = ($this->session->userdata['logged_in']['idrole']);
		$rolename = $this->LOGIN_DATABASE->read_user_role($role)[0]->rolename;
		
		$this->load->view('core/'.$rolename.'_page',$data);
	}

	// Logout from admin page
	public function logout() {

		// Removing session data
		$sess_array = array(
				'username' => ''
			);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message_display'] = 'Successfully Logout';
		$this->load->view('login_form', $data);
	}

}

?>