<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sort{
	
    //public $questions_number = 10;
    public $sentences = array();
    public $grammar = null;
     
    public function __construct($params){
        $this->set_qrammar($params[0]);
    }
    
    /*public function set_questions_number($limit){
        $this->questions_number = $limit;
    }*/
    
    public function set_qrammar($grammar_obj){
        $this->grammar = $grammar_obj;
    }
    
    public function get_sentences(){
        return $this->grammar->get_sentences();
    }
    
   /* public function save_quiz_statistic($results){
        $this->grammar->save_results($results["uid"],$results["word_id"],$results["successful"]);
    }*/
}