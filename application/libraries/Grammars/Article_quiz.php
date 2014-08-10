<?php
require_once('application/libraries/Game_types/Quiz/Quiz_playable.php');
class Article_quiz implements Quiz_playable{
	
    public $article;
    public $limit;
    protected $alternatives = array();
    protected $questions;
    public $optional_articles_set = array();
    	
    public function __construct($params){
	$this->article = $params["articles"];
        $this->limit = (int) $params["limit"];
        $this->set_alternatives($params["alternatives"]);
        $this->set_optional_articles_set($params["optional_articles_set"]);
        $this->set_questions();
    }
    
    public function set_questions(){
        $this->create_questions($this->article->get_articles($this->limit));
    }
    
    public function set_alternatives($alternatives){
        $this->alternatives = $alternatives;
    }
    
    public function set_optional_articles_set($optional_articles_set){
        $this->optional_articles_set = $optional_articles_set;
    }

    public function get_questions(){
        return $this->questions;
    }
    
    public function create_questions($articles){        
        foreach($articles as $article){
            $optional_articles = $this->set_optional_articles($article["gender"]);
            if($optional_articles!==null){
                $question = "Hogyan ragozzuk az '".$this->hungarize_article_helper($optional_articles)."' jelentésű, ".$this->hungarize_gender_helper($article['gender'])." névelőt ".$this->hungarize_case_helper($article["case"])." esetben?";
                $answer = $article[$optional_articles];
                $this->questions[]=array("question" => $question, "answer" => $answer, "alternatives" => $this->alternatives, "word_id" => $article['id']);
            }else{
                $this->limit--;
            }
        }
        $this->questions;
    }
    
    public function set_optional_articles($gender){
        $optional_articles_set = array();
        if($gender == "plural"){ 
           foreach($this->optional_articles_set as $opa){
               if($opa!="indefinite_affirmative"){
                   $optional_articles_set[] = $opa;
               }
           }
           if(count($optional_articles_set)==0){
               return null;
           }
        }else{
            $optional_articles_set = $this->optional_articles_set;
        }
        
        $optional_articles = "";
        if(count($optional_articles_set) == 1){
            $optional_articles = $optional_articles_set[0];
        }else{
           $index = rand(0,count($optional_articles_set)-1);
           $optional_articles = $optional_articles_set[$index];
        }
        return $optional_articles;
    }
    
    public function hungarize_gender_helper($gender){
        $hun_gender = "";
        switch ($gender){
            case "masculine" : {
                            $hun_gender = "hímnemű";
                            break;
            }
            case "feminine" : {
                            $hun_gender = "nőnemű";
                            break;
            }
            case "neuter" : {
                            $hun_gender = "semlegesnemű";
                            break;
            }
            case "plural" : {
                            $hun_gender = "többesszámú";
                            break;
            }
        }
        return $hun_gender;
    }
    
    public function hungarize_case_helper($case){
        $hun_case = "";
        switch ($case){
            case "nominative" : {
                            $hun_case = "alany";
                            break;
            }
            case "accusative" : {
                            $hun_case = "tárgy";
                            break;
            }
            case "dative" : {
                            $hun_case = "részes";
                            break;
            }
            case "genitive" : {
                            $hun_case = "birtokos";
                            break;
            }
        }
        return $hun_case;
    }
    
    public function hungarize_article_helper($article){
        $hun_article = "";
        switch ($article){
            case "definite" : {
                            $hun_article = "a";
                            break;
            }
            case "indefinite_affirmative" : {
                            $hun_article = "egy";
                            break;
            }
            case "indefinite_negation" : {
                            $hun_article = "tagadó";
                            break;
            }
        }
        return $hun_article;
    }
	
}