<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signin_model extends CI_Model {
    function __construct() {
        parent::__construct();
    } 

    public function does_user_exist($email) {
        $this->db->where('user_email', $email);
        $query = $this->db->get('register');
        return $query;
    }

	public function update_user($data, $email) {
    	$this->db->where('user_email', $email);
        $this->db->update('register', $data);
    }  

    public function does_email_exist($email) {
      $this->db->where('user_email', $email);
      $this->db->from('register');
      $num_res = $this->db->count_all_results();
	  if ($num_res == 1) {
		return TRUE;
	  } else {
	  	return FALSE;
	  }      
    }

    public function does_code_match($code, $email) {
    	$this->db->where('user_email', $email);
    	$this->db->where('forgot_password', $code);
    	$this->db->from('register');
      	$num_res = $this->db->count_all_results(); 

      	if ($num_res == 1) {
      		return TRUE;
      	} else {
      		return FALSE;
      	}
    }  

}

