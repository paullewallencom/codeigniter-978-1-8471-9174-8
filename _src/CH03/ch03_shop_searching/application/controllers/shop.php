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
        $this->load->library('form_validation'); 
        $this->form_validation->set_error_delimiters('', '<br />'); 

        if ($this->input->post()) { 
            $category_id = $this->input->post('cat'); 
        } else { 
            $category_id = null; 
        } 

        $this->form_validation->set_rules('cat', 'Category', 'required|min_length[1]|max_length[125]|integer'); 
     
        if ($this->form_validation->run() == FALSE) { 
            $data['query'] = $this->Shop_model->get_all_products($category_id);
            $data['cat_query'] = $this->Shop_model->get_all_categories();
            $this->load->view('shop/display_products', $data); 
        } else { 
            $data['query'] = $this->Shop_model->get_all_products($category_id); 
            $data['cat_query'] = $this->Shop_model->get_all_categories();             
            $this->load->view('shop/display_products', $data); 
        } 
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
        $data['cat_query'] = $this->Shop_model->get_all_categories();

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
        $data['cat_query'] = $this->Shop_model->get_all_categories();        
        $this->load->view('shop/display_cart', $data);
    }


    public function clear_cart() { 
        $this->cart->destroy(); 
        redirect('index');
    } 
} 
