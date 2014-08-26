<?php

class Achievements extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login_status')) {
            //$this->session->set_userdata('before_page','')
            redirect("auth");
        }
    }

    public function index() {
        $data['active_button'] = "letter3";
        $data['is_login'] = $this->session->userdata('login_status');
        $this->load->view('header', $data);
        $this->load->model('result');
        $data['achievements'] = $this->result->get_achievements_by_user($this->session->userdata('user')['id']);
        //$data['achievements'] = $this->result->get_play_count($this->session->userdata('user')['id']);
        $data['achievements'] = $this->result->get_score_by_grammar($this->session->userdata('user')['id']);

        $this->load->view('achievements', $data);
        $this->load->view('footer');
    }

    public function get_grammars_level($month = null, $year = null) {
        $this->load->model('result');
        $results = $this->result->get_score_by_grammar($this->session->userdata('user')['id']);
        $this->load->model('grammar');
        for ($i = 0; $i < count($results); $i++) {
            $results[$i]['grammar'] = $this->grammar->get_name_by_id($results[$i]['grammar_id']);
        }
        echo json_encode($results);
    }

}