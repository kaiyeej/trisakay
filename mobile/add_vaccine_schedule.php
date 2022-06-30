<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../core/config.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->r_id) && $data->r_id > 0) {
	$r_id = $mysqli_connect->real_escape_string($data->r_id);
	$vaccine_id = $mysqli_connect->real_escape_string($data->vaccine_id);
	$schedule_date = $mysqli_connect->real_escape_string($data->schedule_date);
	$vac_reason = $mysqli_connect->real_escape_string($data->vac_reason);
	$source_of_info = $mysqli_connect->real_escape_string($data->source_of_info);
	$date = getCurrentDate();

	$vax_date = date('Y-m-d', strtotime($schedule_date)); //date("Y-m-d H:i:s")
	$vax_time = date('H:i:s', strtotime($schedule_date));

	$fetch_vax_events = $mysqli_connect->query("SELECT count(vaccination_event_id), event_limit,vaccination_event_id from tbl_vaccination_events where vaccine_id='$vaccine_id' AND ('$vax_date' BETWEEN start_date and end_date) AND ('$vax_time' BETWEEN start_time and end_time)") or die(mysqli_error());
	$vax_events = $fetch_vax_events->fetch_array();

	$fetchVax = $mysqli_connect->query("SELECT count(vacc_schedule_id) from tbl_vaccination_schedule where vaccination_event_id='$vax_events[vaccination_event_id]'") or die(mysqli_error());
	$vaxTotal = $fetchVax->fetch_array();



	if ($vax_events['event_limit'] <= $vaxTotal[0]) {
		echo 3;
	} else {

		$fetch_rows = $mysqli_connect->query("SELECT count(vacc_schedule_id) from tbl_vaccination_schedule where r_id='$r_id'") or die(mysqli_error());
		$count_rows = $fetch_rows->fetch_array();
		// AND (DATE(schedule_date) BETWEEN $fetVacEvents[start_date] AND $fetVacEvents[end_date])

		if ($count_rows[0] > 0) {
			echo 2;
		} else {
			$sql = $mysqli_connect->query("INSERT INTO `tbl_vaccination_schedule`(`r_id`, `vaccine_id`, `schedule_date`,`vac_reason`,`source_of_information`,`date_added`,`vac_dose`,`status`) VALUES ('$r_id','$vaccine_id','$schedule_date','$vac_reason','$source_of_info','$date','1','S')");

			if ($sql) {
				echo 1;
			} else {
				echo 0;
			}
		}
	}
	// echo $schedule_date;
}
