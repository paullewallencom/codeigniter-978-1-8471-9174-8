<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('security');
        $this->load->model('Users_model');
	    $this->load->database();
    }
    
    public function index() {
        redirect('users/view_users');
    } 
    
    public function view_users() {        
        $data['query'] = $this->Users_model->get_all_users();
        $this->load->view('users/view_all_users', $data);
    }
}
