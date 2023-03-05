<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

// //$data = json_decode(file_get_contents("php://input"));
$user_id = $_REQUEST['user_id']; // session
$response_array['array_data'] = array();
$fetch = $mysqli_connect->query("SELECT * FROM tbl_users WHERE category='D' AND latitude != 0 AND longitude != 0 AND `status`='1' and `active_status`='1'");
while ($row = $fetch->fetch_array()) {
	$response = array();
	$distance = getDistance($row['latitude'],  $row['longitude'], getUserLocation($user_id)['latitude'], getUserLocation($user_id)['longitude'], 1000);
	$response["user_id"] = $row['user_id'];
	$response['fullname'] = $row['user_fname'] . " " . $row['user_lname'];
	$response["ratings"] = getRatingFunc($row['user_id']);
	$response['image'] = $row['user_img'] == "" ? 'profile.jpg' : $row['user_img'];
	$response["latitude"] = $row['latitude'];
	$response["longitude"] = $row['longitude'];
	$response["session_id"] = $user_id;
	$response["distance_status"] = $distance;
	$response["status"] = getTransactionStatus($user_id, $row['user_id']);



	array_push($response_array['array_data'], $response);
}


echo json_encode($response_array);
