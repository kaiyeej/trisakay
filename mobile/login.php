<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->username) && isset($data->password)) {
	$username = $mysqli_connect->real_escape_string($data->username);
	$password = $mysqli_connect->real_escape_string($data->password);

	// count users
	$fetch_users = $mysqli_connect->query("SELECT count(user_id), user_id from tbl_users where username='$username' and password=md5('$password')");
	$count_users = $fetch_users->fetch_array();
	if ($count_users[0] == 0) {
		// cannot find account
		echo -1;
	} else {
		echo $count_users[1];
	}
}
