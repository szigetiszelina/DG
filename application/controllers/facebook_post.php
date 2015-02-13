<?php

class Facebook_Post extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login_status')) {
            $this->session->set_userdata('prev_page', $this->uri->uri_string());
            $this->session->set_userdata('redirect', true);
            redirect("index");
        }
    }

    public function share_on_facebook() {
        if($_POST['message']!="" && $_POST['message']!=null){
            $this->load->helper('facebook');
            $user = $this->session->userdata('user');
            facebook(array('fb_id' => $user['fb_id'], 'access_token' => $this->session->userdata('token'), 'message' => $_POST['message'], 'link' => base_url(), 'picture' => base_url().'public/images/logo.png'));
        }
    }
}

