<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once '../../core/config.php';

$fetch = $mysqli_connect->query("SELECT * FROM tbl_vaccines");

$response = array();
while ($row = $fetch->fetch_array()) {
    $list = array();
    $list['vaccine_id'] = $row['vaccine_id'];
    $list['vaccine_name'] = $row['vaccine_name'] . " " . countVacSched($row['vaccine_id']) . "/" . countVacLimit($row['vaccine_id']);
    // $list['title'] = "Business of Software Conference";
    // $list['color'] = "#ff6d42";
    array_push($response, $list);
    // echo '<IonSelectOption  value="' . $row['vaccine_id'] . '">' . $row['vaccine_name'] . '</IonSelectOption>';
}





echo json_encode($response);
