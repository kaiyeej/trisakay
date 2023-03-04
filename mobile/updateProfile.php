<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';
$response_array['array_data'] = array();
$user_id = $_REQUEST['user_id'];
$user_fname = $_REQUEST['fname'];
$user_mname = $_REQUEST['mname'];
$user_lname = $_REQUEST['lname'];
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$no_image = $_REQUEST['no_image'];
if ($no_image == 1) {
    $name = $_FILES['file']['name'];
    $type = $_FILES['file']['type'];
    $size = $_FILES['file']['size'];

    $id_name = $_FILES['upload_id']['name'];
    $id_type = $_FILES['upload_id']['type'];
    $id_size = $_FILES['upload_id']['size'];

    if ($password == "") {
        $password_query = "";
    } else {
        $password_query = ",`password`=md5('$password')";
    }
    $img_name = $name;
    $directory = "../assets/uploads/" . $name;

    $id_img_name = $id_name;
    $id_directory = "../assets/uploads/" . $id_name;





    if (move_uploaded_file($_FILES["file"]["tmp_name"], $directory) && move_uploaded_file($_FILES["upload_id"]["tmp_name"], $id_directory)) {
        $result = $mysqli_connect->query("UPDATE `tbl_users` SET `user_fname`='$user_fname',`user_mname`='$user_mname',`user_lname`='$user_lname',`username`='$username',`user_img`='$img_name',`valid_id_img`='$id_img_name' $password_query  WHERE `user_id`='$user_id'");
        if ($result) {
            $response["res"] = 1;
        } else {
            $response["res"] = 0;
        }
    } else {
        $response["res"] = 0;
    }
} else {
    $name = $_FILES['file']['name'];
    $type = $_FILES['file']['type'];
    $size = $_FILES['file']['size'];


    if ($password == "") {
        $password_query = "";
    } else {
        $password_query = ",`password`=md5('$password')";
    }
    $img_name = $name;
    $directory = "../assets/uploads/" . $name;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $directory)) {
        $result = $mysqli_connect->query("UPDATE `tbl_users` SET `user_fname`='$user_fname',`user_mname`='$user_mname',`user_lname`='$user_lname',`username`='$username',`user_img`='$img_name' $password_query  WHERE `user_id`='$user_id'");
        if ($result) {
            $response["res"] = 1;
        } else {
            $response["res"] = 0;
        }
    } else {
        $response["res"] = 0;
    }
}
// $response["res"] = $user_id;
array_push($response_array['array_data'], $response);
echo json_encode($response_array);
