<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

$user_id = $_REQUEST['user_id'];
$license_number = $_REQUEST['license_number'];

$toda_name = $_FILES['toda']['name'];
$toda_type = $_FILES['toda']['type'];

$franchise_name = $_FILES['franchise']['name'];
$franchise_type = $_FILES['franchise']['type'];
$response_array['array_data'] = array();


$toda_img_name = $toda_name . '.jpg';
$franchise_img_name = $franchise_name . '.jpg';
$toda_directory = "../assets/upload_documents/" . $toda_img_name . '.jpg';
$franchise_directory = "../assets/upload_documents/" . $franchise_img_name . '.jpg';
$result = $mysqli_connect->query("UPDATE `tbl_users` SET `license_number`='$license_number',`toda_id`='$toda_img_name',`franchise_permit`='$franchise_img_name' WHERE `user_id`='$user_id'");

if ($result) {

    if (move_uploaded_file($_FILES["toda"]["tmp_name"], $toda_directory) && move_uploaded_file($_FILES["franchise"]["tmp_name"], $franchise_directory)) {
        $response["res"] = 1;
    } else {
        $response["res"] = 0;
    }
} else {
    $response["res"] = 0;
}
// $response["res"] = $user_id;
array_push($response_array['array_data'], $response);
echo json_encode($response_array);
