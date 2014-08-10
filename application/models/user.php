<?php 

class User extends CI_Model {
    
    public function user_exists($fb_id){
        $sql = "SELECT count(*) as count FROM users WHERE fb_id=".$fb_id;
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return (($result['count']>0)?true:false);
    }
    
    public function add_user($datas){
        $sql = "INSERT INTO users (fb_id, name, nick_name, email, birthday, 
                                   profil_image, gender, location, last_login, first_login) 
                VALUES(".$datas['fb_id'].", '".$datas['name']."','".$datas['nickname']."', 
                       '".$datas['email']."', '".$datas['birthday']."', 
                       '".$datas['profil_image']."', '".$datas['gender']."', 
                       '".$datas['location']."', NOW(), NOW())";
        $this->db->query($sql);
    }
    
    public function update_last_login($fb_id){
        $sql = "UPDATE users SET last_login = NOW() WHERE fb_id=".$fb_id;
        $this->db->query($sql);
    }
    
    public function get_user($fb_id){
        $sql = "SELECT * FROM users WHERE fb_id=".$fb_id;
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function userdata_synchronize($new_datas){
        $user_datas = $this->get_user($new_datas['fb_id']);
        $modified_datas = array();
        foreach($new_datas as $key => $data){
            if($data != $user_datas[$key]){
                $modified_datas [] = array("key" => $key, "value" => $data);
            }
        }
        if(!empty($modified_datas)){
            $this->mod_user($user_datas['id'],$modified_datas);
        }
    }
    
    public function mod_user($id,$datas){
        if((int)$id > 0 && !empty($datas)){
            $sql = "UPDATE users SET ";
            foreach($datas as $data){
                $sql.= $data['key']." = '".$data['value']."' ";
            }
            $sql.= " WHERE id = ".(int)$id;
            $this->db->query($sql);
        }
    }
}
