<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function index()
    {
        $data = array(
            'title' => 'Admin',
            'isi'   => 'admin'
        );
        $this->load->view('layout/wrapper_backend', $data);
    }
}

/* End of file Controllername.php */
