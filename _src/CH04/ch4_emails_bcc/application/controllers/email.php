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

	public function send_email() {
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;		

		$query = "SELECT * FROM bookers ";
		$result = $this->db->query($query);

		foreach ($result->result() as $row) {
			$this->email->clear();

			if ($row->email_pref == 'text') {
				$config['mailtype'] = 'text';
			    $body = 'Hi ' . $row->firstname . ', Thanks you booking with us, 
		    	please find attached the itinerary for your trip.
		    	This is your booking reference number: 
		    	' . $row->booking_ref . ' 
		    	Thanks for booking with us, have a lovely trip.';				
			} else {
				$config['mailtype'] = 'html';
			    $body = 'Hi ' . $row->firstname . ',<br /><br />Thanks you booking with us, 
		    	please find attached the itinerary for your trip.
		    	</p>This is your booking reference number: 
		    	<b>' . $row->booking_ref . '</b><br /><br />
		    	Thanks for booking with us, have a lovely trip.';
			}

			$this->email->initialize($config);
		    $this->email->to($row->email);
		    $this->email->from('bookings@thecodeigniterholidaycompany.com');
		    $this->email->subject('Holiday booking details');

		    $this->email->message($body);
		    $this->email->send();
		}

		echo $this->email->print_debugger();
	}
}	