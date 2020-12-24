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

        $sd = '01' . ' ' . $month_as_written[$month] . ' ' . $year;
        $start_of_month = strtotime($sd);

        $ed = days_in_month($month, $year) . ' ' . $month_as_written[$month] . ' ' . $year;
        $end_of_month = strtotime($ed);

        $this->db->where('app_date > ', $start_of_month);
        $this->db->where('app_date < ', $end_of_month);
        $query = $this->db->get('appointments');
        $this->db->last_query();
        
        return $query;
    }

    function get_appointment($year, $month, $day) {
        $start_of_day = mktime(0,0,0,$month,$day,$year);
        $end_of_day = $start_of_day + 86400;
        $this->db->where('app_date >= ', $start_of_day);
        $this->db->where('app_date <= ', $end_of_day);
        $query = $this->db->get('appointments');
        
        return $query;
    }

    function create($data) {
        if ($this->db->insert('appointments', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id) {
        $this->db->where('app_id', $id);
        if ($this->db->delete('appointments')) {
            return true;
        } else {
            return false;
        }
    }

    function get_single($id) {
        $this->db->where('app_id', $id);
        $query = $this->db->get('appointments');
        return $query;
    }
}
