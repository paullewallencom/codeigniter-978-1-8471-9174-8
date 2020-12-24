<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Config_settings extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->config->load('my_config_file');
  }

  public function index() {
    echo $this->config->item('first_config_item');

    for($i = 0; $i < $this->config->item('stop_at'); $i++) {
      echo $i . '<br />';
    }
  }
}
