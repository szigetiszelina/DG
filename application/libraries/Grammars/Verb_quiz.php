<?php

require_once('application/libraries/Game_types/Quiz/Quiz_playable.php');

class Verb_quiz implements Quiz_playable {

    public $word;
    public $limit;
    protected $alternatives = array();
    protected $questions;

    public function __construct($params) {
        $this->word = $params["word"];
        $this->limit = (int) $params["limit"];
        $this->set_questions();
    }

    public function set_questions() {
        $this->create_questions($this->word->get_verbs($this->limit));
    }

    public function set_alternatives($präsens) {
        $this->alternatives = array_map('trim', explode("|", $präsens));
    }

    public function get_questions() {
        return $this->questions;
    }

    public function select_personal_pronoun() {
        return rand(0,5);
    }

    public function create_questions($verbs) {
        foreach ($verbs as $verb) {
            $case = $this->select_personal_pronoun();
            $question = "Hogyan ragozzuk a következő igét: '" . $verb["word"] . "' ".$this->personal_pronoun_helper($case)." esetben?";
            $this->set_alternatives($verb['präsens']);
            $answer = $this->alternatives[$case];
            $this->alternatives = array_unique($this->alternatives);
            shuffle($this->alternatives);
            $this->questions[] = array("question" => $question, "answer" => $answer, "alternatives" => $this->alternatives, "word_id" => $verb['id']);
        }
    }

    public function personal_pronoun_helper($index) {
        switch ((int) $index) {
            case 0 : {
                    return "E/1 (ich)";
            }
            case 1 : {
                    return "E/2(du)";
            }
            case 2 : {
                    return "E/3 (er/sie/es)";
            }
            case 3 : {
                    return "T/1 (wir)";
            }
            case 4 : {
                    return "T/2 (ihr)";
            }
            case 5 : {
                    return "T/3 (sie)";
            }
        }
    }

}
