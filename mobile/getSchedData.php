<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once '../../core/config.php';
$data = json_decode(file_get_contents("php://input"));
$count = 0;
if (isset($data->r_id)) {
    $r_id = $mysqli_connect->real_escape_string($data->r_id);
    $fetch = $mysqli_connect->query("SELECT * FROM tbl_vaccination_schedule WHERE r_id='$r_id' AND status ='A'");

    // $list = array();
    // $list['start'] = "2021-07-01";
    // $list['end'] = "2021-07-15";
    // $list['title'] = "Business of Software Conference";
    // $list['color'] = "#ff6d42";

    // array_push($response, $list);
    // $response = array();
    while ($row = $fetch->fetch_array()) {
        $list[] = array(
            'id' => $row['vacc_schedule_id'],
            'date' => date('Y-m-d h:i A', strtotime($row['schedule_date'])),
            'name' => "Vaccine Schedule - " . date('h:i A', strtotime($row['schedule_date'])) . " #" . $row['schedule_sequence'],
            'status' => 1,
            'allDay' => true
        );
    }
    $fetchData = $mysqli_connect->query("SELECT * FROM tbl_sap_details WHERE r_id='$r_id'");
    // $response = array();
    while ($data = $fetchData->fetch_array()) {
        $fetchSap = $mysqli_connect->query("SELECT * FROM tbl_sap WHERE sap_id='$data[sap_id]'");
        $row1 = $fetchSap->fetch_array();
        $list[] = array(
            'id' => $data['spd_id'],
            'date' => date('Y-m-d h:i A', strtotime($row1['sap_schedule_date'])),
            'name' => "SAP Schedule",
            'status' => 1,
            'allDay' => true
        );
    }

    $getDataEvents = $mysqli_connect->query("SELECT * FROM tbl_vaccination_events");
    // $response = array();
    while ($dataEvents = $getDataEvents->fetch_array()) {

        $start_date = date('Y-m-d', strtotime($dataEvents['start_date']));
        $end_date = date('Y-m-d', strtotime($dataEvents['end_date']));

        for ($i = $start_date; $i <= $end_date; $i++) {

            $list[] = array(
                'id' => $count++,
                'date' =>  date('Y-m-d h:i A', strtotime($i . ' ' . $dataEvents['start_time'])),
                'name' => getVaccine($dataEvents['vaccine_id']) . " " . date('h:i A', strtotime($dataEvents['start_time'])) . "-" . date('h:i A', strtotime($dataEvents['end_time'])),
                'status' => 1,
                'allDay' => true

            );
        }
    }

    echo json_encode($list);
}
