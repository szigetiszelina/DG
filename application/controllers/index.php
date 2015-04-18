<?php

class Index extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $data['is_login'] = $this->session->userdata('login_status');
        if($data['is_login']){
            $user = $this->session->userdata('user');
            if($user['name'] != null && $user['name'] != ''){
                $data['name'] = $user['name'];
            }
        }
        if($this->session->userdata('redirect')){
            $data['prev_page'] = $this->session->userdata('prev_page');
            $data['warning_login'] = true;
            $this->session->set_userdata('redirect', false);
        }else{
            $data['prev_page'] = "";
            $data['warning_login'] = false;
        }
        $this->load->view('homepage',$data);
    }
}