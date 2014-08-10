<?php 

class Game extends CI_Model{
    
   public function get_games(){
        $sql = "SELECT * FROM games";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
