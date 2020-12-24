<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Shop extends CI_Controller {
    function __construct() { 
        parent::__construct(); 
        $this->load->library('cart'); 
        $this->load->helper('form'); 
        $this->load->helper('url'); 
        $this->load->helper('security'); 
        $this->load->model('Shop_model');        
    } 

    public function index() { 
        $data['query'] = $this->Shop_model->get_all_products(); 
        $this->load->view('shop/display_products', $data); 
    } 

    public function add() { 
        $product_id = $this->uri->segment(3);
        $query = $this->Shop_model->get_product_details($product_id); 
        foreach($query->result() as $row) { 
            $data = array( 
                'id'   => $row->product_id, 
                'qty' => 1, 
                'price'  => $row->product_price, 
                'name' => $row->product_name, 
             ); 
        } 

        $this->cart->insert($data); 
        $this->load->view('shop/display_cart', $data); 
    } 

    public function update_cart() { 
        $data = array(); 
        $i = 0;        

        foreach($this->input->post() as $item) { 
                $data[$i]['rowid']  = $item['rowid']; 
                $data[$i]['qty']    = $item['qty'];            
                $i++;  
        } 

        $this->cart->update($data); 
        redirect('shop/display_cart'); 
    } 

    public function display_cart() { 
        $this->load->view('shop/display_cart');
    } 

    public function clear_cart() { 
        $this->cart->destroy(); 
        redirect('index');
    } 
} 
