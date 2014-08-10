<?php 

class Word_order extends CI_Model {
   
    public function get_sentences($limit = null){
        $sql = "SELECT * FROM sentences ORDER BY rand() ";
        if((int)$limit > 0){
            $sql .= " LIMIT ".$limit;
        }
        $query = $this->db->query($sql);
        return $query->result_array();
   }
}
