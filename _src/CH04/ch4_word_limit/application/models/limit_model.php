<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Limit_model extends CI_Model { 
    function __construct() { 
        parent::__construct(); 
    } 

    function get_all() { 
        $query = $this->db->get('articles'); 
        return $query; 
    } 
} 
