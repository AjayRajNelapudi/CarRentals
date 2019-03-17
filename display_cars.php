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
$duration = time_diff($start_time, $return_time);
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Select Cars
	</title>

	<style type="text/css">
		table.display-cars {
			border-radius: 15px;
			border-width: 3px;
			border-color: white;
			font-family: Arial, Helvetica, sans-serif;
			color: #FFFFFF;
			border-spacing: 5px;
		    border-style: solid;
		}
	</style>

	<marquee behavior="scroll" direction="right" bgcolor=#7477AF text=#000000>CAR RENTAL</marquee>
</head>
<body background="royce.jpg">
	<form method="POST" action="book_car.php">
		<table class="display-cars" cellspacing="30" cellpadding="20">
			<?php
				while ($row = mysqli_fetch_assoc($cars)) {
					$c_id = $row['c_id'];
					echo "<tr>";
					foreach ($row as $attribute) {
						echo "<td>$attribute</td>";
					}
					$price = $db->calculate_price($c_id, $duration);
					echo "<td>$price</td>";
					echo '<td><input type="submit" name="$c_id" value="Book"></td>';
					echo "</tr>";
				}
			?>
		</table>
	</form>
</body>
</html>