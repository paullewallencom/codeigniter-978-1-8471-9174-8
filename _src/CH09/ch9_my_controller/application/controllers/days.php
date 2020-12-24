<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Days extends MY_Controller {
    function __construct() {
        parent::__construct();
    }

    function index() {
		$days = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
		echo random_element($days);        
    }
}
