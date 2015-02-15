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
        $this->load->view('toplist', array("is_login" => $this->session->userdata('login_status')));
    }

    private function get_toplist_data() {
        $user = $this->session->userdata('user');
        $this->load->model('Word');
        $this->load->model('Result');

        $monthly_toplist = $this->Result->get_top_results("month", 10);
        $daily_toplist = $this->Result->get_top_results("day", 10);
        $friend_score_list = $this->Result->get_toplist_by_friends($user['id']);
        return array('monthly_toplist' => $monthly_toplist, 'daily_toplist' => $daily_toplist, 'friend_score_list' => $friend_score_list);
    }

    public function get_toplist_data_json() {
        $user = $this->session->userdata('user');
        echo json_encode(array("toplist_data" => $this->get_toplist_data(), "current_user" => $user["id"]));
    }

}
