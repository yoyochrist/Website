<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Portal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
 
 
    /**
     * Cotoh penggunaan bootstrap pada codeigniter::index()
     */
    public function index()
    {
        $this->load->view('index');
    }
}