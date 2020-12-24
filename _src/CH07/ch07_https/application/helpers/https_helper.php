<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function toggle_ssl($action) {
	$CI =& get_instance();
	
	if ( $action == "on") {
		$CI->config->config['base_url'] = str_replace('http://', 'https://', $CI->config->config['base_url']);

		if ($_SERVER['SERVER_PORT'] != 443) {
			redirect($CI->uri->uri_string());
		}
	} elseif ( $action == "off") {
		$CI->config->config['base_url'] = str_replace('https://', 'http://', $CI->config->config['base_url']);

		if ($_SERVER['SERVER_PORT'] != 80) {
			redirect($CI->uri->uri_string());
		}
	} else { // if neither turn https support off
		$CI->config->config['base_url'] = str_replace('https://', 'http://', $CI->config->config['base_url']);

		if ($_SERVER['SERVER_PORT'] != 80) {
			redirect($CI->uri->uri_string());
		}
	}
}
