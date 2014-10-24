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
        $this->load->library('Game_types/' . $this->game_type . '/' . $this->game_type, array($grammar_obj, 8));
        $game_type = $this->game_type;
        $this->load->view('memory_game', array("words" => $this->$game_type->get_words(), "is_login" => true));
    }

    protected function play_quiz($grammar_obj) {
        $this->load->library('Game_types/' . $this->game_type . '/' . $this->game_type, array($grammar_obj));
        $game_type = $this->game_type;
        $questions = $this->$game_type->get_questions();
        $this->load->view('quiz', array("questions" => $questions, "is_login" => true));
    }

    protected function play_sort($grammar_obj) {
        $this->load->library('Game_types/' . $this->game_type . '/' . $this->game_type, array($grammar_obj));
        $game_type = $this->game_type;
        $this->load->view('sort', array("sentences" => $this->$game_type->get_sentences(), "is_login" => true));
    }

    public function get_words() {
        $grammar_id = $_GET['grammar_id'];
        $game_type = $_GET['game_type'];
        $this->load->library('Grammars/Grammar_factory', array($grammar_id, $game_type), 'grammar_factory');
        $grammar_obj = $this->grammar_factory->get_grammar();

        $this->load->library('Game_types/Memory/' . $game_type, array($grammar_obj, 8));
        $words = $this->$game_type->get_words();
        echo json_encode($words);
    }

    public function get_questions() {
        $grammar_id = $_GET['grammar_id'];
        $game_type = $_GET['game_type'];
        $this->load->library('Grammars/Grammar_factory', array($grammar_id, $game_type), 'grammar_factory');
        $grammar_obj = $this->grammar_factory->get_grammar();

        $this->load->library('Game_types/Quiz/' . $game_type, array($grammar_obj));
        $questions = $this->$game_type->get_questions();
        echo json_encode($questions);
    }

    public function get_sentences() {
        $grammar_id = $_GET['grammar_id'];
        $game_type = $_GET['game_type'];
        $this->load->library('Grammars/Grammar_factory', array($grammar_id, $game_type), 'grammar_factory');
        $grammar_obj = $this->grammar_factory->get_grammar();

        $this->load->library('Game_types/Sort/' . $game_type, array($grammar_obj));
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
            $params = array('uid' => $this->session->userdata('user')['id'],
                'grammar_id' => $_GET['grammar_id'],
                'game_id' => $game_id,
                'score' => $_GET['score']
            );
            $result->save_result($params);
            echo json_encode("ok");
        }
    }

    public function save_word_results() {
        if ($_POST['words'] && (int) $this->session->userdata('user')['id'] > 0) {
            $this->load->model('Word');
            $uid = (int) $this->session->userdata('user')['id'];
            $words = $_POST["words"];
            foreach ($words as $word) {
                $this->Word->save_word_rate(["word_id" => $word["id"], "guessed_well" => $word["guessed_well"], "user_id" => $uid]);
            }
            echo json_encode("ok");
        }
    }

}
