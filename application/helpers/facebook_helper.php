<?php

function facebook($data) {

    $CI = & get_instance();

    //$CI->load->model('fk_model');

    $token = "100001427136921";

    $attachment = array(
        'access_token' => $data['access_token'],
        'message' => $data['message'],
        'link' => $data['link'],
    );
   
    $ch = curl_init('https://graph.facebook.com/' . $token . '/feed');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $attachment);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output
    $result = curl_exec($ch);
    var_dump($result);die();
   // curl_close($ch);
}