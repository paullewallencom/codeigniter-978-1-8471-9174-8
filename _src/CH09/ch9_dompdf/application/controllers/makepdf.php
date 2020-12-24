<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Makepdf extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->load->helper('dompdf'); 
        $this->load->model('Makepdf_model');
    }

    function index() {
        $data['query'] = $this->Makepdf_model->get_all_users();
        $filename = 'List-of-users';
        $html = $this->load->view('makepdf/view_all_users', $data, true);
        pdf_create($html, $filename);
    }
}
