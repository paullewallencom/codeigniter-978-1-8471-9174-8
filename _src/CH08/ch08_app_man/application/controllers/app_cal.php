<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_cal extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('date');
        $this->load->helper('form');
        $this->load->model('App_cal_model');
    }

    public function index() {
        redirect('app_cal/show');
    }


    public function show() {
        if ($this->uri->segment(4)) {
            $year= $this->uri->segment(3);
            $month = $this->uri->segment(4);
        } else {
            $year = date("Y", time());
            $month = date("m", time());
        }

        $tpl = '
           {table_open}<table border="1" cellpadding="15" cellspacing="1">{/table_open}

           {heading_row_start}<tr>{/heading_row_start}

           {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
           {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
           {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

           {heading_row_end}</tr>{/heading_row_end}

           {week_row_start}<tr>{/week_row_start}
           {week_day_cell}<td>{week_day}</td>{/week_day_cell}
           {week_row_end}</tr>{/week_row_end}

           {cal_row_start}<tr>{/cal_row_start}
           {cal_cell_start}<td>{/cal_cell_start}

           {cal_cell_content}'.anchor('app_cal/create/'.$year.'/'.$month.'/{day}', '+').' <a href="{content}">{day}</a>{/cal_cell_content}
           {cal_cell_content_today}<div class="highlight">'.anchor('app_cal/create/'.$year.'/'.$month.'/{day}', '+').'<a href="{content}">{day}</a></div>{/cal_cell_content_today}

           {cal_cell_no_content}'.anchor('app_cal/create/'.$year.'/'.$month.'/{day}', '+').' {day}{/cal_cell_no_content}
           {cal_cell_no_content_today}<div class="highlight">'.anchor('app_cal/create/'.$year.'/'.$month.'/{day}', '+').'{day}</div>{/cal_cell_no_content_today}

           {cal_cell_blank}&nbsp;{/cal_cell_blank}

           {cal_cell_end}</td>{/cal_cell_end}
           {cal_row_end}</tr>{/cal_row_end}

           {table_close}</table>{/table_close}' ;

        $prefs = array (
            'start_day'         => 'monday',
            'month_type'        => 'long',
            'day_type'          => 'short',
            'show_next_prev'    => TRUE,
            'next_prev_url'     => 'http://url/app_cal/show/',
            'template'          => $tpl         
         );

        $this->load->library('calendar', $prefs);

        $appointments = $this->App_cal_model->get_appointments($year, $month);
        $data = array();

        foreach ($appointments->result() as $row) {
            $data[(int)date("d",$row->app_date)] = $row->app_url;
        }

        $data['cal_data'] = $this->calendar->generate($year, $month, $data);

        $this->load->view('app_cal/view', $data);
    }        


    public function create() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br />');

        $this->form_validation->set_rules('app_name',  'Appointment Name', 'required|min_length[1]|max_length[255]|trim');
        $this->form_validation->set_rules('app_description',  'Appointment Description', 'min_length[1]|max_length[255]|trim');
        $this->form_validation->set_rules('day',  'Appointment Start Day', 'required|min_length[1]|max_length[11]|trim');
        $this->form_validation->set_rules('month',  'Appointment Start Month', 'required|min_length[1]|max_length[11]|trim');
        $this->form_validation->set_rules('year',  'Appointment Start Year', 'required|min_length[1]|max_length[11]|trim');

        if ($this->uri->segment(3)) {
            $year   = $this->uri->segment(3);
            $month  = $this->uri->segment(4);
            $day    = $this->uri->segment(5);
        } elseif ($this->input->post()) {
            $year   = $this->input->post('year');
            $month  = $this->input->post('month');
            $day    = $this->input->post('day');
        } else {
            $year   = date("Y", time());
            $month  = date("m", time());
            $day    = date("j", time());
        }

        if ($this->form_validation->run() == FALSE) { // First load, or problem with form
            $data['app_name']           = array('name' => 'app_name', 'id' => 'app_name', 'value' => set_value('app_name', ''), 'maxlength'   => '100', 'size' => '35');
            $data['app_description']    = array('name' => 'app_description', 'id' => 'app_description', 'value' => set_value('app_description', ''), 'maxlength' => '100', 'size' => '35');
            
            $days_in_this_month = days_in_month($month,$year);

            $days_i = array();
            for ($i=1;$i<=$days_in_this_month;$i++) {
                ($i<10 ? $days_i['0'.$i] = '0'.$i : $days_i[$i] = $i) ;
            }

            $data['days']   = $days_i;
            $data['months'] = array('01' => 'January','02' => 'February','03' => 'March','04' => 'April','05' => 'May','06' => 'June','07' => 'July','08' => 'August','09' => 'September','10' => 'October','11' => 'November','12' => 'December');
            $data['years']  = array('2013' => '2013');
            $data['day']    = $day;
            $data['month']  = $month;
            $data['year']   = $year;

            $this->load->view('app_cal/new', $data);
        } else {
            $app_date = mktime(0,0,0,$month,$day,$year);

            $data = array(
                'app_name'          => $this->input->post('app_name'),
                'app_description'   => $this->input->post('app_description'),
                'app_date'          => $app_date,
                'app_url'           => base_url('index.php/app_cal/appointment/'.$year.'/'.$month.'/'.$day)
                );

            if ($this->App_cal_model->create($data)) {
                redirect('app_cal/show/'.$year.'/'.$month);
            } else {
                redirect('app_cal/index');
            }  
        }      
    }



        public function delete() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br />');

        if ($this->input->post('app_id')) {
            $id = $this->input->post('app_id');
        } else {
            $id = $this->uri->segment(3);
        }        

        $this->form_validation->set_rules('app_id',  'Appointment ID', 'min_length[1]|max_length[11]|is_natural|trim');
        
        if ($this->form_validation->run() == FALSE) { // First load, or problem with form
            $appointment = $this->App_cal_model->get_single($id);
            $data['id'] = $id;

            foreach ($appointment->result() as $row) {
                $data['app_name'] = $row->app_name;
                $data['app_date'] = $row->app_date;
            }

            $this->load->view('app_cal/delete', $data);
        } else {
            if ($this->App_cal_model->delete($id)) {
                redirect('app_cal/index');
            } else {
                redirect('app_cal/index');
            }
        }
    }    

    public function appointment() {
        if ($this->uri->segment(3)) {
            $year   = $this->uri->segment(3);
            $month  = $this->uri->segment(4);
            $day    = $this->uri->segment(5);

            $data['appointments'] = $this->App_cal_model->get_appointment($year, $month, $day);
            $this->load->view('app_cal/appointment', $data);
        } else {

        }
    }
}

