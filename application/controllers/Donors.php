<?php defined('BASEPATH') OR exit('no direct script access allowed');

class Donors extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('donor_model');
    }
//capturing/inserting donators details in database
    function index() {
        $this->form_validation->set_rules("first_name", "First Name", "required");
        $this->form_validation->set_rules("last_name", "Last Name", "required");
        $this->form_validation->set_rules("phone", "Phone Number", "required");
        $this->form_validation->set_rules("amount", "Amount", "required");
        if ($this->form_validation->run()) {
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $phone = $this->input->post('phone');
            $amount = $this->input->post('amount');
            $description = $this->input->post('description');
            $data = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'phone' => $phone,
                'amount' => $amount,
                'description'=>$description
            );
            $reference_id = $this->donor_model->donors($data);
            
            if ($reference_id != null) {
                $this->session->set_flashdata('reference_id', $reference_id);
                $this->session->set_flashdata('first_name', $first_name);
                $this->session->set_flashdata('last_name', $last_name);
                $this->session->set_flashdata('phone', $phone);
                $this->session->set_flashdata('amount', $amount);
                $this->session->set_flashdata('description', $description);
                redirect(base_url('frame'));
            } else {
                log_message('debug', 'No reference id : ' . $reference_id);
                echo 'Sorry, above transaction wasnt succesful!';
            }
        } else {
            echo 'Sorry, above transaction wasnt succesful!';
        }
    }
    

}
