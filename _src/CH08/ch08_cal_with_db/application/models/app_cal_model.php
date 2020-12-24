<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_cal_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_appointments($year, $month) {
        $month_as_written = array(
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December'
        );

        $start_date = '01' . ' ' . $month_as_written[$month] . ' ' . $year;
        $start_of_month = strtotime($start_date);

        $end_date = days_in_month($month, $year) . ' ' . $month_as_written[$month] . ' ' . $year;
        $end_of_month = strtotime($end_date);

        $this->db->where('app_date > ', $start_of_month);
        $this->db->where('app_date < ', $end_of_month);
        $query = $this->db->get('appointments');
        
        return $query;
    }
}
