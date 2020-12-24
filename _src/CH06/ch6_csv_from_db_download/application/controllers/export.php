<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Export extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->helper('download');
    $this->load->dbutil();    
    $this->load->helper('url');
  }

  public function index() {
    redirect('export/csv');
  }

  public function csv() {
    $query = $this->db->query("SELECT * FROM users");
    $delimiter = ",";
    $newline = "\r\n";    

    force_download('myfile.csv', $this->dbutil->csv_from_result($query, $delimiter, $newline));
  }
}