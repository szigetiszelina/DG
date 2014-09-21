<?php

class Grammar_factory {

    protected $CI;
    public $grammar_obj;
    private $grammar_id;
    private $game_type;

    public function __construct($params) {
        $this->CI = get_instance();
        $this->grammar_id = (int) $params[0];
        $this->game_type = $params[1];
        $this->set_grammar();
    }

    public function set_grammar() {
        if ($this->grammar_id > 0 && $this->grammar_id < 6) {
            if ($this->game_type == "quiz") {
                $this->CI->load->model('Article');
                $attributes = $this->get_attributes_article_quiz();
                $parameters = array("articles" => $this->CI->Article, "limit" => 10, "alternatives" => $attributes["alternatives"], "optional_articles_set" => $attributes["optional_articles_set"]);
                $this->CI->load->library('Grammars/Article_quiz', $parameters, 'article_quiz');
                $this->grammar_obj = $this->CI->article_quiz;
            }
        } else {
            if ($this->grammar_id == 6) {
                switch ($this->game_type) {
                    case "memory":
                        $this->CI->load->model('Word');
                        $parameters = array("word" => $this->CI->Word, "limit" => 18);
                        $this->CI->load->library('Grammars/Word_memory', $parameters, 'word_memory');
                        $this->grammar_obj = $this->CI->word_memory;
                        break;
                    case "quiz":
                        $this->CI->load->model('Word');
                        $parameters = array("word" => $this->CI->Word, "limit" => 10, "language" => "hu_to_ge");
                        $this->CI->load->library('Grammars/Word_quiz', $parameters, 'word_quiz');
                        $this->grammar_obj = $this->CI->word_quiz;
                        break;
                }
            } else {
                if ($this->grammar_id == 7) {
                    switch ($this->game_type) {
                        case "sort":
                            $this->CI->load->model('Word_order');
                            $parameters = array("word_order" => $this->CI->Word_order);
                            $this->CI->load->library('Grammars/Word_order_sort', $parameters, 'word_order_sort');
                            $this->grammar_obj = $this->CI->word_order_sort;
                            break;
                    }
                } else {
                    if ($this->grammar_id == 8) {
                        $this->CI->load->model('Word');
                        $parameters = array("word" => $this->CI->Word, "limit" => 10);
                        $this->CI->load->library('Grammars/Verb_quiz', $parameters, 'verb_quiz');
                        $this->grammar_obj = $this->CI->verb_quiz;
                    } else{
                        $this->grammar_obj = null;
                    }
                }
            }
        }
    }

    public function get_attributes_article_quiz() {
        $optional_articles_set = array();
        $alternatives = array();

        switch ($this->grammar_id) {
            case 1 : {
                    $optional_articles_set = array("definite", "indefinite_affirmative", "indefinite_negation");
                    $alternatives = array("der", "die", "das", "den", "dem", "des+s", "den+n", "ein", "eine", "einer", "einen", "einem", "eines+s", "kein", "keine", "keiner", "keinen", "keinem", "keinen+n", "keines+s");
                    break;
                }
            case 2 : {
                    $optional_articles_set = array("indefinite_affirmative", "indefinite_negation");
                    $alternatives = array("ein", "eine", "einer", "einen", "einem", "eines+s", "kein", "keine", "keiner", "keinen", "keinem", "keinen+n", "keines+s");
                    break;
                }
            case 3 : {
                    $optional_articles_set = array("definite");
                    $alternatives = array("der", "die", "das", "den", "dem", "des+s", "den+n");
                    break;
                }
            case 4 : {
                    $optional_articles_set = array("indefinite_affirmative");
                    $alternatives = array("ein", "eine", "einer", "einen", "einem", "eines+s");
                    break;
                }
            case 5 : {
                    $optional_articles_set = array("indefinite_negation");
                    $alternatives = array("kein", "keine", "keiner", "keinen", "keinem", "keinen+n", "keines+s");
                    break;
                }
        }

        return array("optional_articles_set" => $optional_articles_set, "alternatives" => $alternatives);
    }

    public function get_grammar() {
        return $this->grammar_obj;
    }

}
