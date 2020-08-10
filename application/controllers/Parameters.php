<?php

defined('BASEPATH') OR exit('no direct script access allowed');

class Parameters extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('donor_model');
    }

    function index() {

        $data = array(
            'conkey' => $this->input->post('conkey'),
            'secret' => $this->input->post('secret'));

        $this->donor_model->insertParam($data);
        
    }

}
