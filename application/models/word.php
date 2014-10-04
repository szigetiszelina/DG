<?php

class Word extends CI_Model {

    public function get_words($user_id, $limit = null, $notequals = null, $filter = null) {
        $sql = "SELECT words.*, gwr.guessed_well_number/gwr.all_incidence_number as guessed FROM words";
        $sql .= " LEFT JOIN words_guessed_well_rate as gwr ON(words.id = gwr.word_id and gwr.user_id = " . (int) $user_id . ")";
        if ((int) $notequals > 0) {
            $sql .= " WHERE words.id != " . (int) $notequals;
            if ($filter != null) {
                $sql .= " AND " . $filter[0] . " LIKE '" . $filter[1] . "%'";
            }
        }
        $sql .= " GROUP BY words.meaning "
                . " ORDER BY words.level DESC, guessed Desc, rand() ";
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

    public function get_verbs($user_id, $limit = null) {
        $sql = "SELECT words.*, gwr.guessed_well_number/gwr.all_incidence_number as guessed FROM words";
        $sql .= " LEFT JOIN words_guessed_well_rate as gwr ON(words.id = gwr.word_id and gwr.user_id = " . (int) $user_id . ")";
        $sql .= " WHERE words.wortart = 'verben' and words.präsens !=''";
        $sql .= " GROUP BY words.meaning "
                . " ORDER BY words.level DESC, guessed Desc, rand() ";
        if ((int) $limit > 0) {
            $sql .= " LIMIT " . $limit;
        }

        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
