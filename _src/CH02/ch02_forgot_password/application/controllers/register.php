<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Register extends CI_Controller { 
    function __construct() { 
        parent::__construct(); 
        $this->load->helper('form'); 
        $this->load->helper('url'); 
        $this->load->helper('security'); 
        $this->load->model('Register_model'); 
        $this->load->library('encrypt');        
    } 

    public function index() { 
        redirect('register/register_user'); 
    } 

    public function register_user() { 
        // Load support assets 
        $this->load->library('form_validation'); 
        $this->form_validation->set_error_delimiters('', '<br />'); 

        // Set validation rules 
        $this->form_validation->set_rules('first_name', 'First Name', 'required|min_length[1]|max_length[125]'); 
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|min_length[1]|max_length[125]'); 
        $this->form_validation->set_rules('email', 'Email', 'required|min_length[1]|max_length[255]|valid_email'); 
        $this->form_validation->set_rules('password1', 'Password', 'required|min_length[5]|max_length[15]'); 
        $this->form_validation->set_rules('password2', 'Confirmation Password', 'required|min_length[5]|max_length[15]|matches[password1]'); 

        // Begin validation 
        if ($this->form_validation->run() == FALSE) { // First load, or problem with form 
            $data['page_title'] = "Register"; 
            $this->load->view('register/register',$data); 
        } else { 
            // Create hash from user password 
            $hash = $this->encrypt->sha1($this->input->post('password1')); 
             
            $data = array( 
                'user_first_name' => $this->input->post('first_name'), 
                'user_last_name' => $this->input->post('last_name'), 
                'user_email' => $this->input->post('email'), 
                'user_hash' => $hash 
            ); 

            if ($this->Register_model->register_user($data)) {
                redirect('signin');
            } else {
                redirect('register');
            }
        } 
    } 
} 
