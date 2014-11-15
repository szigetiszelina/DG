<?php

class Game extends CI_Model {

    public function get_games() {
        $sql = "SELECT * FROM games";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function get_id_by_type($type){
        $sql = "SELECT id FROM games WHERE name='".mysql_real_escape_string($type)."'";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result["id"];
    }

}
