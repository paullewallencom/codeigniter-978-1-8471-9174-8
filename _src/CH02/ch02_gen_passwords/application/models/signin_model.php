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
}

