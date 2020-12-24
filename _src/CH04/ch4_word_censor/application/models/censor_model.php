<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Censor_model extends CI_Model { 
    function __construct() { 
        parent::__construct(); 
    } 

    function get_censored_words() { 
        $query = $this->db->get('censored_words'); 
        return $query; 
    } 

    function create($data) {
        if ($this->db->insert('censor', $data)) {
            return true;
        } else {
            return false;
        }
    } 
} 
