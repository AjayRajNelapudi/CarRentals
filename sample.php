<?php
require("dbconn.php");
$database = new Database();
//$database->book_car("1", "1", "2018-10-10 10:10:10", "2018-10-10 10:12:10");
//$cars = $database->search_cars("1", "2018-10-10 10:10:10", "2018-10-10 10:12:10");
//$database->print_all($cars);

$database->calculate_price("1", 3);
?>