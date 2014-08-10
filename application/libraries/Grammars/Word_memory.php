<?php
require_once('application/libraries/Game_types/Memory/Memory_playable.php');
class Word_memory implements Memory_playable{
	
    private $word;
    private $limit;
    protected $words;
    	
    public function __construct($params){
	$this->set_word($params["word"]);
        $this->set_limit((int) $params["limit"]);
        $this->set_words();
    }
    
    public function set_word($word){
       $this->word = $word; 
    }
    
    public function set_limit($limit){
        $this->limit = $limit;
    }
    
    public function set_words(){
        $this->words = $this->word->get_words($this->limit);
    }
    
    public function get_words(){
        return $this->words;
    }
	
}