<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

// //$data = json_decode(file_get_contents("php://input"));
$distance = $_REQUEST['distance'] * 1000; // session
$response_array['array_data'] = array();
$fetch = $mysqli_connect->query("SELECT fare_amount, count(fare_matrix_id) as counter FROM tbl_fare_matrix WHERE start_distance <= '$distance' AND end_distance >='$distance'");
$row = $fetch->fetch_array();
$response = array();
if ($row['counter'] > 0) {
    $response["fare_amount"] = $row['fare_amount'];
} else {
    $response["fare_amount"] = 0.00;
}





array_push($response_array['array_data'], $response);



echo json_encode($response_array);
