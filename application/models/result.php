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

    public function get_this_month_result_by_game_and_grammar($user_id) {
        $sql = "SELECT sum(results.score) as score, count(results.id) as db, games.hu_name, grammars.name FROM results"
                . " LEFT JOIN games ON(results.game_id = games.id)"
                . " LEFT JOIN grammars ON(results.grammar_id = grammars.id)"
                . " WHERE results.user_id = " . (int) $user_id . " AND YEAR(results.game_date) = YEAR(NOW()) and MONTH(results.game_date) = MONTH(NOW()) GROUP BY results.game_id, results.grammar_id";
        return $this->db->query($sql)->result_array();
    }

    public function get_monthly_result($user_id, $year = null) {
        $sql = "SELECT sum(results.score) as all_score, count(results.id) as db, MONTH(results.game_date) as month FROM results"
                . " WHERE results.user_id = " . (int) $user_id;
        if ((int) $year > 0) {
            $sql.= " AND YEAR(results.game_date) = " . (int) $year;
        } else {
            $sql.= " AND YEAR(results.game_date) = YEAR(NOW())";
        }
        $sql .= " GROUP BY MONTH(results.game_date)";
        return $this->db->query($sql)->result_array();
    }

    public function get_daily_result($user_id, $year = null, $month = null) {
        $sql = "SELECT sum(results.score) as all_score, count(results.id) as db, DAY(results.game_date) as day FROM results"
                . " WHERE results.user_id = " . (int) $user_id;
        if ((int) $year > 0) {
            $sql.= " AND YEAR(results.game_date) = " . (int) $year;
        } else {
            $sql.= " AND YEAR(results.game_date) = YEAR(NOW())";
        }
        if ((int) $month > 0) {
            $sql.= " AND MONTH(results.game_date) = " . (int) $month;
        } else {
            $sql.= " AND MONTH(results.game_date) = MONTH(NOW())";
        }
        $sql .= " GROUP BY DAY(results.game_date)";

        return $this->db->query($sql)->result_array();
    }

    public function get_top_results($time_const = "year", $limit = null) {
        $sql = "SELECT sum(results.score) as score, count(results.id) as db, users.name, users.id, users.fb_id, users.profil_image "
                . "FROM results LEFT JOIN users ON (users.id = results.user_id) "
                . "WHERE YEAR(results.game_date) = YEAR(NOW()) ";
        if ($time_const == "month" || $time_const == "day") {
            $sql .= "AND MONTH(results.game_date) = MONTH(NOW()) ";
        }
        if ($time_const == "day") {
            $sql .= "AND DAY(results.game_date) = DAY(NOW()) ";
        }
        $sql .= "GROUP BY users.id ORDER BY score DESC";
        if ((int) $limit > 0) {
            $sql.=" LIMIT " . (int) $limit;
        }
        return $this->db->query($sql)->result_array();
    }

    public function get_toplist_by_friends($user_id) {
        $users = $this->get_friends($user_id);
        if (count($users) > 0) {
            $sql = "SELECT sum(results.score) as score, count(results.id) as db, users.name, users.id, users.fb_id, users.profil_image FROM users "
                    . "LEFT JOIN results ON (users.id = results.user_id "
                    . "AND YEAR(results.game_date) = YEAR(NOW()) "
                    . "AND MONTH(results.game_date) = MONTH(NOW())) "
                    . " WHERE ";
            foreach ($users as $user) {
                $sql .= " users.id = " . $user["id"] . " OR ";
            }
            $sql = rtrim($sql, " OR ");
            $sql .= " GROUP BY users.id ORDER BY score Desc";
            return $this->db->query($sql)->result_array();
        }
    }

    public function get_friends($user_id) {
        $sql = "SELECT fb_id FROM users WHERE id = ".(int)$user_id;
        $result = $this->db->query($sql)->row_array();
        
        if ($result["fb_id"] != "" && $result["fb_id"] != null) {
            $fb_id = $result["fb_id"];
            $sql = "SELECT users.* FROM user_contacts as uc INNER JOIN users ON (users.fb_id= uc.fb_id1 || users.fb_id=fb_id2) WHERE (uc.fb_id1=" . $fb_id . " OR uc.fb_id2 = " . $fb_id . ") AND uc.both_of_them_gamer = true GROUP BY users.id";
            return $this->db->query($sql)->result_array();
        }
        return array();
    }
}
