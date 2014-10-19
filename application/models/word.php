<?php

class Word extends CI_Model {

    public function get_words($user_id, $study_type = null, $limit = null, $notequals = null, $filter = null) {
        $sql = "SELECT words.*, gwr.guessed_well_number/gwr.all_incidence_number as guessed FROM words";
        $sql .= " LEFT JOIN words_guessed_well_rate as gwr ON(words.id = gwr.word_id and gwr.user_id = " . (int) $user_id . ")";
        if ((int) $notequals > 0) {
            $sql .= " WHERE words.id != " . (int) $notequals;
            if ($filter != null) {
                $sql .= " AND " . $filter[0] . " LIKE '" . $filter[1] . "%'";
            }
        }
        $sql .= " GROUP BY words.meaning";
        
        if($study_type == "evelove"){
            $sql.=" HAVING guessed<0.5 OR guessed is NULL";
        }else {
            if($study_type == "exercise"){
                $sql.=" HAVING guessed>= 0.5";
            }
        }
        $sql .= " ORDER BY words.level DESC, guessed Desc, rand() ";
        if ((int) $limit > 0) {
            $sql .= " LIMIT " . $limit;
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function save_word_rate($params) {
        $sql = "SELECT count(*) as count FROM words_guessed_well_rate WHERE word_id =" . (int) $params["word_id"] . " and user_id =" . (int) $params["user_id"];

        if ($this->db->query($sql)->row()->count > 0) {
            $sql = "UPDATE words_guessed_well_rate SET all_incidence_number = all_incidence_number+1, last_incidence = NOW() ";
            if ($params["guessed_well"]) {
                $sql .= ", guessed_well_number = guessed_well_number+1 ";
            }
            $sql .= "WHERE word_id =" . (int) $params["word_id"] . " and user_id =" . (int) $params["user_id"];
        } else {
            $sql = "INSERT INTO words_guessed_well_rate (word_id, user_id, last_incidence, all_incidence_number, guessed_well_number) VALUES(" . (int) $params["word_id"] . ", " . (int) $params["user_id"] . ", NOW(), 1, " . ($params["guessed_well"] == true ? "1" : "0") . ")";
        }
        $this->db->query($sql);
    }

    public function get_verbs($user_id, $study_type = null, $limit = null) {
        $sql = "SELECT words.*, gwr.guessed_well_number/gwr.all_incidence_number as guessed FROM words";
        $sql .= " LEFT JOIN words_guessed_well_rate as gwr ON(words.id = gwr.word_id AND gwr.user_id = " . (int) $user_id . ")";
        $sql .= " WHERE words.wortart = 'verben' AND words.präsens !=''";
        $sql .= " GROUP BY words.meaning";
        if($study_type == "evelove"){
            $sql.=" HAVING guessed<0.5 OR guessed is NULL";
        }else {
            if($study_type == "exercise"){
                $sql.=" HAVING guessed>= 0.5";
            }
        }
        $sql .= " ORDER BY words.level DESC, guessed Desc, rand() ";
        if ((int) $limit > 0) {
            $sql .= " LIMIT " . $limit;
        }

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_word_id($article, $word, $plural) {
        $sql = "SELECT id FROM words WHERE article ='". $article . "' AND word ='" . $word . "' AND plural='" . $plural . "'";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result['id'];
    }

    public function save_word_categories($word_categories) {
        var_dump($word_categories);
        $sql = "INSERT INTO word_categories (word_id, category_id) VALUES";
        for ($i = 0; $i < count($word_categories); $i++) {
            for ($j = 0; $j < count($word_categories[$i]["categories"]); $j++) {
                if ((int) $word_categories[$i]["word_id"] > 0 && $word_categories[$i]["categories"][$j] != "") {
                    $sql.= (($i > 0) ? ", " : "") . "(" . (int) $word_categories[$i]["word_id"] . ", " . (int) $word_categories[$i]["categories"][$j] . ")";
                }
            }
        }
        if ($sql != "INSERT INTO word_categories (word_id, category_id) VALUES") {
            $this->db->query($sql);
        }
    }

}
