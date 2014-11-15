<?php

class Toplist extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login_status')) {
            $this->session->set_userdata('prev_page', $this->uri->uri_string());
            $this->session->set_userdata('redirect', true);
            redirect("index");
        }
    }

    public function index() {
        $this->load->model('Word');
        $user = $this->session->userdata('user');
        var_dump($this->Word->get_bests_by_words_score($user['id']));
        $this->load->view('toplist', array("is_login" => $this->session->userdata('login_status')));
    }

}
