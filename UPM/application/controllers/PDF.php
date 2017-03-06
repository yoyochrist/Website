<?php 
CLASS PDF extends CI_Controller {
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $this->load->view('pdf/pdfindex', array('error' => ' ' ));
    }
    function file_upload()
    {
        $this->load->library('upload');
	$files = $_FILES;

	$cpt = count ( $_FILES ['userfile'] ['name'] );
	$success = FALSE;
    	for($i = 0; $i < $cpt; $i ++) {

		$_FILES ['userfile'] ['name'] = $files ['userfile'] ['name'] [$i];
	        $_FILES ['userfile'] ['type'] = $files ['userfile'] ['type'] [$i];
        	$_FILES ['userfile'] ['tmp_name'] = $files ['userfile'] ['tmp_name'] [$i];
	        $_FILES ['userfile'] ['error'] = $files ['userfile'] ['error'] [$i];
        	$_FILES ['userfile'] ['size'] = $files ['userfile'] ['size'] [$i];

	        $this->upload->initialize( $this->set_upload_options() );
	        $this->upload->do_upload ('userfile');
		$success = TRUE;
    	}
        if ($success==TRUE)
        {
	    $this->session->set_flashdata('success', 'PDF Data Imported Succesfully');
	    redirect(site_url().'/PDF');
        }
        else
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('pdf/pdfindex', $error);
        }
    }

private function set_upload_options() {
    // upload an image options
    $config = array ();
    $config ['upload_path'] = './pdf/';
    $config ['allowed_types'] = 'pdf';

    return $config;
}
}
?>