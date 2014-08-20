<?php 

class Result extends CI_Model {
   
    public function save_result($params){
        $sql = "INSERT INTO results (user_id, game_id, grammar_id, score, game_date) VALUES (".(int)$params['uid'].",".(int)$params['game_id'].",".(int)$params['grammar_id'].",".(float)$params['score'].",NOW())";
        
        $this->db->query($sql);
   }
}
