<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../core/config.php';

$date = getCurrentDate();

$response = array();
$fetch = $mysqli_connect->query("SELECT * from tbl_public_information where WEEKOFYEAR(date_modified)=WEEKOFYEAR('$date') ORDER BY date_modified DESC ") or die(mysqli_error());
while($row = $fetch->fetch_array()){
	$list = array();
	$list['id'] = $row['public_information_id'];
	$list['title'] = $row['pi_title'];
	$list['content'] = $row['pi_content'];
	
	if($row['system_module'] == "BHC"){
		$list['system_module'] = "Barangay Health Center";
	}else{
		$list['system_module'] = "Barangay Office";
	}

	$list['posted_by'] = getUser($row['user_id']);
	$list['date'] = date('D M d, Y h:i A', strtotime($row['date_modified']));

	array_push($response, $list);
}

echo json_encode($response);

?>