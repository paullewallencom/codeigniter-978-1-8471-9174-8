<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Table extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('table');
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

		$this->table->set_heading(array('ID', 'First Name', 'Last Name'));

		$this->table->add_row(array('1', 'Rob', 'Foster'));
		$this->table->add_row(array('2', 'Lucy', 'Welsh'));
		$this->table->add_row(array('3', 'George', 'Foster'));
		$this->table->add_row(array('4', 'Jackie', 'Foster'));
		$this->table->add_row(array('5', 'Antony', 'Welsh'));
		$this->table->add_row(array('6', 'Rowena', 'Welsh'));
		$this->table->add_row(array('7', 'Peter', 'Foster'));
		$this->table->add_row(array('8', 'Jenny', 'Foster'));
		$this->table->add_row(array('9', 'Oliver', 'Welsh'));
		$this->table->add_row(array('10', 'Felicity', 'Foster'));
		$this->table->add_row(array('11', 'Harrison', 'Foster'));
		$this->table->add_row(array('12', 'Mia', 'The Cat'));

		$data['table'] = $this->table->generate();

		$this->load->view('tables/table_header');
		$this->load->view('tables/table_body',$data);
		$this->load->view('tables/table_footer');
	}

}
