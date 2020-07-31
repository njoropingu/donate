<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->model('donor_model');
    }

    public function index() {
        $this->load->view('header');
        $this->load->view('home');
        $this->load->view('footer');
    }

    function thankyou() {
        $this->load->view('header');
        $this->load->view('thank-you');
        $this->load->view('footer');
    }

    function error() {
        $this->load->view('header');
        $this->load->view('thank-you');
        $this->load->view('footer');
    }
}
