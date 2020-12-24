<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Signin extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->helper('security');
    $this->load->database();
  }

  public function index() {
    redirect('signin/login');
  }

    public function login() {
    if ($this->session->userdata('logged_in') == TRUE) {
      redirect('signin/loggedin');
    } else {
      $this->load->library('form_validation');

      // Set validation rules for view filters
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email|min_length[5]|max_length[125]');
      $this->form_validation->set_rules('password', 'Password ', 'required|min_length[5]|max_length[30]');

      if ($this->form_validation->run() == FALSE) {
        $this->load->view('signin/signin');
      } else {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->load->model('Signin_model');      
        $query = $this->Signin_model->does_user_exist($email);

        if ($query->num_rows() == 1) { // One matching row found
          foreach ($query->result() as $row) {
            // Call Encrypt library
            $this->load->library('encrypt');

            // Generate hash from a their password
            $hash = $this->encrypt->sha1($password);

            // Compare the generated hash with that in the database
            if ($hash != $row->user_hash) {
              // Didn't match so send back to login
              $data['login_fail'] = true;
              $this->load->view('signin/signin', $data);
            } else {
              $data = array(
                  'user_id' => $row->user_id,
                  'user_email' => $row->user_email,
                  'logged_in' => TRUE
              );

              // Save data to session
              $this->session->set_userdata($data);
              redirect('signin/loggedin');
            }
          }
        } 
      }
    }
  }

  function loggedin() {
    if ($this->session->userdata('logged_in') == TRUE) {
      $this->load->view('signin/loggedin');
    } else {
      redirect('signin');
    }       
  }

 public function forgot_password() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|min_length[5]|max_length[125]');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('signin/forgot_password');
    } else {
      $email = $this->input->post('email');

      $this->db->where('user_email', $email);
      $this->db->from('register');
      $num_res = $this->db->count_all_results();
      
      if ($num_res == 1) {
        // Make a small string (code) to assign to the user to
        // indicate they've requested a change of password
        $code = mt_rand('5000', '200000');
        $data = array(
          'forgot_password' => $code,
        );        

        $this->db->where('user_email', $email);  
        if ($this->db->update('register', $data)) { // Update okay, send email
          $url = "http://www.domain.com/signin/new_password/".$code;
          $body = "\nPlease click the following link to reset your password:\n\n".$url."\n\n";
          if (mail($email, 'Password reset', $body, 'From: no-reply@domain.com')) {
            $data['submit_success'] = true;
            $this->load->view('signin/signin', $data);
          }
        } else {
          // Some sort of error happened, redirect user back to form
          redirect('singin/forgot_password');
        }
      } else { // Some sort of error happened, redirect user back to form
        redirect('singin/forgot_password');
      } 
    }   
  }
  
  public function new_password() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('code', 'Code', 'required|min_length[4]|max_length[7]');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|min_length[5]|max_length[125]');
    $this->form_validation->set_rules('password1', 'Password', 'required|min_length[5]|max_length[15]');
    $this->form_validation->set_rules('password2', 'Confirmation Password', 'required|min_length[5]|max_length[15]|matches[password1]');
    
    // Get Code from URL or POST and clean up      
    if ($this->input->post()) {
      $data['code'] = xss_clean($this->input->post('code'));
    } else { 
      $data['code'] = xss_clean($this->uri->segment(3));
    }

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('signin/new_password', $data);      
    } else {
      // Does code from input match the code against the email
      $this->load->model('Signin_model');
      $email = xss_clean($this->input->post('email'));
      if (!$this->Signin_model->does_code_match($data['code'], $email)) { // Code doesn't match
        redirect ('signin/forgot_password');
      } else {  // Code does match
        $this->load->model('Register_model');
        $hash = $this->encrypt->sha1($this->input->post('password1'));

        $data = array(
          'user_hash' => $hash
        );

        if ($this->Register_model->update_user($data, $email)) {
          redirect ('signin');
        }
      }
    }    
  }

}
