<?php

class Grammar extends CI_Model {

    public function get_grammars() {
        $refs = array();
        $list = array();

        $sql = "SELECT id, parent_id, name FROM grammars ORDER BY name";

        $query = $this->db->query($sql);
        $result = $query->result_array();
        foreach ($result as &$r) {
            $sql = "SELECT games.name as game_name FROM grammar_playable "
                    . "INNER JOIN games ON(grammar_playable.game_id = games.id) "
                    . "WHERE grammar_playable.grammar_id=" . (int) $r['id'];
            $query = $this->db->query($sql);
            $playable_res = $query->result_array();
            $r['playable'] = array();
            foreach ($playable_res as $pr) {
                $r['playable'][] = $pr["game_name"];
            }
        }
        foreach ($result as $data) {
            $thisref = &$refs[$data['id']];

            $thisref['parent_id'] = $data['parent_id'];
            $thisref['name'] = $data['name'];
            $thisref['id'] = $data['id'];
            $thisref['playable'] = $data['playable'];

            if ($data['parent_id'] === null) {
                $list[$data['id']] = &$thisref;
            } else {
                $refs[$data['parent_id']]['children'][$data['id']] = &$thisref;
            }
        }
        return $this->create_list($list);
    }

    public function create_list($arr) {
        $html = "<ul class='grammars'>";
        foreach ($arr as $key => $v) {
            $show = "";
            foreach ($v['playable'] as $playable) {
                if ($show == "") {
                    $show.="game_types." . $playable;
                } else {
                    $show.=" || game_types." . $playable;
                }
            }
            $html .= '<li ng-show="' . $show . '"><a ng-href="' . base_url() . 'play?game_type={{selected_game}}&grammar_id=' . $v['id'] . '&category={{selected_category}}">' . $v['name'] . "</a></li>";
            if (array_key_exists('children', $v)) {
                $html .= '<li ng-show="' . $show . '">';
                $html .= $this->create_list($v['children']);
                $html .= '</li>';
            }
        }
        $html .= '</ul>';
        return $html;
    }

    public function get_name_by_id($grammar_id) {
        $sql = "SELECT name FROM grammars WHERE id=" . (int) $grammar_id;
        $query = $this->db->query($sql);
        return $query->row()->name;
    }

}
