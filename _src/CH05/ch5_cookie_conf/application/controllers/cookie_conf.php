<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Cookie_conf extends CI_Controller { 
    function __construct() { 
        parent::__construct(); 
        $this->load->helper('url'); 
        $this->load->helper('cookie'); 
    } 

    public function index() { 
        // If the cookie doesn't exist, make it 
        if ( ! $this->input->cookie('cookie_conf')) { 
            $cookie = array( 
                'name'   => 'cookie_conf', 
                'value'  => 'cookie-conf-unconfirmed', 
                'expire' => 7200, 
                'domain' => '', 
                'path'   => '/', 
                'prefix' => '', 
                'secure' => FALSE 
            ); 

            $this->input->set_cookie($cookie); 
        } 

        if ( $this->input->cookie('cookie_conf')) { // If cookie exists 
            // Is the cookie unconfirmed? 
            if ($this->input->cookie('cookie_conf', FALSE) == 'cookie-conf-unconfirmed') { 
                $data['display_cookie_conf'] = TRUE; 
            } else { 
                $data['display_cookie_conf'] = FALSE; 
            } 
        } else { // If cookie doesn't exist yet 
            $data['display_cookie_conf'] = TRUE; 
        } 

        $this->load->view('cookie_conf/cookie_conf', $data); 
    } 

    public function agree() { 
        $cookie = array( 
            'name'   => 'cookie_conf', 
            'value'  => 'confirmed', 
            'expire' => 7200, 
            'domain' => '', 
            'path'   => '/', 
            'prefix' => '', 
            'secure' => FALSE 
        ); 
        
        // Set the cookie to confirmed 
        $this->input->set_cookie($cookie); 
        echo 'You agree to the cookie'; 
    } 

    public function disagree() { 
        echo 'You don\'t agree to the cookie'; 
    } 
} 
