<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blogs extends CI_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index() {
		echo 'Controller: ' . __CLASS__ . ', Method: ' . __FUNCTION__;
	}

	public function mapped() {
		echo 'Controller: ' . __CLASS__ . ', Method: ' . __FUNCTION__;
	}
}
?>