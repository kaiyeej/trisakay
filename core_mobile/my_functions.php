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

function getUser($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT * from tbl_users where user_id='$id' ");
	$row = $fetch->fetch_array();
	$user_name = $row['user_fname'] . ' ' . $row['user_mname'] . ' ' . $row['user_lname'];

	return $user_name;
}

function getResident($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT * from tbl_resident_profile where r_id='$id' ");
	$row = $fetch->fetch_array();
	$resident_name = $row['r_fname'] . ' ' . $row['r_mname'] . ' ' . $row['r_lname'] . ' ' . $row['r_suffix'];

	return $resident_name;
}


function getPurok($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT r_purok from tbl_resident_profile where r_id='$id' ");
	$row = $fetch->fetch_array();

	return $row[0];
}


function getVaccine($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT * from tbl_vaccines where vaccine_id='$id'");
	$row = $fetch->fetch_array();
	$vaccine_name = $row['vaccine_name'];

	return $vaccine_name;
}


function getVaccineQty($id)
{
	global $mysqli_connect;

	$fetch_in = $mysqli_connect->query("SELECT sum(qty) from tbl_stock_in where vaccine_id='$id'");
	$total_in = $fetch_in->fetch_array();

	$fetch_out = $mysqli_connect->query("SELECT count(vacc_schedule_id) from tbl_vaccination_schedule where vaccine_id='$id' AND status='F'");
	$total_out = $fetch_out->fetch_array();

	return $total_in[0]-$total_out[0];
}

function getVenue($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT * from tbl_vaccination_events where vaccination_event_id='$id'");
	$row = $fetch->fetch_array();
	$vaccine_venue = $row['vaccine_venue'];

	return $vaccine_venue;
}


function getVaccinator($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT * from tbl_vaccinator where vaccinator_id='$id'");
	$row = $fetch->fetch_array();
	$vaccinator_name = $row['vaccinator_name'];

	return $vaccinator_name;
}

function selectResidents()
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT * from tbl_resident_profile ORDER BY r_fname ASC");
	$data = "";
	while ($row = $fetch->fetch_array()) {
		$resident_name = $row['r_fname'] . ' ' . $row['r_mname'] . ' ' . $row['r_lname'] . ' ' . $row['r_suffix'];
		$data .= "<option value='$row[0]'>" . $resident_name . "</option>";
	}

	return $data;
}

function selectVaccines()
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT * from tbl_vaccines ORDER BY vaccine_name ASC");
	$data = "";
	while ($row = $fetch->fetch_array()) {
		$data .= "<option value='$row[0]'>" . $row['vaccine_name'] . "</option>";
	}

	return $data;
}

function selectVaccination()
{
	global $mysqli_connect;

	$today = date('Y-m-d', strtotime(getCurrentDate()));

	$fetch = $mysqli_connect->query("SELECT * from tbl_vaccination_schedule WHERE status='A' GROUP BY r_id ORDER BY schedule_date DESC");
	$data = "";
	while ($row = $fetch->fetch_array()) {
		$sched = date('Y-m-d', strtotime($row['schedule_date']));

		if ($sched == $today) {
			$schedule = "TODAY";
		} else {
			$schedule = date('F d, Y h:m A', strtotime($row['schedule_date']));
		}

		$data .= "<option value='$row[0]'>" . getResident($row['r_id']) . " (" . $schedule . ")</option>";
	}

	return $data;
}

function selectSAP()
{
	global $mysqli_connect;

	$today = date('Y-m-d', strtotime(getCurrentDate()));

	$fetch = $mysqli_connect->query("SELECT * from tbl_sap_details as sd, tbl_sap as s WHERE s.sap_id=sd.sap_id AND sd.status!='1' GROUP BY r_id ORDER BY s.sap_schedule_date DESC");
	$data = "";
	while ($row = $fetch->fetch_array()) {
		$sched = date('Y-m-d', strtotime($row['sap_schedule_date']));

		if ($sched == $today) {
			$schedule = "TODAY";
		} else {
			$schedule = date('F d, Y h:m A', strtotime($row['sap_schedule_date']));
		}

		$data .= "<option value='$row[0]'>" . getResident($row['r_id']) . " (" . $schedule . ")</option>";
	}

	return $data;
}


function sequenceNum($date)
{
	global $mysqli_connect;

	$today = date('Y-m-d', strtotime($date));

	$fetch_qn = $mysqli_connect->query("SELECT max(schedule_sequence) from tbl_vaccination_schedule where (schedule_date like '$today%') ") or die(mysqli_error());
	$queue_num_row = $fetch_qn->fetch_array();
	$schedule_sequence = ($queue_num_row[0] * 1) + 1;

	return $schedule_sequence;
}

