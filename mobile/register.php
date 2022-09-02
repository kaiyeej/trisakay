<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

$fname = $_REQUEST['fname'];
$mname = $_REQUEST['mname'];
$lname = $_REQUEST['lname'];
$address = $_REQUEST['address'];
$contactNumber = $_REQUEST['contactNumber'];
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
if (isset($data->username) && isset($data->password)) {


	$fetch_rows = $mysqli_connect->query("SELECT COUNT(user_id) AS counter from tbl_users WHERE user_fname='$u_fname' AND user_mname='$u_mname' AND user_lname='$u_lname'");
	$user_row = $fetch_rows->fetch_array();

	if ($user_row['counter'] == 0) {

		$sql = $mysqli_connect->query("INSERT INTO tbl_users (`user_fname`, `user_mname`, `user_lname`, `gender`, `address`, `contact_number`, `category`, `username`, `password`, `date_added`) VALUES ('$u_fname', '$u_mname', '$u_lname', '$u_gender', '$u_address', '$u_contact_num', 'U', '$username', md5('$password'), '$date')");

		if ($sql) {
			echo $mysqli_connect->insert_id;
		} else {
			echo 0;
		}
	} else {
		// user not in database
		echo -2;
	}
	// echo $u_fname;
}
