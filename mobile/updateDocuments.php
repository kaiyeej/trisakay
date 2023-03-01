<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

$user_id = $_REQUEST['user_id'];
$license_number = $_REQUEST['license_number'];
$plate_number = $_REQUEST['plate_number'];
$manufacturer = $_REQUEST['manufacturer'];
$model = $_REQUEST['model'];
$year = $_REQUEST['year'];
$color = $_REQUEST['color'];

$imageStatus = $_REQUEST['imageStatus'];


$toda_name = $_FILES['toda']['name'];
$toda_type = $_FILES['toda']['type'];

$franchise_name = $_FILES['franchise']['name'];
$franchise_type = $_FILES['franchise']['type'];

$or_name = $_FILES['or']['name'];
$or_type = $_FILES['or']['type'];

$cr_name = $_FILES['cr']['name'];
$cr_type = $_FILES['cr']['type'];

$vehicle_name = $_FILES['vehicle']['name'];
$vehicle_type = $_FILES['vehicle']['type'];
$response_array['array_data'] = array();


$toda_img_name = $toda_name;
$franchise_img_name = $franchise_name;
$or_img_name = $or_name;
$cr_img_name = $cr_name;
$vehicle_img_name = $vehicle_name;
$toda_directory = "../assets/upload_documents/" . $toda_img_name;
$franchise_directory = "../assets/upload_documents/" . $franchise_img_name;
$or_directory = "../assets/upload_documents/" . $or_img_name;
$cr_directory = "../assets/upload_documents/" . $cr_img_name;
$vehicle_directory = "../assets/upload_documents/" . $vehicle_img_name;


$result = $mysqli_connect->query("UPDATE `tbl_users` SET `license_number`='$license_number',`toda_id`='$toda_img_name',`franchise_permit`='$franchise_img_name',`or_img`='$or_img_name ',`cr_img`='$cr_img_name', `vehicle_img`='$vehicle_img_name',`plate_number`='$plate_number',`manufacturer`='$manufacturer',`model`='$model',`year`='$year',`color`='$color' WHERE `user_id`='$user_id'");

if ($result) {

    if (move_uploaded_file($_FILES["toda"]["tmp_name"], $toda_directory) && move_uploaded_file($_FILES["franchise"]["tmp_name"], $franchise_directory) && move_uploaded_file($_FILES["or"]["tmp_name"], $or_directory) && move_uploaded_file($_FILES["cr"]["tmp_name"], $cr_directory) && move_uploaded_file($_FILES["vehicle"]["tmp_name"], $vehicle_directory)) {
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
