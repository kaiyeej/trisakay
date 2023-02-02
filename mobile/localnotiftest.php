<?php
require_once '../core_mobile/config.php';
$ch = curl_init();


$tokens = array("<DEVICE TOKEN>", "<DEVICE TOKEN>");

//Title of the Notification.
$title = "Title";

//Body of the Notification.
$body = "Test";

//Creating the notification array.
$notification = array('title' =>$title , 'text' => $body);

//This array contains, the token and the notification. The 'to' attribute stores the token.
$arrayToSend = array('registration_ids' => $tokens, 'notification' => $notification,'priority'=>'high');

//Generating JSON encoded string form the above array.
$json = json_encode($arrayToSend);
//Setup headers:
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: key= <API_KEY>'; // key here

//Setup curl, add headers and post parameters.
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
//Send the request
$response = curl_exec($ch);

//Close request
curl_close($ch);

echo $response;
