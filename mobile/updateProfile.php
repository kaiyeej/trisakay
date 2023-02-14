<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

$user_id = $_REQUEST['user_id'];
$user_fname = $_REQUEST['fname'];
$user_mname = $_REQUEST['mname'];
$user_lname = $_REQUEST['lname'];
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$name = $_FILES['file']['name'];
$type = $_FILES['file']['type'];
$size = $_FILES['file']['size'];
$response_array['array_data'] = array();


if ($password == "") {
    $password_query = "";
} else {
    $password_query = ",`password`=md5('$password')";
}
$img_name = $name . '.jpg';
$directory = "../assets/uploads/" . $name . '.jpg';
$result = $mysqli_connect->query("UPDATE `tbl_users` SET `user_fname`='$user_fname',`user_mname`='$user_mname',`user_lname`='$user_lname',`username`='$username',`user_img`='$img_name' $password_query  WHERE `user_id`='$user_id'");

if ($result) {

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $directory)) {
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
