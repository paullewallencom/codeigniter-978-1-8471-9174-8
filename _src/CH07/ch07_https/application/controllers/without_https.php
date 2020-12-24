<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Without_https extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('https_helper');

        toggle_ssl("off");
    }

    public function index() {
        $this->load->view('https/without_https');
    }
}

