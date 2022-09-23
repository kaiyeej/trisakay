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
		$ref = 1;
	} else {
		$ref = $row[0];
	}
	return $ref;
}
