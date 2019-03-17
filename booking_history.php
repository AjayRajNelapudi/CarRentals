<?php
require("dbconn.php");

session_start();
$u_id = $_SESSION["u_id"];

$db = new CarRentals_Database();
$booking_history = $db->get_booking_history($u_id);
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Booking History
	</title>

	<style type="text/css">
		table.display-booking-history {
			border-radius: 15px;
			border-width: 3px;
			border-color: white;
			font-family: Arial, Helvetica, sans-serif;
			color: #FFFFFF;
			border-spacing: 5px;
		    border-style: solid;
		}
	</style>

	<marquee behavior="scroll" direction="right" bgcolor=#7477AF text=#000000>Car Rentals</marquee>
</head>
<body background="royce.jpg">
	<table class="display-booking-history" cellpadding="20">
		<?php
			echo "<tr>";
			echo "<td>Car</td> <td>Start Time</td> <td>Return Time</td>";
			echo "</tr>";
			while ($row = mysqli_fetch_assoc($booking_history)) {
				echo "<tr>";
				foreach ($row as $attr) {
					echo "<td>$attr</td>";
				}
				echo "</tr>";
			}
		?>
	</table>
</body>
</html>