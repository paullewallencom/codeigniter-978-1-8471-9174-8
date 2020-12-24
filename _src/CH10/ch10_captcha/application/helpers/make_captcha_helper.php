<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function make_captcha() {
	$CI =& get_instance();
	$CI->load->helper('captcha');

	$vals = array(
	    'img_path'	 => '/path/to/image/on/filesystem/',
	    'img_url'	 => 'http://url/to/image/',
	    'font_path'	 => './system/fonts/texb.ttf',
	    'img_width'	 => '150',
	    'img_height' => 30,
	    'expiration' => 7200
	    );

	$cap = create_captcha($vals);
	$data = array(
	    'captcha_time'	=> $cap['time'],
	    'ip_address'	=> $CI->input->ip_address(),
	    'word'	 		=> $cap['word']
	    );

	$query = $CI->db->insert_string('captcha', $data);
	$CI->db->query($query);

	return $cap['image'];	
}

