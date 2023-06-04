<?php
include 'db_connect.php';

$carId = $_POST['car_id'];
$customerName = $_POST['customer_name'];
$startDate = $_POST['start_date'];
$endDate = $_POST['end_date'];

// Perform validation and sanitization on the input data as per your needs

// Check if the car is available for booking
$availabilitySql = "SELECT * FROM cars WHERE car_id = '$carId' AND is_booked = 0";
$availabilityResult = mysqli_query($conn, $availabilitySql);

if (mysqli_num_rows($availabilityResult) > 0) {
    // Car is available, proceed with the booking
    $insertSql = "INSERT INTO bookings (car_id, customer_name, start_date, end_date) VALUES ('$carId', '$customerName', '$startDate', '$endDate')";

    if (mysqli_query($conn, $insertSql)) {
        // Update the car's booking status to 'booked'
        $updateSql = "UPDATE cars SET is_booked = 1 WHERE car_id = '$carId'";
        mysqli_query($conn, $updateSql);

        echo "Booking added successfully.";
    } else {
        echo "Error: " . $insertSql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "The selected car is not available for booking.";
}

mysqli_close($conn);
?>
