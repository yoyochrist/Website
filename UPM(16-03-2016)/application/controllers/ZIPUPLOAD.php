<?php 
CLASS ZIPUPLOAD extends CI_Controller {
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $this->load->view('zip/zipindex', array('error' => ' ' ));
    }
    function file_upload()
    {
        $config['upload_path'] = './zip/';
        $config['allowed_types'] = 'zip';
        $config['max_size']    = '';
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('zip/zipindex', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $zip = new ZipArchive;
            $file = $data['upload_data']['full_path'];
            chmod($file,0777);
            if ($zip->open($file) === TRUE) {
                    $zip->extractTo('./document/');
                    $zip->close();
                    echo 'ok';
            } else {
                    echo 'failed';
            }
			$this->session->set_flashdata('success', 'ZIP Data Imported Succesfully');
            redirect(site_url().'/ZIPUPLOAD');
        }
    }
}
?>