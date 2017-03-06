<?php
 
class CSV extends CI_Controller {
 
    function __construct() {
        parent::__construct();
		$this->load->library('CSVIMPORT');
    }
 
    function index() {
		$data['document'] = $this->CSV_MODEL->get_document();
		$this->load->view('csv/csvindex', $data);
	}
 
    function importcsv() {
        $data['document'] = $this->CSV_MODEL->get_document();
        $data['error'] = '';    //initialize image upload error array to empty
 
        $config['upload_path'] = './csv/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
 
        $this->load->library('upload', $config);
 
 
        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
 
            $this->load->view('csv/csvindex', $data);
        } else {
            $file_data = $this->upload->data();
            $file_path =  './csv/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
					$date = $row['doc_date_created'];
					$day = substr($row['doc_date_created'],0,2);
					$month = substr($row['doc_date_created'],3,2);
					$year = substr($row['doc_date_created'],6,4);
					$doc_code = $row['doc_level']."-".$row['doc_type']."-".$row['doc_no'];
                    $insert_data = array(
                        'doc_level'=>$row['doc_level'],
                        'doc_type'=>$row['doc_type'],
                        'doc_no'=>$row['doc_no'],
						'doc_code'=>$doc_code,
                        'doc_title'=>$row['doc_title'],
						'doc_rev_no'=>$row['doc_rev_no'],
						'doc_author'=>$row['doc_author'],
						'doc_date_created'=>$year."-".$month."-".$day,
						'doc_filename'=>$row['doc_filename'],
                    );
			$this->CSV_MODEL->insert_csv($insert_data);
                }
		$this->session->set_flashdata('success', 'CSV Data Imported Succesfully');
                redirect(site_url().'/CSV');
                //echo "<pre>"; print_r($insert_data);
            } else 
                $data['error'] = "Error occured";
                $this->load->view('csv/csvindex', $data);
            }
 
        } 
 
}
/*END OF FILE*/
?>