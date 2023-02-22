<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

// //$data = json_decode(file_get_contents("php://input"));
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$latitude = $_REQUEST['latitude'];
$longitude = $_REQUEST['longitude'];
$id_token = $_REQUEST['idtoken'];
$response_array['array_data'] = array();
// if (isset($username) && isset($password)) {
$fetch_users = $mysqli_connect->query("SELECT count(user_id) as ctr, user_id,category FROM tbl_users where username='$username' AND password=md5('$password') AND category!='A'");
$count_users = $fetch_users->fetch_array();
if ($id_token == "" || $id_token == null) {
    $result_id_token = false;
} else {
    $result_id_token = $mysqli_connect->query("UPDATE `tbl_users` SET `id_token`='$id_token', `latitude`='$latitude', `longitude`='$longitude' WHERE `user_id`='$count_users[user_id]'");
}

$response = array();
if ($count_users['category'] == 'U') {
    $getUser = $mysqli_connect->query("SELECT * FROM tbl_users WHERE user_id='$count_users[user_id]'");
    $data = $getUser->fetch_array();

    if ($result_id_token) {
        $response["user_fname"] = $data['user_fname'];
        $response["user_lname"] = $data['user_lname'];
        $response["contact_number"] = $data['contact_number'];
        $response["category"] = $data['category'];
        $response["username"] = $data['username'];
        $response["user_id"] = $data['user_id'];
        $response["response"] = 1;
    } else {
        $response["response"] = 0;
    }
} else if ($count_users['category'] == 'D') {
    $getUser = $mysqli_connect->query("SELECT * FROM tbl_users WHERE user_id='$count_users[user_id]'");
    $data = $getUser->fetch_array();

    if ($result_id_token) {
        $response["user_fname"] = $data['user_fname'];
        $response["user_lname"] = $data['user_lname'];
        $response["contact_number"] = $data['contact_number'];
        $response["category"] = $data['category'];
        $response["username"] = $data['username'];
        $response["user_id"] = $data['user_id'];
        $response["response"] = 2;
    } else {
        $response["response"] = 0;
    }
} else {
    $response["response"] = -1;
}

array_push($response_array['array_data'], $response);
echo json_encode($response_array);
