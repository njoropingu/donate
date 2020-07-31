<?php

defined('BASEPATH') OR exit('no direct script access allowed');

class Frame extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('donor_model');
    }

    function index() {
        $reference_id = $this->session->flashdata('reference_id');
        $first_name = $this->session->flashdata('first_name');
        $last_name = $this->session->flashdata('last_name');
        $phone = $this->session->flashdata('phone');
        $amount = $this->session->flashdata('amount');
        $description = $this->session->flashdata('description');
        if ($reference_id != null && $first_name != null && $last_name != null && $phone != null && $amount != null) {
            $data = array(
                'reference_id' => $reference_id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'phone' => $phone,
                'amount' => $amount,
                'description' => $description
            );
            $this->load->view('pesapal-iframe', $data);
        } else {
            redirect(base_url('home'));
        }
    }

}
