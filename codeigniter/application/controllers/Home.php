<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
 
 
    /**
     * Cotoh penggunaan bootstrap pada codeigniter::index()
     */
    public function view($page = 'vhome')
    {
        if ( ! file_exists(APPPATH.'/views/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        //$data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('header');
        $this->load->view($page);
        $this->load->view('footer');
    }
}