<?php

function getCurrentDate()
{
	ini_set('date.timezone', 'UTC');
	//error_reporting(E_ALL);
	date_default_timezone_set('UTC');
	$today = date('H:i:s');
	$system_date = date('Y-m-d H:i:s', strtotime($today) + 28800);
	return $system_date;
}
function getRefNumTransaction()
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT ref_number FROM tbl_transactions");
	$row = $fetch->fetch_array();
	if (empty($row[0])) {
		$ref = 0;
	} else {
		$ref = $row[0];
	}
	return $ref;
}
function getTransactionStatus($user_id, $driver_id)
{
	global $mysqli_connect;
	$fetch = $mysqli_connect->query("SELECT * FROM tbl_transactions WHERE user_id='$user_id' AND driver_id='$driver_id' AND STATUS = 'A'");
	if ($fetch->num_rows > 0) {
		$status = 1;
	} else {
		$status = 0;
	}
	return $status;
}
function getUserName($id)
{
	global $mysqli_connect;
	$fetch = $mysqli_connect->query("SELECT * FROM tbl_users WHERE user_id='$id'");
	$data = $fetch->fetch_array();
	return $data['user_fname'] . " " . $data['user_lname'];
}
function sendNotif($user_id, $title, $body)
{

	global $mysqli_connect;

	$url = 'https://fcm.googleapis.com/fcm/send';

	$getToken = $mysqli_connect->query("SELECT idtoken FROM `tbl_users` WHERE `user_id` = '$user_id'");
	$idtoken = $getToken->fetch_array();

	$tokens = array($idtoken[0], "");

	//Title of the Notification.
	//$title = "Title";

	//Body of the Notification.
	//$body = "Test";

	//Creating the notification array.
	$notification = array('title' => $title, 'text' => $body);

	//This array contains, the token and the notification. The 'to' attribute stores the token.
	$arrayToSend = array('registration_ids' => $tokens, 'notification' => $notification, 'priority' => 'high');

	//Generating JSON encoded string form the above array.
	$json = json_encode($arrayToSend);
	//Setup headers:
	$headers = array();
	$headers[] = 'Content-Type: application/json';
	$headers[] = 'Authorization: key=AIzaSyCKZCvZhkA_ZZz-axP6fPABrtdxv9syRX0'; // key here

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	//Send the request
	$response = curl_exec($ch);

	//Close request
	curl_close($ch);
	return $response;
}
function getUserLocation($id)
{
	global $mysqli_connect;
	$fetch = $mysqli_connect->query("SELECT latitude,longitude FROM tbl_users WHERE user_id='$id'");
	$data = $fetch->fetch_array();
	return $data;
}
