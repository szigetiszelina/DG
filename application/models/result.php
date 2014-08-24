<?php

class Result extends CI_Model {

    public function save_result($params) {
        $sql = "INSERT INTO results (user_id, game_id, grammar_id, score, game_date) VALUES (" . (int) $params['uid'] . "," . (int) $params['game_id'] . "," . (int) $params['grammar_id'] . "," . (float) $params['score'] . ",NOW())";

        $this->db->query($sql);
    }

    public function get_achievements_by_user($user_id) {
        $sql = "SELECT * FROM results WHERE user_id =" . (int) $user_id;
        return $this->db->query($sql)->result_array();
    }

    public function get_play_count($user_id) {
        $sql = "SELECT count(*) as count, grammar_id FROM results WHERE user_id =" . (int) $user_id . " GROUP BY grammar_id";
        return $this->db->query($sql)->result_array();
    }

    public function get_score_by_grammar($user_id) {
        $play_counts = $this->get_play_count($user_id);
        for ($i = 0; $i < count($play_counts); $i++) {
            $play_counts[$i]['summarize'] = $play_counts[$i]["count"] * 100;
            $sql = "SELECT sum(score) as sum FROM results WHERE user_id = " . (int) $user_id . " AND grammar_id=" . $play_counts[$i]['grammar_id'];
            $play_counts[$i]['all_score'] = $this->db->query($sql)->row()->sum;
        }
        return $play_counts;
    }

}
