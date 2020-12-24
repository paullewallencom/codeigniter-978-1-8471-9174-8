<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('make_captcha');
		$this->load->model('Captcha_model');
	}

	public function index() {	
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br />');

        $this->form_validation->set_rules('name', 'Name', 'required|max_length[225]');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[225]');
        $this->form_validation->set_rules('message', 'Message', 'required|max_length[225]');
        $this->form_validation->set_rules('captcha', 'Captcha', 'required|max_length[225]');

        // Begin validation
        if ($this->form_validation->run() == FALSE) { 
			$data['img'] = make_captcha();
			$this->load->view('comments/post_form', $data);
        } else {
			$expiration = time() - 7200;

			$this->Captcha_model->delete_expired($expiration);

			$data = array(
				'captcha' => $this->input->post('captcha'), 
				'ip_address' => $this->input->ip_address(), 
				'expiration' => $expiration);

			$num_rows = $this->Captcha_model->does_exist($data);

			if ($num_rows == 0) {
			    $data['errors'] = "Type the word in the image.";
				$data['img'] = make_captcha();
				$this->load->view('comments/post_form', $data);		    
			} else {
				echo 'CAPTCHA OKAY - HERE IS YOUR POST:' . '<br />';
				echo $this->input->post('name') . '<br />';
				echo $this->input->post('email') . '<br />';
				echo $this->input->post('message') . '<br />';
			}
        }		

	}
}