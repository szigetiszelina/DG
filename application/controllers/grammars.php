<?php

class Grammars extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login_status')) {
            $this->session->set_userdata('prev_page', $this->uri->uri_string());
            $this->session->set_userdata('redirect', true);
            redirect("index");
        }
    }

    public function index() {
        $this->load->view('grammar_descriptions', array("is_login" => $this->session->userdata('login_status')));
    }

}
