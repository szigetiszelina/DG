<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

    public function index(){
         redirect('/auth/login');
    }
    
    public function login(){
        //Comprobate if the user request a strategy
        if($this->uri->segment(3)==''){
            $ci_config = $this->config->item('opauth_config');
            /*$arr_strategies = array_keys($ci_config['Strategy']);
            
            echo("Please, select an Oauth provider:<br />");
            echo("<ul>");
            foreach($arr_strategies AS $strategy){
                echo("<li><a href='".base_url()."auth/login/".strtolower($strategy)."'>Login with ".$strategy."</li>");
            }
            echo("</ul>");*/
            redirect("/auth/login/facebook");
        }   
        else{
            //Run login
            $this->load->library('Opauth/Opauth', $this->config->item('opauth_config'), true);
           //$this->opauth->run();   
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
            return $user;
        }        
    }
    
    public function authenticate(){
        $user_datas = $this->transform_opauth_datas($_POST);          
        if($user_datas !== null){
            $this->load->model('User');       
            $user = new User();
            if(!$user->user_exists($user_datas['fb_id'])){
                $user->add_user($user_datas);
            } else{
                $user->userdata_synchronize($user_datas);
            }
            $this->save_user_to_session($user_datas['fb_id']);
            redirect('index');
        } else {
            //Kérjük engedélyezd a hozzáférést az adataidhoz...
        }
    }
    
    public function save_user_to_session($fb_id){
        $user = new User();
        $this->session->set_userdata('user', $user->get_user($fb_id));
        $this->session->set_userdata('login_status', TRUE);
        $user->update_last_login($fb_id);
    }
    
    public function logout(){
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('login_status');
        redirect('index');
    }

}