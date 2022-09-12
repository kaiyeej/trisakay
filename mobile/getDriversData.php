<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

// //$data = json_decode(file_get_contents("php://input"));

$response_array['array_data'] = array();
$fetch = $mysqli_connect->query("SELECT * FROM tbl_users WHERE category='D'");
while ($row = $fetch->fetch_array()) {
	$response = array();
	$response["user_id"] = $row['user_id'];
	$response['fullname'] = $row['user_fname'] . " " . $row['user_lname'];
	$response["ratings"] = 5;
	$response['image'] = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBwgu1A5zgPSvfE83nurkuzNEoXs9DMNr8Ww&usqp=CAU";

	array_push($response_array['array_data'], $response);
}


echo json_encode($response_array);
