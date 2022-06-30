<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->r_id) && $data->r_id > 0){
	$r_id = $mysqli_connect->real_escape_string($data->r_id);
	$vaccine_id = $mysqli_connect->real_escape_string($data->vaccine_id);
	$schedule_date = $mysqli_connect->real_escape_string($data->schedule_date);
	$vac_reason = $mysqli_connect->real_escape_string($data->vac_reason);
	$date = getCurrentDate();

	$fetch_rows = $mysqli_connect->query("SELECT count(vacc_schedule_id) from tbl_vaccination_schedule where r_id='$r_id'") or die(mysqli_error());
		$count_rows = $fetch_rows->fetch_array();

		if($count_rows[0] > 0){
			echo 2;
		}else{

			$sql= $mysqli_connect->query("INSERT INTO `tbl_vaccination_schedule`(`r_id`, `vaccine_id`, `schedule_date`, `remarks`, `vac_reason`,schedule_sequence,date_added,status) VALUES ('$r_id','$vaccine_id','$schedule_date','$remarks','$vac_reason','$schedule_sequence','$date','S')");
				
			if($sql){
                $fetch_vaccine = $mysqli_connect->query("SELECT vaccine_dose,vaccine_dosage_span from tbl_vaccines where vaccine_id='$vaccine_id'") or die(mysqli_error());
                $rowVac = $fetch_vaccine->fetch_array();
                $dosage = $rowVac['vaccine_dose']-1;
				$span_counter = 1;
                while($dosage > 0){
					$days_span = $rowVac['vaccine_dosage_span']*$span_counter;
                    $sched_next = date('Y-m-d h:m:s', strtotime($schedule_date. ' + '.$days_span.' days'));
                    $dosage_ = $span_counter+1;
					$queue_num = sequenceNum($sched_next);

                    if($span_counter == 1){
                        $dose_remarks = "2nd DOSE";
                    }else if($span_counter == 2){
                        $dose_remarks = "3rd DOSE";
                    }else{
                        $dose_remarks = $dosage_."th DOSE";
                    }

                    $mysqli_connect->query("INSERT INTO `tbl_vaccination_schedule`(`r_id`, `vaccine_id`, `schedule_date`, `remarks`, `vac_reason`,schedule_sequence,date_added,status) VALUES ('$r_id','$vaccine_id','$sched_next','','$vac_reason','$queue_num','$date','S')");

                    $dosage--;
					$span_counter++;
                }

				echo 1;
			}else{
				echo 0;
			}
			
		}

}

?>