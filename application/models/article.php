<?php 

class Article extends CI_Model {
   
    public function get_articles($limit = null){
        $sql = "SELECT * FROM articles ORDER BY rand() ";
        if((int)$limit > 0){
            $sql .= " LIMIT ".$limit;
        }
        $query = $this->db->query($sql);
        return $query->result_array();
   }
}
