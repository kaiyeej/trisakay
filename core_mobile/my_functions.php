<?php

function getCurrentDate()
{
	ini_set('date.timezone', 'UTC');
	//error_reporting(E_ALL);
	date_default_timezone_set('UTC');
	$today = date('H:i:s');
	$system_date = date('Y-m-d H:i:s', strtotime($today) + 28800);
	return $system_date;
}
function getRefNumTransaction()
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT ref_number FROM tbl_transactions");
	$row = $fetch->fetch_array();
	if (empty($row[0])) {
		$ref = 0;
	} else {
		$ref = $row[0];
	}
	return $ref;
}
function getTransactionStatus($user_id, $driver_id)
{
	global $mysqli_connect;
	$fetch = $mysqli_connect->query("SELECT * FROM tbl_transactions WHERE user_id='$user_id' AND driver_id='$driver_id' AND STATUS = 'A'");
	if ($fetch->num_rows > 0) {
		$status = 1;
	} else {
		$status = 0;
	}
	return $status;
}
