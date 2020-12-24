<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clear_sessions {
	function clear_now() {
		$CI =& get_instance();
		$query = $CI->db->query("DELETE FROM `ci_sessions` WHERE `user_data` = '' ");
	}
}
