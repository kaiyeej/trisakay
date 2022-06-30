<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once '../../core/config.php';
$data = json_decode(file_get_contents("php://input"));
if (isset($data->r_id)) {
    $r_id = $mysqli_connect->real_escape_string($data->r_id);
    $fetch = $mysqli_connect->query("SELECT * FROM tbl_vaccination_schedule WHERE r_id='$r_id'");
    $response = array();
    while ($row = $fetch->fetch_array()) {
        $list = array();
        $list['id'] = $row['vacc_schedule_id'];
        $list['vs_id'] = $row['vacc_schedule_id'];
        $list['vs_date'] = date('Y-m-d', strtotime($row['schedule_date']));
        $list['vs_vaccine'] =  getVaccine($row['vaccine_id']);
        $list['vs_r_id'] = getResident($row['r_id']);
        array_push($response, $list);
    }


    echo json_encode($response);
}
