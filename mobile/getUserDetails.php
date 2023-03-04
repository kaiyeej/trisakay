<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

// //$data = json_decode(file_get_contents("php://input"));
$user_id = $_REQUEST['user_id'];

$response_array['array_data'] = array();

$fetch_users = $mysqli_connect->query("SELECT* FROM tbl_users WHERE user_id='$user_id'");
$data = $fetch_users->fetch_array();

$response = array();

$response["user_id"] = $data['user_id'];
$response["user_fname"] = $data['user_fname'];
$response["user_mname"] = $data['user_mname'];
$response["user_lname"] = $data['user_lname'];
$response["user_img"] = $data['user_img'];
$response["category"] = $data['category'];
$response["username"] = $data['username'];
$response["license_number"] = $data['license_number'];
$response["toda_id"] = $data['toda_id'];
$response["franchise_permit"] = $data['franchise_permit'];
$response["or_img"] = $data['or_img'];
$response["cr_img"] = $data['cr_img'];
$response["vehicle_img"] = $data['vehicle_img'];
$response["plate_number"] = $data['plate_number'];
$response["manufacturer"] = $data['manufacturer'];
$response["model"] = $data['model'];
$response["year"] = $data['year'];
$response["color"] = $data['color'];
$response["valid_id_img"] = $data['valid_id_img'];
array_push($response_array['array_data'], $response);
echo json_encode($response_array);
