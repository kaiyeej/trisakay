<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

// //$data = json_decode(file_get_contents("php://input"));
$transaction_id = $_REQUEST['transaction_id'];
$driver_id = $_REQUEST['driver_id'];

$response_array['array_data'] = array();
$fetch1 = $mysqli_connect->query("SELECT count(status) as `counter` FROM tbl_transactions WHERE driver_id='$driver_id' AND status='A'");
$data1= $fetch1->fetch_array();
if($data1['counter'] != 1){
    $result = $mysqli_connect->query("UPDATE `tbl_transactions` SET `status`='A' WHERE `transaction_id`='$transaction_id'");

    if ($result) {
        $fetch = $mysqli_connect->query("SELECT user_id FROM tbl_transactions WHERE transaction_id='$transaction_id'");
    $data = $fetch->fetch_array();
        sendNotif($data[0], 'Awesome!', 'Your driver accepted your book.');
        
        $response["res"] = 1;
    } else {
        $response["res"] = 0;
    }
}else{
    $response["res"] = $data1['counter'].'fdsfsf';
}








array_push($response_array['array_data'], $response);
echo json_encode($response_array);
