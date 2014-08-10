<?php

class Games extends MY_Controller {
    
    private $game_types;
    
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('login_status')){
            //$this->session->set_userdata('before_page','')
            redirect("auth");
        }
        $this->set_game_types();
    }

    public function index(){
        
    }
    
    public function evelove(){
        $data['active_button'] = "letter5";
        $data['is_login'] = $this->session->userdata('login_status');
        $this->load->view('header',$data);
        $this->load->model('Grammar');
        $data['game_types'] = $this->game_types;
        $data['grammars'] = $this->Grammar->get_grammars();
        $this->load->view('games',$data);
        $this->load->view('footer');
    }
    
    public function exercise(){
        var_dump(" Te most gyakorolsz");
    }
    
    protected function set_game_types(){
        $this->load->model('Game');
        $this->game_types = $this->Game->get_games();
    }
}