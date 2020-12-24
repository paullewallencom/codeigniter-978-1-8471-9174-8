<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Limit extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('text');
		$this->load->model('Limit_model');
	}

	public function index() {
		redirect('limit/view_all');
	}

	public function view_all() {
        $data['query'] = $this->Limit_model->get_all();
        $this->load->view('limit/view_all', $data);
    }
}	