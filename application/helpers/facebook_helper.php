<?php

function facebook($data) {

    $CI = & get_instance();
    $token = $data['fb_id'];

    $attachment = array(
        'access_token' => $data['access_token'],
        'message' => $data['message'],
        'link' => $data['link'],
        'picture' => $data['picture'],
        'name' => 'Német Nyelvgyakorló - Deutsche Grammar',
        'privacy' => "{'value' : 'SELF'}"
    );

    $ch = curl_init('https://graph.facebook.com/' . $token . '/feed');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $attachment);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
}