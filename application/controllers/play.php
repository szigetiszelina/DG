<?php

class Play extends MY_Controller {

    private $game_type;
    private $grammar_id;

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login_status')) {
            $this->session->set_userdata('prev_page', $this->uri->uri_string());
            $this->session->set_userdata('redirect', true);
            redirect("index");
        }
    }

    public function index() {
        if (!empty($_GET['game_type']) && !empty($_GET['grammar_id'])) {
            $this->game_type = $_GET['game_type'];
            $this->grammar_id = $_GET['grammar_id'];
            if (!empty($_GET['category']) && $_GET['category'] != "") {
                $this->session->set_userdata('category_id', $_GET['category']);
            } else {
                $this->session->set_userdata('category_id', null);
            }
            $this->load->library('Grammars/Grammar_factory', array($this->grammar_id, $this->game_type), 'grammar_factory');
            $grammar_obj = $this->grammar_factory->get_grammar();
            switch ($this->game_type) {
                case "memory":
                    $this->play_memory($grammar_obj);
                    break;
                case "quiz": $this->play_quiz($grammar_obj);
                    break;
                case "sort": $this->play_sort($grammar_obj);
                    break;
            }
        } else {
            redirect("index");
        }
    }

    protected function play_memory($grammar_obj) {
        $this->load->library('Game_types/' . ucfirst($this->game_type) . '/' . ucfirst($this->game_type), array($grammar_obj));
        $game_type = $this->game_type;
        $this->load->view('memory_game', array("words" => $this->$game_type->get_words(), "is_login" => $this->session->userdata('login_status'), "study_type" => $this->session->userdata('study_type')));
    }

    protected function play_quiz($grammar_obj) {
        $this->load->library('Game_types/' . ucfirst($this->game_type) . '/' . ucfirst($this->game_type), array($grammar_obj));
        $game_type = $this->game_type;
        $questions = $this->$game_type->get_questions();
        $this->load->view('quiz', array("questions" => $questions, "is_login" => $this->session->userdata('login_status'), "study_type" => $this->session->userdata('study_type')));
    }

    protected function play_sort($grammar_obj) {
        $this->load->library('Game_types/' . ucfirst($this->game_type) . '/' . ucfirst($this->game_type), array($grammar_obj));
        $game_type = $this->game_type;
        $this->load->view('sort', array("sentences" => $this->$game_type->get_sentences(), "is_login" => $this->session->userdata('login_status'), "study_type" => $this->session->userdata('study_type')));
    }

    public function get_words() {
        $grammar_id = $_GET['grammar_id'];
        $game_type = $_GET['game_type'];
        $this->load->library('Grammars/Grammar_factory', array($grammar_id, $game_type), 'grammar_factory');
        $grammar_obj = $this->grammar_factory->get_grammar();

        $this->load->library('Game_types/Memory/' . ucfirst($game_type), array($grammar_obj));
        $words = $this->$game_type->get_words();
        echo json_encode($words);
    }

    public function get_questions() {
        $grammar_id = $_GET['grammar_id'];
        $game_type = $_GET['game_type'];
        $this->load->library('Grammars/Grammar_factory', array($grammar_id, $game_type), 'grammar_factory');
        $grammar_obj = $this->grammar_factory->get_grammar();

        $this->load->library('Game_types/Quiz/' . ucfirst($game_type), array($grammar_obj));
        $questions = $this->$game_type->get_questions();
        echo json_encode($questions);
    }

    public function get_sentences() {
        $grammar_id = $_GET['grammar_id'];
        $game_type = $_GET['game_type'];
        $this->load->library('Grammars/Grammar_factory', array($grammar_id, $game_type), 'grammar_factory');
        $grammar_obj = $this->grammar_factory->get_grammar();

        $this->load->library('Game_types/Sort/' . ucfirst($game_type), array($grammar_obj));
        $sentences = $this->$game_type->get_sentences();
        echo json_encode($sentences);
    }

    public function save_results() {
        if ($_GET['grammar_id'] && $_GET['game_type'] && isset($_GET['score'])) {
            $this->load->model('Game');
            $game = new Game();
            $game_id = (int) $game->get_id_by_type($_GET['game_type']);
            $this->load->model('Result');
            $result = new Result();
            $user = $this->session->userdata('user');
            $params = array('uid' => $user['id'],
                'grammar_id' => $_GET['grammar_id'],
                'game_id' => $game_id,
                'score' => $_GET['score']
            );
            $result->save_result($params);
            echo json_encode("ok");
        }
    }

    public function save_word_results() {
        $user = $this->session->userdata('user');
        if ($_POST['words'] && (int) $user['id'] > 0) {
            $this->load->model('Word');
            $words = $_POST["words"];
            foreach ($words as $word) {
                $this->Word->save_word_rate(array("word_id" => $word["id"], "guessed_well" => $word["guessed_well"], "user_id" => (int) $user['id']));
            }
            echo json_encode("ok");
        }
    }
    
    private function memoryCalcWorstTime($limit){
        $card_count = $limit *2;
        $worst_time = 0;
        for($i = $card_count; $i>0; $i-=2){
            $worst_time += ($i-1)*3.6 + 1*2.1;
        }
        return $worst_time;
    }
    
    private function memoryCalcBestTime($limit){
        $card_count = $limit *2;
        $best_time = 0;
        for($i = $card_count; $i>0; $i-=2){
            $best_time += 1*2.1;
        }
        return $best_time;
    }
    
    public function save_memory_results() {
        $user = $this->session->userdata('user');
        if ($_GET['grammar_id'] && $_GET['game_type'] && !empty($_GET['time']) && $_GET['time'] != "" && (int) $user['id'] > 0 && (int) $_GET['limit']>0) {
            $this->load->model('Game');
            $game_id = (int) $this->Game->get_id_by_type($_GET['game_type']);
            $worst_time = $this->memoryCalcWorstTime($_GET['limit']);
            $best_time = $this->memoryCalcBestTime($_GET['limit']);
            $avg = ($worst_time+$best_time)/2;
            $low_limit = ($worst_time + $avg) / 2;
            $high_limit = ($best_time + $avg) / 2;
            $corrected_time = (doubleval($_GET['time']))-$low_limit;
            $corrected_all_time = $high_limit - $low_limit;
            $time_percent = ($corrected_time / $corrected_all_time) * 100;
            if ($time_percent > 100) {
                $time_percent = 100;
            }
            if ($time_percent < 0) {
                $time_percent = 0;
            }

            $user = $this->session->userdata('user');
            $params = array('uid' => $user['id'],
                'grammar_id' => $_GET['grammar_id'],
                'game_id' => $game_id,
                'score' => $time_percent
            );
            $this->load->model('Result');
            $this->Result->save_result($params);
            echo json_encode($time_percent);
        }
    }
}
