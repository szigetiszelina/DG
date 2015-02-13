<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

    public function index(){
         redirect('/auth/login');
    }
    
    public function login(){
        //Comprobate if the user request a strategy
        if($this->uri->segment(3)==''){
            $ci_config = $this->config->item('opauth_config');
            redirect("/auth/login/facebook");
        }   
        else{
            //Run login
            $this->load->library('Opauth/Opauth', $this->config->item('opauth_config'), true);
        }        
    }
    
    public function transform_opauth_datas($datas){
        $response = unserialize(base64_decode( $datas['opauth'] ));
        if(!empty($response['error'])){
            return null;
        } else {
            $response = $response['auth'];
            $user['fb_id'] = $response['raw']['id'];
            $user['name'] = $response['info']['first_name'].' '.$response['info']['last_name'];
            $user['nick_name'] = $response['info']['nickname'];
            $user['email'] = $response['raw']['email'];
            $user['birthday'] = date('Y-m-d',strtotime($response['raw']['birthday']));
            $user['profil_image'] = $response['info']['image'];
            $user['gender'] = $response['raw']['gender'];
            $user['location'] = $response['raw']['location']['name'];
            $user['friends'] = array();
            foreach ($response['info']['friendlists']['data'] as $friend){
                $user['friends'][] = $friend['id'];
            }
            return array('user' => $user, 'token' => $response['credentials']['token']);
        }        
    }
    
    public function authenticate(){
        $opauth_data = $this->transform_opauth_datas($_POST);
        $user_datas = $opauth_data['user'];
        if($user_datas !== null){
            $this->load->model('User');       
            $user = new User();
            if(!$user->user_exists($user_datas['fb_id'])){
                $user->add_user($user_datas);
            } else{
                $user->userdata_synchronize($user_datas);
            }
            $this->save_user_to_session($user_datas['fb_id'], $opauth_data['token']);
            redirect('index');
        } else {
            //Kérjük engedélyezd a hozzáférést az adataidhoz...
        }
    }
    
    public function save_user_to_session($fb_id, $access_token){
        $user = new User();
        $this->session->set_userdata('user', $user->get_user($fb_id));
        $this->session->set_userdata('login_status', TRUE);
        $this->session->set_userdata('token', $access_token);
        $user->update_last_login($fb_id);
    }
    
    public function logout(){
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('login_status');
        redirect('index');
    }

}