function totalResidents()
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT count(r_id) from tbl_resident_profile");
	$row = $fetch->fetch_array();

	return $row[0];
}

function totalVaccines()
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT count(vaccine_id) from tbl_vaccines");
	$row = $fetch->fetch_array();

	return $row[0];
}


function totalSAP()
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT count(spd_id) from tbl_sap_details WHERE status=1");
	$row = $fetch->fetch_array();

	return $row[0];
}

function totalVaccinated()
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT count(r_id) from tbl_resident_profile WHERE r_status='1'");
	$row = $fetch->fetch_array();

	return $row[0];
}

function totalNotification()
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT count(vacc_schedule_id) from tbl_vaccination_schedule WHERE status='P'");
	$row = $fetch->fetch_array();

	return $row[0];
}

function sourceInformation($source, $total)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT count(DISTINCT(r_id)) FROM tbl_vaccination_schedule WHERE source_of_information='$source' AND status='F'");
	$row = $fetch->fetch_array();

	if ($total > 0) {
		$percentage = ($row[0] / $total) * 100;
	} else {
		$percentage = 0;
	}


	return $row[0] . " (" . number_format($percentage, 2) . "%)";
}


function sendSms($number, $message)
{
	//if (is_dev == 'N') {
	$ch = curl_init();
	//$itexmo = array('1' => $number, '2' => $message, '3' => 'TR-KAIGR916127_R5Y1K', 'passwd' => 'jdy9q)151j');
	$itexmo = array('1' => $number, '2' => $message, '3' => 'TR-AKSKA563707_CEXYS', 'passwd' => 'sv}))74tec');
	
	curl_setopt($ch, CURLOPT_URL, "https://www.itexmo.com/php_api/api.php");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt(
		$ch,
		CURLOPT_POSTFIELDS,
		http_build_query($itexmo)
	);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	return curl_exec($ch);
	curl_close($ch);
	//}
}


function sms_checker()
{
	global $mysqli_connect;

	$fetchVac = $mysqli_connect->query("SELECT * from tbl_vaccination_schedule WHERE sms_status='0' AND schedule_date >= DATE(NOW()) - INTERVAL 1 DAY;  ");
	$vac = "";
	while ($vRow = $fetchVac->fetch_array()) {
		$msg  = "Good day " . getResident($vRow['r_id']) . ", you have Vaccination schedule tomorrow! Thank you!";
		$number = residentNumber($vRow['r_id']);

		sendSms($number, $msg);

		$mysqli_connect->query("UPDATE tbl_vaccination_schedule set sms_status='1' WHERE vacc_schedule_id='$vRow[vacc_schedule_id]'");
	}

	$fetchSAP = $mysqli_connect->query("SELECT * from tbl_sap_details as sd, tbl_sap  as s WHERE sd.sms_status='0' AND s.sap_id=sd.sap_id AND s.sap_schedule_date >= DATE(NOW()) - INTERVAL 1 DAY;");
	$vac = "";
	while ($sRow = $fetchSAP->fetch_array()) {
		$msg  = "Good day " . getResident($sRow['r_id']) . ", you have SAP distribution schedule tomorrow! Please prepare all the requirements";
		$number = residentNumber($sRow['r_id']);

		sendSms($number, $msg);

		$mysqli_connect->query("UPDATE tbl_sap_details set sms_status='1' WHERE spd_id='$sRow[spd_id]'");
	}
}

function residentNumber($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT r_contact_num from tbl_resident_profile WHERE r_id='$id'");
	$row = $fetch->fetch_array();


	return $row[0];
}


function sapBatch($sap_id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT sap_batch from tbl_sap WHERE sap_id='$sap_id'");
	$row = $fetch->fetch_array();


	return $row[0];
}


function insertLogs($action, $user_id)
{
	global $mysqli_connect;

	$date = getCurrentDate();
	$mysqli_connect->query("INSERT INTO tbl_logs (action,user_id,date_modified) VALUES ('$action','$user_id','$date')");
}
function countVacSched($id)
{
	global $mysqli_connect;
	$fetch = $mysqli_connect->query("SELECT COUNT(vacc_schedule_id) FROM tbl_vaccination_schedule WHERE vaccine_id='$id' AND STATUS='A'");
	$row = $fetch->fetch_array();

	return $row[0];
}
function countVacLimit($id)
{
	global $mysqli_connect;
	$fetch = $mysqli_connect->query("SELECT count(vaccination_event_id),event_limit FROM tbl_vaccination_events WHERE vaccine_id='$id'");
	$row = $fetch->fetch_array();
	if ($row[0] == 0) {
		$result = 0;
	} else {
		$result = $row[0];
	}

	return $result;
}
