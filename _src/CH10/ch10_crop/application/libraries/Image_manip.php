<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Image_manip {
	function do_watermark($data) {
		$CI =& get_instance();
		$CI->load->library('image_lib', $data);

		$CI->image_lib->initialize($data); 
		if ($CI->image_lib->watermark()) {
			return true;
		} else {
			echo $CI->image_lib->display_errors();
		}
	}

	function resize_image($data) {
		$CI =& get_instance();
		$CI->load->library('image_lib', $data);
		if ($CI->image_lib->resize()) {
			return true;
		} else {
			echo $CI->image_lib->display_errors();
		}
	}

	function crop_image($data) {		
		$CI =& get_instance();
		$CI->load->library('image_lib', $data);

		$CI->image_lib->initialize($data); 

		if ($CI->image_lib->crop()) {
		  return true; 
		} else {
			echo $CI->image_lib->display_errors();
		}
	}

	function rotate($data) {
		$CI =& get_instance();
		$CI->load->library('image_lib', $data);

		$CI->image_lib->initialize($data); 

		if ($CI->image_lib->rotate()) {
			return true;
		} else {
		    echo $CI->image_lib->display_errors();
		}		
	}

	function change_mode($data) {
		if (chmod($file, $mode)) {
			return true;
		} else {
			return false;
		}
	}
}
?>