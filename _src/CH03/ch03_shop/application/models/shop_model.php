<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Shop_model extends CI_Model { 

    function __construct() { 
        parent::__construct(); 
        $this->load->helper('url');      
    } 

    public function get_product_details($product_id) { 
        $this->db->where('product_id', $product_id); 
        $query = $this->db->get('products'); 
        return $query; 
    } 

    public function get_all_products() {
        $query = $this->db->get('products'); 
        return $query; 
    } 
} 
