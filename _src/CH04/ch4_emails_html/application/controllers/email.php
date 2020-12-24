<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('email');
	}

	public function index() {
		redirect('email/send_email');
	}

	function send_email() {
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';

		$this->email->initialize($config);		

		$this->email->from('from@domain.com', 'From name');
		$this->email->to('to@domain.com'); 

		$this->email->subject('This is a html email');
		$html = 'This is an <b>HTML</b> email';
		$this->email->message($html);	

		$this->email->send();

		echo $this->email->print_debugger();
	}
}	