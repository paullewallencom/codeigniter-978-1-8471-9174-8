<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bench extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('bench_model');
		$this->load->database();
	}

	public function index() {
		// Who's in the database?
		$this->benchmark->mark('bm1_start');
		foreach ($this->bench_model->get_people()->result() as $row) {
			echo $row->firstname . ' ' . $row->lastname . '<br />';
		}
		$this->benchmark->mark('bm1_end');

		// Write some more people to the database	
		$this->benchmark->mark('bm2_start');
		$data = array(
			array('firstname' => 'George',
				  'lastname' => 'Foster'),
			array('firstname' => 'Jackie',
				  'lastname' => 'Foster'),
			array('firstname' => 'Antony',
				  'lastname' => 'Welsh'),
			array('firstname' => 'Rowena',
				  'lastname' => 'Welsh'),
			array('firstname' => 'Peter',
				  'lastname' => 'Foster'),
			array('firstname' => 'Jenny',
				  'lastname' => 'Foster'),
			array('firstname' => 'Oliver',
				  'lastname' => 'Welsh'),
			array('firstname' => 'Harrison',
				  'lastname' => 'Foster'),
			array('firstname' => 'Felicity',
				  'lastname' => 'Foster')
			);

		$result = $this->bench_model->add_to_db($data);
		$this->benchmark->mark('bm2_end');

		if ($result) {
			// Who's in the database now?
			$this->benchmark->mark('bm3_start');
			foreach ($this->bench_model->get_people()->result() as $row) {
				echo $row->firstname . ' ' . $row->lastname . '<br />';
			}
			$this->benchmark->mark('bm3_end');
		} else {
			echo 'Cannot write to database.';
		}

		echo '<br /> ---- BENCHMARK POINT STATS ---- <br />';
		echo 'BM1 (S) to BM1 (E): ' . $this->benchmark->elapsed_time('bm1_start','bm1_end') . '<br />';
		echo 'BM2 (S) to BM2 (E): ' . $this->benchmark->elapsed_time('bm2_start','bm2_end') . '<br />';
		echo 'BM3 (S) to BM3 (E): ' . $this->benchmark->elapsed_time('bm3_start','bm3_end') . '<br />';
	}
}
?>