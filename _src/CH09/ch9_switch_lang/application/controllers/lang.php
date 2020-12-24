<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Lang extends CI_Controller { 
    function __construct() { 
        parent::__construct(); 
        $this->load->helper('form'); 
        $this->load->helper('url'); 
        $this->load->helper('language'); 
        $this->load->helper('security'); 
        
        // Check for empty language values in the session 
        if ($this->session->userdata('filename') == '' || $this->session->userdata('language') == '') { 
            $change_lang = array( 
               'language'   => 'english', 
               'filename'   => 'en', 
            ); 

            $this->session->set_userdata($change_lang); 
            $this->lang->load($this->session->userdata('filename'), $this->session->userdata('language')); 
        } else { // Default language 
            $this->lang->load($this->session->userdata('filename'), $this->session->userdata('language')); 
        } 
    } 

    public function index() { 
        redirect('lang/submit');
    } 

    public function submit() { 
        $this->load->library('form_validation'); 
        $this->form_validation->set_error_delimiters('', '<br />'); 

        // Set validation rules 
        $this->form_validation->set_rules('email', $this->lang->line('form_email'), 'required|min_length[1]|max_length[50]|valid_email'); 

        // Begin validation 
        if ($this->form_validation->run() == FALSE) { 
            $this->load->view('lang/lang'); 
        } 
    } 

    public function change_language() { 
        $lang = xss_clean($this->uri->segment(3)); 

        switch ($lang) { 
                case "en": 
                        $language = 'english'; 
                        $filename = 'en'; 

                        break; 
                case "fr": 
                        $language = 'french'; 
                        $filename = 'fr'; 
                        break; 
                default: 
                    break; 
        } 

        $change_lang = array( 
           'language'   => $language, 
           'filename'   => $filename, 
        ); 

        $this->session->set_userdata($change_lang); 

        redirect('lang/index'); 
    } 
} 
