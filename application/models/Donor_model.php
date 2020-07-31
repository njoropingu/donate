<?php defined('BASEPATH') OR exit('no direct script access allowed');

class Donor_model extends CI_Model{
    
    function donors($data){
        $this->db->insert('donors', $data);
        return $this->db->insert_id();
    }
    function getDonors($pesapal_merchant_reference){
      return  $this->db->get_where('donors', array('id'=>$pesapal_merchant_reference))->result();
    }
    function parameters($arr){
      return  $this->db->insert('param',$arr);
    }
    function getParameters(){
        return $this->db->get('param')->row();
    }
    function track($data){
        $this->db->insert('pesapal_track',$data);
    }
}

