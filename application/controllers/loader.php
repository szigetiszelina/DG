<?php

class Loader extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function load_question(){
        if((int)$_POST["index"] >= 0){
            $next = (int) $_POST["index"] + 1;
            $questions = $this->session->userdata('questions');
            $data['question'] = $questions[$next];
            $this->load->view('quiz', $data);
        }
    }
}