<?php 

class Word extends CI_Model {
    
    /*public function set_words($filename){
       if(file_exists($filename)){
            $csv=fopen($filename,"r");
            $lines=array();
            while(!feof($csv)){
                $lines[] = explode(";",trim(fgets($csv),"\n"));
            }
            if(!empty($lines)){
                $this->db->query("TRUNCATE words");
                foreach($lines as $line){
                    if($line[1]!="" && $line!=null){
                        $this->db->query("INSERT INTO words (article,word,plural,imperfect,perfect,level,meaning) VALUES(". $this->db->escape($line[0]).",".$this->db->escape($line[1]).",". $this->db->escape($line[2]).",".$this->db->escape($line[3]).",". $this->db->escape($line[4]).",". $this->db->escape($line[5]).",'".mysql_real_escape_string($line[6])."')");
                    }
                }
                return true;
            }else{
                return false;
            }
        } else {
            return false;
        } 
    }
    */
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
    
    /*public function get_task_question_datas($level = null, $category = null){
        $sql_count = "SELECT count (*)";       
        $sql = "SELECT * FROM words";
        /*if((int)$level>0){
            $sql_count .= " WHERE level=".(int)$level;
            $sql .= " WHERE level=".(int)$level;
            if((int)$category>0){
                $sql_count .= " AND level=".(int)$level;
                $sql .= " AND level=".(int)$level;
            }
        } else{
           if((int)$category>0){
                $sql_count .= " WHERE level=".(int)$level;
                $sql .= " WHERE level=".(int)$level;
            } 
        }*/
        
        
        
   /* }
    
    public function save_results($user_id, $word_id, $successful){
        $sql = "SELECT * FROM statistics WHERE user_id=".(int)$user_id." and word_id=".(int)$word_id;
        $query = $this->db->query($sql);
        $result = $query->row_array();
        var_dump($result);
        //if($result)
        $sql = "UPDATE statistics SET incidence_count=".($result["incidence_count"]+1);
        if($successful===true){
            $sql .= " and success_count=".$result["success_count"]+1;
        }
        $this->db->query($sql);
    }*/
}
