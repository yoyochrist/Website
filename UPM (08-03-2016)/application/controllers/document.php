<?php
class document extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
        }
		
        public function view($doc_code,$offset=0)
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
		
            $data['document'] = $this->document_model->get_document_search($doc_code,$config['per_page'],$offset);
			if(isset($data['document']['doc_code']))
				$total = count($data['document']['doc_code']);
			else
				$total = count($data['document']);
			
			$role = ($this->session->userdata['logged_in']['idrole']);
			$rolename = $this->login_database->read_user_role($role)[0]->rolename;
			if($total == 1)
			{
				$this->load->view('core/detail', $data);
			}
			else
			{
				$this->load->view('core/'.$rolename.'_page', $data);
			}
		}
		
		public function search()
		{
			$keyword = $this->input->post('doc_code');
			$this->view($keyword);
		}
		
		public function complete_search()
		{
			$doclevel = $this->input->post('doc_level');
			$doctype = $this->input->post('doc_type');
			$docno = $this->input->post('doc_no');
			$keyword = $doclevel.'-'.$doctype.'-%'.$docno.'%';
			$this->view($keyword);
		}
		
		public function view_search()
		{
			$data['doclevel'] = $this->document_model->get_dropdown_doc_levellist();
			$data['doctype'] = $this->document_model->get_dropdown_doc_typelist();
			
			$this->load->view('core/search', $data);
		}
		
		public function type_response()
		{
			$doc_code = $this->input->post('doc_level');
			$doctype = $this->document_model->get_dropdown_doc_type_response($doc_code);
			
			$data .= '<option value="%">ALL</option>';
			foreach($doctype as $doc);
			{
				$data .= "<option value='".$doc['doc_type']."'>".$doc['doctype_name']."</option>";
			}
			echo $data;
		}
		
		public function view_update($doc_code)
        {
                $data['detail'] = $this->document_model->get_document_detail($doc_code);
				$data['doctype'] = $this->document_model->get_dropdown_doc_typelist();
				$data['doclevel'] = $this->document_model->get_dropdown_doc_levellist();
				
				$this->load->view('core/update', $data);
        }
		
		public function autocomplete()
		{
			$doc_code = $this->input->post('doc_code',TRUE);
			$query = $this->document_model->get_document_code();
	 
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
				
				$this->document_model->update_document($doc_code,$update_data);
				$this->session->set_flashdata('display_messages', 'Input Data Succesfull ');
				redirect(site_url().'/portal/view');
			}
        }
		
		public function create()
		{
			$data['error_message'] = '';    //initialize image upload error array to empty
 
			$config['upload_path'] = './document/';
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
			
			
			$data['doctype'] = $this->document_model->get_dropdown_doc_typelist();
			$data['doclevel'] = $this->document_model->get_dropdown_doc_levellist();
			
			// If upload failed, display error
			if (!$this->upload->do_upload('doc_filename')) 
			{
				$data['error_message'] = $this->upload->display_errors();
	 
				$this->load->view('core/input', $data);
			}
			else 
			{
				$file_data = $this->upload->data();
				$file_path =  './document/'.$file_data['file_name'];
	 
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
					$this->document_model->insert_document($insert_data);
					$this->session->set_flashdata('display_messages', 'Input Data Succesfull ');
					redirect(site_url().'/portal/view');
					//echo "<pre>"; print_r($insert_data);
				}
				else 
				{
					$data['error_message'] = "Input Data Failed";
					$this->load->view('core/input', $data);
				}
			}
		}
		
		public function delete_row($doc_code)
		{
			$this->document_model->delete_document($doc_code);
			redirect($_SERVER['HTTP_REFERER']);
		}
}
?>