<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Memory{
	
   private $words = array();
   private $grammar = null;
     
    public function __construct($params){
        $this->set_qrammar($params[0]);
        $this->set_words();
    }
    
    public function set_qrammar($grammar_obj){
        $this->grammar = $grammar_obj;
    }
    
    public function set_words(){
        $words = $this->grammar->get_words();
        if($words != null && !empty($words)){
            for($i=0;$i<count($words);$i++){          
               $ger=array('word'=>$words[$i]['word'],'id'=>$i, 'word_id' => $words[$i]['id']);
               $hun=array('word'=>$words[$i]['meaning'],'id'=>$i, 'word_id' => $words[$i]['id']);
               $memorywords[]=$ger;
               $memorywords[]=$hun;
            }
            shuffle($memorywords);
            $this->words = $memorywords;
        }
    }
    public function get_words(){
        return $this->words;
    }
}