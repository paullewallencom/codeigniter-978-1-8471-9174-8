<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Export extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('file');
    $this->load->library('ftp');    
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
    $filename = 'myfile.csv';
    $path = './'.$filename;	

    if ( ! write_file($path, $data)) {
         echo 'Cannot write file - permissions maybe?';
         exit;
    }

    $config['hostname'] = 'your-hostname';
    $config['username'] = 'your-username';
    $config['password'] = 'your-password';
    $config['debug']  = TRUE;

    $this->ftp->connect($config);
    $this->ftp->upload($path, '/dir_on_ftp/'.$filename, 'ascii', 0755);
    $this->ftp->close();
  }
}
