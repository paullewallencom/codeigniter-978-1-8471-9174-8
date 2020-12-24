<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Bench_model extends CI_Model { 
    function __construct() { 
        parent::__construct(); 
    } 

    function get_people() { 
        $query = $this->db->get('bench_table'); 
        return $query; 
    } 

    function add_to_db($data) {
        if ($this->db->insert_batch('bench_table', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    } 
} 
