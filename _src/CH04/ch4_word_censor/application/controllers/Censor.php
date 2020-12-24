<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Censor extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('text');
		$this->load->model('Censor_model');
	}

	public function index() {
		redirect('censor/create');
	}

	public function create() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br />');
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[1]|max_length[225]|trim');
        $this->form_validation->set_rules('body', 'Body', 'required|min_length[1]|max_length[2000]|trim');

        if ($this->form_validation->run() == FALSE) { 
        	$this->load->view('censor/create');
        } else {
        	$query = $this->Censor_model->get_censored_words();
        	$censored_words = array();

        	foreach ($query->result() as $row) {
        		$censored_words[] = $row->word;
        	}

        	$data = array(
        		'name' => $this->input->post('name'),
        		'body' => word_censor($this->input->post('body'), $censored_words, 'BOOM')
        	);

        	if ($this->Censor_model->create($data)) {
        		echo 'Entered into DB:<br /><pre>';
        		var_dump($data);
        		echo '</pre>';
        	}
        }
	}
}	