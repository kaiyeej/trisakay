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
$fetch = $mysqli_connect->query("SELECT * FROM tbl_transactions WHERE transaction_id='8'");
while ($row = $fetch->fetch_array()) {
    $response = array();
    $response["transaction_id"] = $row['transaction_id'];
    $response["start_point"] = $row['start_point'];
    $response["end_point"] = $row['end_point'];
    // $response["status"] = getTransactionStatus($user_id, $row['user_id']);
    $response["u_latitude"] = getUserLocation($row['user_id']);
    $response["u_longitude"] = getUserLocation($row['user_id']);


    array_push($response_array['array_data'], $response);
}


echo json_encode($response_array);
