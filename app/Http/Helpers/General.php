<?php

function sendnotification($token, $title, $message)
{
    ini_set("allow_url_fopen", "On");
    $msg = array(
        "body" => $message,
        "title" => $title,
        'vibrate' => 1,
        'sound' => 1,
    );

    $fields = array(
        'to' =>$token,
        'notification' => $msg
    );

    $headers = array(
        'Authorization: key=AIzaSyAASHFgGsokPJoM-6hwk4rqVk9Xjc_px_U',
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    curl_close($ch);
}
