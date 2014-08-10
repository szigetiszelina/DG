<?php
class MY_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function is_post(){
        return $_SERVER['REQUEST_METHOD'] == 'POST' ? TRUE : FALSE;
    }
    
    public function check_login(){
        return $this->session->userdata('login_status');      
    }
    
}