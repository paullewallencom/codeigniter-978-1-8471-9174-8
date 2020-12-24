<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Captcha_model extends CI_Model { 
    function __construct() { 
        parent::__construct(); 
    } 

    public function delete_expired($expiration) {
        $this->db->where('captcha_time < ',$expiration);
        $this->db->delete('captcha');
    }

    public function does_exist($data) {
        $this->db->where('word', $data['captcha']);
        $this->db->where('ip_address', $data['ip_address']);
        $this->db->where('captcha_time > ', $data['expiration']);        
        $query = $this->db->get('captcha');
        return $query->num_rows();
    }
} 
