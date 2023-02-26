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
$fetch_trans = $mysqli_connect->query("SELECT * FROM tbl_transactions WHERE transaction_id='$transaction_id'");
// $row_trans = $fetch_trans->fetch_array();
// $count = $fetch_trans->num_rows;
// if ($count > 0) {
//     $response["response"] = 1;
// } else {
//     $response["response"] = 0;
// }

while ($row = $fetch_trans->fetch_array()) {
    $response = array();
    $ex = explode('.', $row['total_distance']);
    $response["transaction_id"] = $row['transaction_id'];
    $response["ref_number"] = $row['ref_number'];
    $response["user_id"] = $row['user_id'];
    $response["user_fullname"] = getUserName($row['user_id']);
    $response["driver_id"] = $row['driver_id'];
    $response["starting_point"] = $row['starting_point'];
    $response["end_point"] = $row['end_point'];
    $response["amount"] = $row['amount'];
    $response["status"] = $row['status'];
    $response["remarks"] = $row['remarks'];
    $response["date_added"] = $row['date_added'];
    $response["image"] = getUserImage($row['user_id']);
    $response["distance"] = $ex[0] . $ex[1];
    $response["fuel"] = $row['fuel_consumption'];
    array_push($response_array['array_data'], $response);
}
array_push($response_array['array_data'], $response);
echo json_encode($response_array);
