<?php 

class Word extends CI_Model {
    
    public function get_words($limit = null){
        $sql = "SELECT * FROM words";
        $sql .= " GROUP BY meaning "
              . " ORDER BY rand() ";
        if((int)$limit > 0){
            $sql .= " LIMIT ".$limit;
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
