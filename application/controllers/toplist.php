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
        $this->load->model('Result');
        $user = $this->session->userdata('user');
       // $words_score_toplist = $this->Word->get_bests_by_words_score(); átgondolni
        $monthly_toplist = $this->Result->get_top_results("month",10);
        $daily_toplist = $this->Result->get_top_results("day",10);
        
        $friend_score_list = $this->Result->get_toplist_by_friends(3);        
        $this->load->view('toplist', 
                array("is_login" => $this->session->userdata('login_status'), 
                "friend_score_list" => $friend_score_list, 
               // "words_score_toplist" => $words_score_toplist,
                "monthly_toplist" => $monthly_toplist,
                "daily_toplist" => $daily_toplist));
    }

}
