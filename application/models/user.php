<?php

class User extends CI_Model {

    public function user_exists($fb_id) {
        $sql = "SELECT count(*) as count FROM users WHERE fb_id=" . $fb_id;
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return (($result['count'] > 0) ? true : false);
    }

    public function add_user($datas) {
        $sql = "INSERT INTO users (fb_id, name, nick_name, email, birthday, 
                                   profil_image, gender, location, last_login, first_login) 
                VALUES(" . $datas['fb_id'] . ", '" . $datas['name'] . "','" . $datas['nickname'] . "', 
                       '" . $datas['email'] . "', '" . $datas['birthday'] . "', 
                       '" . $datas['profil_image'] . "', '" . $datas['gender'] . "', 
                       '" . $datas['location'] . "', NOW(), NOW())";
        $this->db->query($sql);
        $this->update_user_contacts($datas['fb_id']);
        foreach ($datas['friends'] as $friend) {
            $this->save_user_contacts($datas['fb_id'], $friend);
        }
    }

    public function update_last_login($fb_id) {
        $sql = "UPDATE users SET last_login = NOW() WHERE fb_id=" . $fb_id;
        $this->db->query($sql);
    }

    public function get_user($fb_id) {
        $sql = "SELECT * FROM users WHERE fb_id=" . $fb_id;
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function userdata_synchronize($new_datas) {
        $user_datas = $this->get_user($new_datas['fb_id']);
        $modified_datas = array();
        foreach ($new_datas as $key => $data) {
            if ($key != "friends" && $data != $user_datas[$key]) {
                $modified_datas [] = array("key" => $key, "value" => $data);
            }
        }
        if (!empty($modified_datas)) {
            $this->mod_user($user_datas['id'], $modified_datas);
        }
        foreach ($new_datas['friends'] as $friend) {
            $this->save_user_contacts($new_datas['fb_id'], $friend);
        }
    }

    public function mod_user($id, $datas) {
        if ((int) $id > 0 && !empty($datas)) {
            $sql = "UPDATE users SET ";
            foreach ($datas as $data) {
                if ($data['key'] != "friends") {
                    $sql.= $data['key'] . " = '" . $data['value'] . "' ";
                }
            }
            $sql.= " WHERE id = " . (int) $id;
            $this->db->query($sql);
        }
    }

    public function save_user_contacts($new_user_fb_id, $friend_fb_id) {
        $sql = "SELECT count(*) as count FROM user_contacts WHERE (fb_id1 =" . (int) $new_user_fb_id . " AND fb_id2 = " . (int) $friend_fb_id . ") "
                . "OR (fb_id1 =" . (int) $friend_fb_id . " AND fb_id2 = " . (int) $new_user_fb_id . ")";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        if ((int) $result['count'] < 1) {
            $sql = "INSERT INTO user_contacts(fb_id1,fb_id2) VALUES(" . (int) $new_user_fb_id . "," . (int) $friend_fb_id . ")";
            $this->db->query($sql);
        }
    }

    public function update_user_contacts($fb_id) {
        $sql = "UPDATE user_contacts SET both_of_them_gamer = true WHERE fb_id2 = " . (int) $fb_id;
        $this->db->query($sql);
    }

}
