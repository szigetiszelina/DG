<?php

class Email extends CI_Model {
    static function is_realy_email($email = "") {         
        if (preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $email)){
            return $email;            
        }
        else {
            return false; 
        }
    }
}