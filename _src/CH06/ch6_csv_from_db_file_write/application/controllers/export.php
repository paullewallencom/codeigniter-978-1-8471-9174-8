<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Export extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('file');
    $this->load->dbutil();    
  }

  public function index() {
    redirect('export/csv');
  }

  public function csv() {
    $query = $this->db->query("SELECT * FROM users");

    $delimiter = ",";
    $newline = "\r\n";

    $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
    $path = '/path/to/write/to/myfile.csv';

    if ( ! write_file($path, $data)) {
         echo 'Cannot write file - permissions maybe?';
    } else {
         echo 'File write OK';
    }
  }
}