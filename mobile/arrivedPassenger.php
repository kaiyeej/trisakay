<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

// //$data = json_decode(file_get_contents("php://input"));

$transaction_id = $_REQUEST['transaction_id'];
$response_array['array_data'] = array();

$response = array();
$result = $mysqli_connect->query("UPDATE `tbl_transactions` SET `status`='F' WHERE transaction_id='$transaction_id'");
$fetch = $mysqli_connect->query("SELECT user_id FROM tbl_transactions WHERE transaction_id='$transaction_id'");
$data = $fetch->fetch_array();

if ($result) {
    sendNotif($data[0], "Trisakay", "Driver successfully brought you to your destination. Thank you!");
    $response["response"] = 1;
} else {
    $response["response"] = 0;
}

array_push($response_array['array_data'], $response);
echo json_encode($response_array);
