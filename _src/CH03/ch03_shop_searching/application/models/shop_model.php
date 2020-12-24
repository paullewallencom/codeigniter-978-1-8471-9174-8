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

    public function get_all_products($category_id = null) {
        if ($category_id) {
            $this->db->where('category_id', $category_id);
        }
        $query = $this->db->get('products'); 
        return $query; 
    } 

    public function get_all_categories() {
        $query = $this->db->get('categories');
        return $query;
    }


} 
