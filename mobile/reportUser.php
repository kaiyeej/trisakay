<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

// //$data = json_decode(file_get_contents("php://input"));
// $user_id = $_REQUEST['user_id'];
$transaction_id = $_REQUEST['transaction_id'];
$comments = $_REQUEST['comments'];
$response_array['array_data'] = array();


$result = $mysqli_connect->query("UPDATE tbl_transactions SET driver_remarks='$comments' WHERE  transaction_id='$transaction_id'");

$response = array();
if ($result) {
    $response['response'] =  1;
} else {
    $response['response'] =  0;
}

array_push($response_array['array_data'], $response);



echo json_encode($response_array);
