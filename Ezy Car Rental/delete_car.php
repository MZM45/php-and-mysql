<?php
include 'db_connect.php';

$carId = $_POST['car_id'];

// Perform validation and sanitization on the input data as per your needs

// Delete the car from the database
$sql = "DELETE FROM cars WHERE car_id = '$carId'";
if (mysqli_query($conn, $sql)) {
    echo "Car deleted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
