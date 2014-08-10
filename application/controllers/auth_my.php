<?php

class Auth extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function login() {
        $data = array('message' =>'');
        //$this->load->view('index');
        if(isset($_COOKIE["username"]) && isset($_COOKIE["password"])){
          if(($_COOKIE["username"]) == $_POST["email"] && $_COOKIE['password'] == md5($_POST["password"])){
          echo 'Üdvözlet '.$_COOKIE['username'];

          $_SESSION["login"]=true;
          $query = $this->db->query("SELECT * FROM users WHERE email=" . $this->db->escape($_POST["email"]));
          $_SESSION["user"]=$query -> row_array();
          var_dump($_SESSION['user']);
          }else {
          echo "Hibás adatok!";
          }
        }else{
        if (isset($_POST["login"])) {
            
            if ($_POST["email"] != '' && $_POST["password"] != '') {
                $query = $this->db->query("SELECT * FROM users WHERE email=" . $this->db->escape($_POST["email"]));
                $user_datas = $query -> row_array();
                if ($query->num_rows() == 0) {
                    $data['message'] = "Még nem regisztráltál!";
                } else if ($user_datas['email'] != $_POST["email"]) {
                    $data['message'] = "Hibás e-mail cím!";
                } else if ($user_datas['password'] != $_POST["password"]) {
                    $data['message'] = "Hibás jelszó! Ha elfelejtetted a jelszavad kattints <a href=\"password_modositas.php\">ide<a>!";
                } else {
                    if($user_datas['active']){
                        $_SESSION["login"] = true;
                        $_SESSION["user"] = $user_datas['id'];
                        if (isset($_POST['maradjak_bejelentkezve'])) {
                            setcookie('username', $_POST['email'], time() + 3600 * 24);
                            setcookie('password', md5($_POST['password']), time() + 60 * 60 * 24);
                        } else {
                            setcookie('username', $_POST['email'], time() - 3600);
                            setcookie('password', md5($_POST['password']), time() - 3600);
                        }
                    }else{
                      $data['message'] = "A regisztráció jóváhagyásához kérjük, kattintson a linkre, amit a megadott e-mailcímre küldött üzenetben talál!";  
                    }
                }
            } else{
                $data['message'] = "Mindkét adat megadása szükséges!";
            }
        }
        }
        $this->load->view("hompage",$data);
    }
    
    public function logout(){
        unset($_SESSION['login']);
        unset($_SESSION["user"]);
    }

    public function registration() {
        //$this->load->view('registration');        
        $code = $this->randompassword(100);
        $this->load->model('Email');
        $email = Email::is_realy_email($_POST['email']);
        $password=mysql_real_escape_string($_POST['password']);
        $confirm_password=mysql_real_escape_string($_POST['conf_password']);
        
        if($email && ($password==$confirm_password)){
            $registrated=$this->db->query("SELECT * FROM users WHERE email='".$email."'");
            if($registrated->num_rows()==0){ 
                $subject = "Regisztráció jóváhagyása";
                $body="Board Game Ideas -ra a következő adatokkal regisztráltak : <br/>\r\n";
                $body="e-mail: ".$_POST["email"]."<br/> \r\n";
                $body="jelszó: ".$_POST["password"]." <br/>\r\n";
                $body.="Amennyiben Ön regisztrált kérem kattintson ide: \r\n<br/>\r\n";
                $body.="<a href='".$config['base_url']."/auth/registration_confirmation?code=$code'>Jóváhagy</a><br/>";
                $body.="Ellenben törölje a regisztrációs igényt:<br/> \r\n";
                $body.="<a href='".$config['base_url']."/auth/registration_delete?code=$code'>Töröl</a>";
                $this->load->model('Mailer');
                $mailer = new Mailer();
                $success=$mailer->send_email($email,$subject,$body);      
                
                if($success) {
                   $this->db->query("INSERT INTO users(email, password, user_name, first_name, last_name, active, confirm_code) VALUES(".$this->db->escape($_POST["email"]).", ".$this->db->escape($_POST["password"]).", ".$this->db->escape($_POST["user_name"]).", ".$this->db->escape($_POST["first_name"]).", ".$this->db->escape($_POST["last_name"]).", 0, '".$code."' ) ");
                   echo "A regisztráció jóváhagyásához kérjük, kattintson a linkre, amit a megadott e-mailcímre küldött üzenetben talál!";
                }
                else echo "Nem tudtunk levelet küldeni Önnek! Kérjük ellenőrizze az e-mail címet, majd próbálja újra!";
           } else {
               $reg_datas = $registrated->row_array();
               if($reg_datas['active']) {
                    echo "Ön már regisztrált! Ha módosítani szeretné adatait kattintson <a href='adatmódosítás:'>ide</a>";
               }else {
                   echo "Ön már elindított egy regisztrációt. Kérjük kattintson az email-ben levő linkre.";
               }
           }      
        } else {
            if(!$email){
                echo "Hibás e-mail cím! Próbáld újra!";
            }
            if($password!=$confirm_password){
                echo "Eltérő jelszók, kérlek add meg újra.";
            }
        }   
}

    private function randompassword( $passwordlength ) {  
        $password = "";  
        for ($index = 1; $index <= $passwordlength; $index++) {  
        // Pick random number between 1 and 62  
        $randomnumber = rand(1, 62);  

        // Select random character based on mapping.  
        if ($randomnumber < 11)  
        $password .= Chr($randomnumber + 48 - 1); // [ 1,10] => [0,9]  
        else if ($randomnumber < 37)  
        $password .= Chr($randomnumber + 65 - 11); // [11,36] => [A,Z]  
        else  
        $password .= Chr($randomnumber + 97 - 37); // [37,62] => [a,z]  
        }  
        return $password;  
    }

    public function registration_confirmation(){
        $code=$_GET['code'];
        $query=$this->db->query("SELECT * FROM users WHERE confirm_code='".$code."'");
        $result=$query->row_array();
        $this->db->query("UPDATE users SET active=1, activate_date=NOW() WHERE id=".$result["id"]);
        $_SESSION["login"] = true;
        $_SESSION["user"] = $result;
        $this->load->view("hompage",$data);
    }
    
    public function registration_delete(){
        $code=$_GET['code'];
        $this->db->query("DELETE FROM users WHERE confirm_code='".$code."'");
        redirect('/index');
    }

}