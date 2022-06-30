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
    $fetch = $mysqli_connect->query("SELECT * FROM tbl_resident_profile WHERE r_id='$r_id'");

    // $list = array();
    // $list['start'] = "2021-07-01";
    // $list['end'] = "2021-07-15";
    // $list['title'] = "Business of Software Conference";
    // $list['color'] = "#ff6d42";

    // array_push($response, $list);
    $response = array();
    $row = $fetch->fetch_array();
    $list = array();
    $list['id'] = $row['r_id'];
    $list['fname'] = $row['r_fname'];
    $list['mname'] = $row['r_mname'];
    $list['lname'] = $row['r_lname'];
    $list['r_suffix'] = $row['r_suffix'];
    $list['r_birthdate'] = date(DATE_ISO8601, strtotime($row['r_birthdate']));;
    $list['r_civil_status'] = $row['r_civil_status'];
    $list['r_contact_num'] = $row['r_contact_num'];
    $list['r_purok'] = $row['r_purok'];
    $list['r_city'] = $row['r_city'];
    $list['r_barangay'] = $row['r_barangay'];
    $list['r_gender'] = $row['r_gender'];
    $list['r_occupation'] = $row['r_occupation'];
    $list['r_name_of_employer'] = $row['r_name_of_employer'];
    $list['r_allergy'] = $row['r_allergy'];
    $list['r_comorbidities'] = $row['r_comorbidities'];
    $list['r_priority_group'] = $row['r_priority_group'];
    $list['username'] = $row['username'];
    // $list['password'] = "#ff6d42";
    array_push($response, $list);
    // echo '<IonSelectOption  value="' . $row['vaccine_id'] . '">' . $row['vaccine_name'] . '</IonSelectOption>';



    echo json_encode($response);
}
