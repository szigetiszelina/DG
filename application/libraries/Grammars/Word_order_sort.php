<?php
require_once('application/libraries/Game_types/Sort/Sort_playable.php');
class Word_order_sort implements Sort_playable{
    public $limit;
    public $sentences = array();
    public $word_order;
     public function __construct($params){
	$this->word_order = $params["word_order"];
        $this->limit = null;
        $this->set_sentences();
    }
 
    public function set_sentences(){
        $this->sentences = $this->transform_sentences($this->word_order->get_sentences($this->limit));
    }
    
    public function get_sentences(){
        return $this->sentences;
    }
    
    public function transform_sentences($sentences){
        foreach($sentences as &$sentence){
            $words = explode(" ", $sentence["sentence"]);
            $keys = array_keys($words);
            shuffle($keys);
            $sentence["mixed"] = array();
            for($i=0; $i<count($keys); $i++){
                $sentence["mixed"][$i]["key"] = $keys[$i];
                $sentence["mixed"][$i]["word"] = $words[$keys[$i]];
            }
        }
        return $sentences;
    }
}