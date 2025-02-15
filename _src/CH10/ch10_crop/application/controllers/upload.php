<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('image_manip');
	}

	function index() {
		$this->load->view('upload/upload', array('error' => ' ' ));
	}

	function do_upload() {
		$config['upload_path'] = '/path/to/upload/folder/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload()) {
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload/upload', $error);
		} else {
			$data = array('upload_data' => $this->upload->data());

			$result = $this->upload->data();
			$original_image = $result['full_path'];

			$data = array(
				'source_image' => $original_image,
				'image_library' => 'imagemagick',
				'library_path' => '/opt/ImageMagick/bin',
				'x_axis' => '100',
				'y_axis' => '60'	
			);

			if ($this->image_manip->crop_image($data)) {
				echo 'Image successfully cropped<br /><pre>';
				var_dump($result);
				echo '</pre>';
			} else {
				echo 'There was an error with the image processing.';
			}
		} 
	}  
}