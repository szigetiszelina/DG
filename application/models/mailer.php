<?php

class Mailer extends CI_Model {
   public function send_email($recipient, $subject, $body, $sender=null){
        require_once("/../libraries/class.phpmailer.php");
        $mail = new PHPMailer();
         
        //Indicate to phpmailer where is the smtp
        $mail->PluginDir = "";        
        //We will use smtp
        $mail->Mailer = "smtp";         
        //Our server smtp. The encryption is ssl ssl://
        $mail->Host = "smtp.gmail.com";         
        //Port of gmail 465
        $mail->Port="587";         
        //Smtp requires authentication
        $mail->SMTPAuth = true;         
        //Our username and password
        $mail->Username = "board.game.ideas@gmail.com";
        $mail->Password = "33ew4FHG";
         
        //Our email address and the name which will be displayed
        $mail->From = "Board Game Ideas";
        $mail->FromName = "Board Game Ideas";
         
        //The dafault value of Timeout is 10, we give a little more
        $mail->Timeout=30;
        $mail->CharSet="utf-8"; 
        //Indicates the receiver email
        $mail->AddAddress(trim($recipient));      
        $mail->Subject = $subject;
        $mail->Body = $body;       
        //If dont supports html
        $mail->AltBody = "Only text";              
        return $mail->Send();
    }

}