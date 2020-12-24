<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop extends CI_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index() {
		echo 'Controller: ' . __CLASS__ . ', Method: ' . __FUNCTION__;
	}

	public function product() {
		echo 'Controller: ' . __CLASS__ . ', Method: ' . __FUNCTION__;
		echo '<br />';
		echo 'Product ID: ' . $this->uri->segment(2);
	}

	public function all() {
		echo 'Controller: ' . __CLASS__ . ', Method: ' . __FUNCTION__;
		echo '<br />';
		echo 'Product ID: ' . $this->uri->segment(2);
	}	
}
?>