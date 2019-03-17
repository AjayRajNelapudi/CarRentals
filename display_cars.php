<?php
require("dbconn.php");

function time_diff($start ,$return) {
	$start_time = strtotime($start);
	$return_time = strtotime($return);

	$difference = $return_time - $start_time;

	$years = abs(floor($difference / 31536000));
	$days = abs(floor(($difference-($years * 31536000))/86400));
	$hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
	
	return $hours;
}

session_start();
$u_id = $_SESSION["u_id"];

$start_time = $_POST["start-time"];
$return_time = $_POST["return-time"];
$location = $_POST["location"];

$db = new CarRentals_Database();
$cars = $db->search_cars($u_id, $start_time, $return_time, $location);

$db->print_all($cars);

$cars = $db->search_cars($u_id, $start_time, $return_time, $location);
$duration = time_diff($start_time, $return_time);

while($row = mysqli_fetch_assoc($cars)) {
	$price = $db->calculate_price($row["c_id"], $duration);
	echo "$price<br>";
}
?>