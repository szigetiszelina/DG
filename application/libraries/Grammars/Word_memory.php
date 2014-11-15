<?php

require_once('application/libraries/Game_types/Memory/Memory_playable.php');

class Word_memory implements Memory_playable {

    private $word;
    private $limit;
    protected $words;
    protected $CI;
    private $user;

    public function __construct($params) {
        $this->CI = get_instance();
        $this->user = $this->CI->session->userdata("user");
        $this->set_word($params["word"]);
        $this->set_limit((int) $params["limit"]);
        $this->set_words();
    }

    public function set_word($word) {
        $this->word = $word;
    }

    public function set_limit($limit) {
        $this->limit = $limit;
    }

    public function set_words() {
        $this->words = $this->word->get_words($this->user["id"], $this->CI->session->userdata("study_type"), $this->CI->session->userdata("category_id"), $this->limit);
        if (empty($this->words) || $this->words == null) {
            //Hibaüzenet
            $this->words = $this->word->get_words($this->user["id"], $this->CI->session->userdata("study_type"), null, $this->limit);
        }
    }

    public function get_words() {
        return $this->words;
    }

}
