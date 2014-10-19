<?php

require_once('application/libraries/Game_types/Quiz/Quiz_playable.php');

class Word_quiz implements Quiz_playable {

    public $word;
    public $limit;
    protected $alternatives = array();
    protected $questions;
    public $language = "hu_to_ge";
    protected $CI;

    public function __construct($params) {
        $this->CI = get_instance();
        $this->word = $params["word"];
        $this->limit = (int) $params["limit"];
        $this->language = $params["language"];
        $this->set_questions();
    }

    public function set_questions() {
        $this->create_questions($this->word->get_words($this->CI->session->userdata("user")["id"], $this->CI->session->userdata("study_type"), $this->limit));
    }

    public function set_alternatives($answer, $filter = null, $value = null) {
        $filter = array($filter, $value);
        $alternative_words = array();
        $alternative_words = $this->word->get_words($this->CI->session->userdata("user")["id"], null, 5, $answer, $filter);
        if(count($alternative_words) < 5) {
            $alternative_words = array_merge($alternative_words, $this->word->get_words($this->CI->session->userdata("user")["id"], null, 5 - count($alternative_words), $answer)); 
        }
        $this->alternatives = array();
        foreach ($alternative_words as $word) {
            if ($filter == "meaning") {
                $this->alternatives[] = $word["meaning"];
            } else {
                $this->alternatives[] = $word["article"] . " " . $word["word"] . ", " . $word["plural"];
            }
        }
    }

    public function get_questions() {
        return $this->questions;
    }

    public function create_questions($words) {
        foreach ($words as $word) {
            if ($this->language == "hu_to_ge") {
                $question = "Mit jelent németül '" . $word["meaning"] . "'?";
                $answer = $word["article"] . " " . $word["word"] . ", " . $word["plural"];
                $this->set_alternatives($word['id'], "word", $word["word"][0]);
            } else {
                $question = "Mit jelent a '" . $word["article"] . " " . $word["word"] . ", " . $word["plural"] . "' szó?";
                $answer = $word["meaning"];
                $this->set_alternatives($word['id'], "meaning", $word["meaning"][0]);
            }
            $this->alternatives[] = $answer;
            shuffle($this->alternatives);
            $this->questions[] = array("question" => $question, "answer" => $answer, "alternatives" => $this->alternatives, "word_id" => $word['id']);
        }
    }

}
