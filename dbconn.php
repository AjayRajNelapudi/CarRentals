<?php
class Database {
    public $conn = NULL;

    function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "anitscse034";
        $dbname = "CarRentals";

        $this->conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    function print_all($result) {
        while($row = mysqli_fetch_assoc($result)){
          foreach($row as $val) {
              echo "$val ";
          }
          echo "<br>";
        }
    }

    function register($id, $password, $name, $dob) {
        $query = "INSERT INTO User
                    VALUES
                    ($id, '$password', '$name', '$dob', 1)";
        $registration_status = mysqli_query($this->conn, $query);
        return $registration_status;
    }

    function login($user_id, $password) {
        $query = "SELECT * FROM User WHERE u_id = $user_id AND u_password = '$password'";
        $user = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($user) == 1) {
          return True;
        }
        return False;
    }

    function search_cars($start_time, $return_time) {
        $query = "SELECT * FROM Car C
                  WHERE C.c_id NOT IN (
                      SELECT B.c_id FROM Booking B
                      WHERE B.start_time < '$start_time' AND B.return_time > '$return_time')";

        $cars = mysqli_query($this->conn, $query);
        return $cars;
    }

    function book_car($c_id, $u_id, $start_time, $return_time) {
        $query = "INSERT INTO Booking
                    VALUES
                    ($c_id, $u_id, NOW(), '$start_time', '$return_time')";
        $booking_status = mysqli_query($this->conn, $query);
        return $booking_status;
    }

    function cancel_booking($c_id) {
        $query = "DELETE FROM Booking WHERE c_id = $c_id";
        $cancellation_status = mysqli_query($this->conn, $query);
        return $cancellation_status;
    }

    function __destruct() {
        mysqli_close($this->conn);
    }
}


//$result = search_cars($conn, "2018-10-10 10:10:10", "2018-10-10 10:10:12");
//print_all($result);

//$registration_status = register($conn, "6", "key", "Buchi", "1999-01-02");
//echo $registration_status;

//$result = login($conn, "6", "key");
//echo $result;

//$booking_status = book_car($conn, "1", "1", "2018-10-10 10:10:10", "2018-10-10 10:12:10");
//echo $booking_status;

//$cancellation_status = cancel_booking($conn, "1");
//echo $cancellation_status;

//$result = mysqli_query($conn, "SELECT * FROM Booking");
//print_all($result);

$db = new Database();
$login_status = $db->book_car("1", "1", "2018-10-10 10:10:10", "2018-10-10 10:12:10");
echo $login_status;
?> 