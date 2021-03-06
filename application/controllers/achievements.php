<?php

class Achievements extends MY_Controller {
    private $user;
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login_status')) {
            $this->session->set_userdata('prev_page', $this->uri->uri_string());
            $this->session->set_userdata('redirect', true);
            redirect("index");
        }
        else{
            $this->user = $this->session->userdata('user');
        }
    }

    public function index() {
        $data['is_login'] = $this->session->userdata('login_status');
        $this->load->view('header', $data);
        $this->load->model('result');
        $data['achievements'] = $this->result->get_achievements_by_user($this->user['id']);
        //$data['achievements'] = $this->result->get_play_count($this->user['id']);
        $data['achievements'] = $this->result->get_score_by_grammar($this->user['id']);

        $this->load->view('achievements', $data);
        $this->load->view('footer');
    }

    public function get_grammars_level() {
        $this->load->model('result');
        $results = $this->result->get_score_by_grammar($this->user['id']);
        $this->load->model('grammar');
        for ($i = 0; $i < count($results); $i++) {
            $results[$i]['grammar'] = $this->grammar->get_name_by_id($results[$i]['grammar_id']);
        }
        echo json_encode($results);
    }
    
    public function get_this_month_result() {
        $this->load->model('result');
        $results = $this->result->get_this_month_result_by_game_and_grammar($this->user['id']);
        echo json_encode($results);
    }
    
    public function get_monthly_result($year = null){
        if(!empty($_GET) && ($_GET['year']!=null)){
            $year = (int) $_GET['year'];
        }
        $this->load->model('result');
        $results = $this->result->get_monthly_result($this->user['id'], $year);
        echo json_encode($results);
    }
    
    public function get_daily_result($year = null, $month = null){
        if(!empty($_GET) && ($_GET['year']!=null || $_GET['month']!=null)){
            $year = (int) $_GET['year'];
            $month = (int) $_GET['month'];
        }
        $this->load->model('result');
        $results = $this->result->get_daily_result($this->user['id'], $year, $month);
        echo json_encode($results);
    }

}
