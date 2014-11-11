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
    
    public function get_this_month_result_by_game_and_grammar($user_id){
        $sql = "SELECT sum(results.score) as score, count(results.id) as db, games.hu_name, grammars.name FROM results"
                . " LEFT JOIN games ON(results.game_id = games.id)"
                . " LEFT JOIN grammars ON(results.grammar_id = grammars.id)"
               . " WHERE results.user_id = " . (int) $user_id . " AND YEAR(results.game_date) = YEAR(NOW()) and MONTH(results.game_date) = MONTH(NOW()) GROUP BY results.game_id, results.grammar_id";
        return $this->db->query($sql)->result_array();
    }
    
   

   /* van összesen melyik nyelvtanban a legjobb
melyik játék melyik nyelvtanban milyen jó volt a hónapban
bekérni a hónapot ehhez
összehasonlítani egyik hónapot a másikkal
itt is lehessen megadni értéket

kategóriánként megszámolni hány szót tud



toplista utolsó hónapban legtöbb pontot elérők -/
előző hónapban mennyit játszott egy nyelvtannal most
utolsó két hónapban ki javított egy nyelvtanból és mennyit legjobbak
legtöbbet játszók/csak befejezett játékra vagyis a result táblából kell lekérni

Select user_id, sum(score) as all_score, count(id) as all_point from results where YEAR(game_date)= y AND MONTH(game_date)=m Group By user_id Order By all_score/all_point DESC;

Select user_id, sum(score) as all_score, count(id) as all_point where YEAR(game_date)= y AND MONTH(game_date)=m Group By user_id, grammar_id

accordition
mondat szórend
alap*/

}
