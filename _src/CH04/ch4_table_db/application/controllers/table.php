<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Table extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('table');
		$this->load->database();
	}

	public function index() {
		$tmpl = array (
            'table_open'          => '<table border="0" cellpadding="4" cellspacing="0" id="example">',

            'heading_row_start'   => '<tr>',
            'heading_row_end'     => '</tr>',
            'heading_cell_start'  => '<th>',
            'heading_cell_end'    => '</th>',

            'row_start'           => '<tr>',
            'row_end'             => '</tr>',
            'cell_start'          => '<td>',
            'cell_end'            => '</td>',

            'row_alt_start'       => '<tr>',
            'row_alt_end'         => '</tr>',
            'cell_alt_start'      => '<td>',
            'cell_alt_end'        => '</td>',

            'table_close'         => '</table>'
        );

		$this->table->set_template($tmpl);

		$this->table->set_heading(array('ID', 'First Name', 'Last Name', 'Email'));		
		$query = $this->db->query("SELECT * FROM person");
		$data['table'] = $this->table->generate($query);
;
		$this->load->view('tables/table_header');
		$this->load->view('tables/table_body',$data);
		$this->load->view('tables/table_footer');
	}
}