<?php
class DOCUMENT extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
	

    public function doc_code_check()
    {
        // allow only Ajax request    
        if($this->input->is_ajax_request()) 
        {
             $substrfile = $this->input->post('substrfile');
	     list($doc_level, $doc_type, $doc_no) = split('-', $substrfile);

             if($this->form_validation->is_unique($doc_level, 'msleveldocument')) 
	     {
                  // set the json object as output                 
                  $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'The email is already taken, choose another one')));
             }
	     else
	     {
		   if($this->form_validation->is_unique($doc_type, 'mstypedocument')) 
		   {
                        // set the json object as output                 
 		        $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'The email is already taken, choose another one')));
            	   }
		   else
                   {
			if(!is_numeric($doc_no))
			{
				$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'The email is already taken, choose another one')));
			}
                   }
	     }
           }
       }

    function add_ajax_doc_type($doc_level){
			if($doc_level == "ALL")
				$doc_level = "%";
		    $condition = "doc_level like " . "'" . $doc_level . "'";
			$this->db->from('mstypedocument');
			$this->db->join('trdocument','mstypedocument.typedoc_id = trdocument.doc_type');
			$this->db->where($condition);
			$query = $this->db->get();
		    if($doc_level == 'ALL')
			{
				$data = "<option value='ALL' selected>ALL</option>";
			}
			else
			{
				$data = "<option value='ALL'>ALL</option>";
			}
		    foreach ($query->result() as $value) {
		        $data .= "<option value='".$value->typedoc_id."'>".$value->typedoc_id." (".$value->typedoc_name.")</option>";
		    }
		    echo $data;
		}
		
		function add_ajax_doc_no($doc_type){
			if($doc_type == "ALL")
				$doc_type = "%";
		    $condition = "doc_type like " . "'" . $doc_type . "'";
			$this->db->from('trdocument');
			$this->db->where($condition);
			$query = $this->db->get();	
			if($doc_type == 'ALL')
			{
				$data = "<option value='ALL' selected>ALL</option>";
			}
			else
			{
				$data = "<option value='ALL'>ALL</option>";
			}
		    foreach ($query->result() as $value) {
		        $data .= "<option value='".$value->doc_no."'>".$value->doc_no."</option>";
		    }
		    echo $data;
		}

    public function view($doc_code,$doc_level,$doc_type,$doc_no,$offset=0)
	{
		$condition = "doc_code like " . "'%" . $doc_code . "%'";
		$this->db->select('*');
		$jml = $this->db->get('trdocument');
	   
		$config['base_url'] = site_url().'/document/view';
		  
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
        $data['document'] = $this->DOCUMENT_MODEL->get_document_search($doc_code,$config['per_page'],$offset);
		
		$data['doc_level_check'] = $doc_level;
		$data['doc_type_check'] = $doc_type;
		$data['doc_no_check'] = $doc_no;
		$role = ($this->session->userdata['logged_in']['idrole']);
		$rolename = $this->LOGIN_DATABASE->read_user_role($role)[0]->rolename;
			
		$data['doclevel'] = $this->DOCUMENT_MODEL->get_dropdown_doc_levellist();
		$data['doctype'] = $this->DOCUMENT_MODEL->get_dropdown_doc_typesort($doc_level);
		$data['docno'] = $this->DOCUMENT_MODEL->get_dropdown_doc_typesort($doc_level);
		$data['hide'] = null;
		$this->load->view('core/'.$rolename.'_page', $data);
	}

	public function check_lost_document()	
	{
		$query = $this->db->get('trdocument');
		$result = $query->result_array();
		
		$total = 0;
		foreach($result as $check)
		{
			if(!file_exists('./pdf/'.$check['doc_filename']))
				$lost[] = $check;
				$total++;
		}
		$config['total_rows'] = $total;
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
		$data['offset'] = 0;
		
		$data['document'] = $lost;
		$data['doclevel'] = $this->DOCUMENT_MODEL->get_dropdown_doc_levellist();
		$this->load->view('core/document_page',$data);
	}
	
	public function check_lost_record()	
	{
		$dir = './pdf/';
		$opendir = opendir($dir);
		
		while (FALSE !== ($filename = readdir($opendir))) {
			$files[] = $filename;
		}
		
		$total = 0;
		foreach($files as $file)
		{
			$filename = substr($file,0,-4);
			if($this->DOCUMENT_MODEL->get_lost_record($filename)==FALSE)
				$lost[] = $filename.'.pdf';
				$total++;
		}
		$config['total_rows'] = $total;
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
		$data['offset'] = 0;
		
		$data['document'] = $lost;
		$data['doclevel'] = $this->DOCUMENT_MODEL->get_dropdown_doc_levellist();
		$this->load->view('core/record_page',$data);
	}
	
	public function search()
	{
		if($this->input->post('doc_code'))
		{
			$doclevel = null;
			$doctype = null;
			$docno = null;
			$keyword = $this->input->post('doc_code');
		}
		else
		{
			$doclevel = $this->input->post('doc_level');
			$doctype = $this->input->post('doc_type');
			$docno = $this->input->post('doc_no');
			if($doclevel == "ALL")
				$doclevel = "%";
			if($doctype == "ALL")
				$doctype = "%";
			if($docno == "ALL")
				$docno = "%";
			
			$keyword = $doclevel.'-'.$doctype.'-'.$docno;
		}
		
		$this->view($keyword,$doclevel,$doctype,$docno);
	}
	
	public function complete_search()
	{
		$doclevel = $this->input->post('doc_level');
		$doctype = $this->input->post('doc_type');
		$docno = $this->input->post('doc_no');
		$keyword = $doclevel.'-'.$doctype.'-%'.$docno.'%';
		$this->view($keyword);
	}
	
	public function view_update($doc_code)
    	{
		$data = $this->DOCUMENT_MODEL->get_document_detail($doc_code);
		$data['doc_code'] = $doc_code;
		$data['doctype'] = $this->DOCUMENT_MODEL->get_dropdown_doc_typelist();
		$data['doclevel'] = $this->DOCUMENT_MODEL->get_dropdown_doc_levellist();
				
		$this->load->view('core/update', $data);
    	}
		
	public function autocomplete()
	{
		$doc_code = $this->input->post('doc_code',TRUE);
		$query = $this->DOCUMENT_MODEL->get_document_code();
	
		$document       =  array();
		foreach ($query as $doc) {
			$document[]     = array(
				'doc_code' => $doc->doc_code,
			);
		}
		echo json_encode($document);
	}
	
	public function update($doc_code)
	{
		$this->form_validation->set_rules('doc_level', 'Document Level', 'required');
		$this->form_validation->set_rules('doc_type', 'Document Type', 'required');
		$this->form_validation->set_rules('doc_no', 'Document Number', 'required');
		$this->form_validation->set_rules('doc_title', 'Title', 'required');
		$this->form_validation->set_rules('doc_rev_no', 'Revision', 'required');
		$this->form_validation->set_rules('doc_author', 'Author', 'required');
		$this->form_validation->set_rules('doc_date_created', 'Date Created', 'required');			
		$this->form_validation->set_rules('doc_date_valid', 'Date Valid', 'required');
			
		if($this->form_validation->run() == FALSE)
		{
			$data['error_message'] = "Update Data Failed";
			$this->load->view('core/update', $data);
		}
		else
		{
			$update_data = array(
				'doc_level'=>$this->input->post('doc_level'),
				'doc_type'=>$this->input->post('doc_type'),
				'doc_no'=>$this->input->post('doc_no'),
				'doc_code'=>$this->input->post('doc_level')."-".$this->input->post('doc_type')."-".$this->input->post('doc_no'),
				'doc_title'=>$this->input->post('doc_title'),
				'doc_rev_no'=>$this->input->post('doc_rev_no'),
				'doc_author'=>$this->input->post('doc_author'),
				'doc_date_created'=>$this->input->post('doc_date_created'),
				'doc_date_valid'=>$this->input->post('doc_date_valid'),
			);
			
			$this->DOCUMENT_MODEL->update_document($doc_code,$update_data);
			$this->session->set_flashdata('display_messages', 'Input Data Succesfull ');
			redirect(site_url().'/PORTAL/view');
		}
	}
	
	public function input()
	{
		$data['error_message'] = null;
		$data['doctype'] = $this->DOCUMENT_MODEL->get_dropdown_doc_typelist();
		$data['doclevel'] = $this->DOCUMENT_MODEL->get_dropdown_doc_levellist();

		$this->load->view('core/input',$data);
	}

	public function create()
	{
		$data['error_message'] = '';    //initialize image upload error array to empty
 		$config['upload_path'] = './pdf/';
		$config['allowed_types'] = 'pdf';
		$config['max_size'] = '1000';
		$this->load->library('upload', $config);
		
		$this->form_validation->set_rules('doc_level', 'Document Level', 'required');
		$this->form_validation->set_rules('doc_type', 'Document Type', 'required');
		$this->form_validation->set_rules('doc_no', 'Document Number', 'required');
		$this->form_validation->set_rules('doc_title', 'Title', 'required');
		$this->form_validation->set_rules('doc_rev_no', 'Revision', 'required');
		$this->form_validation->set_rules('doc_author', 'Author', 'required');
		$this->form_validation->set_rules('doc_date_created', 'Date Created', 'required');
		$this->form_validation->set_rules('doc_date_valid', 'Date Valid', 'required');
		
		
		$data['doctype'] = $this->DOCUMENT_MODEL->get_dropdown_doc_typelist();
		$data['doclevel'] = $this->DOCUMENT_MODEL->get_dropdown_doc_levellist();
			
		// If upload failed, display error
		if (!$this->upload->do_upload('doc_filename')) 
		{
			$data['error_message'] = $this->upload->display_errors();
	 
			$this->load->view('core/input', $data);
		}
		else 
		{
			$file_data = $this->upload->data();
			$file_path =  './pdf/'.$file_data['file_name'];
	 
			if ($file_path) 
			{
				$doc_code = $this->input->post('doc_level')."-".$this->input->post('doc_type')."-".$this->input->post('doc_no');
				$insert_data = array(
					'doc_level'=>$this->input->post('doc_level'),
					'doc_type'=>$this->input->post('doc_type'),
					'doc_no'=>$this->input->post('doc_no'),
					'doc_code'=>$doc_code,
					'doc_title'=>$this->input->post('doc_title'),
					'doc_rev_no'=>$this->input->post('doc_rev_no'),
					'doc_author'=>$this->input->post('doc_author'),
					'doc_date_created'=>$this->input->post('doc_date_created'),
					'doc_date_valid'=>$this->input->post('doc_date_valid'),
					'doc_filename'=>$file_data['file_name'],
				);
				$this->DOCUMENT_MODEL->insert_document($insert_data);
				$this->session->set_flashdata('display_messages', 'Input Data Succesfull ');
				redirect(site_url().'/PORTAL/view');
				//echo "<pre>"; print_r($insert_data);
			}
			else 
			{
				$data['error_message'] = "Input Data Failed";
				$this->load->view('core/input', $data);
			}
		}
	}
	
	public function delete_row($doc_code, $doc_filename)
	{
		$this->DOCUMENT_MODEL->delete_document($doc_code,$doc_filename);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete_file($doc_filename)
	{
		$this->DOCUMENT_MODEL->delete_file($doc_filename);
		redirect($_SERVER['HTTP_REFERER']);
	}
}
?>