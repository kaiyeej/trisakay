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
    $fetchData = $mysqli_connect->query("SELECT * FROM tbl_sap_details WHERE r_id='$r_id'");
    $response = array();
    while ($data = $fetchData->fetch_array()) {
        $fetchSap = $mysqli_connect->query("SELECT * FROM tbl_sap WHERE sap_id='$data[sap_id]'");
        $row1 = $fetchSap->fetch_array();
        $list = array();
        $list['id'] = $data['spd_id'];
        $list['r_id'] = getResident($data['r_id']);
        $list['amount'] = number_format($row1['sap_amount'], 2);
        $list['schedule_date'] = date('Y-m-d', strtotime($row1['sap_schedule_date']));
        // $list['vs_r_id'] = getResident($row['r_id']);
        array_push($response, $list);
    }


    echo json_encode($response);
}
