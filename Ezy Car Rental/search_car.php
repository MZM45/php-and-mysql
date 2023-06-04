<?php
include 'db_connect.php';

$carId = $_POST['car_id'];

// Perform validation and sanitization on the input data as per your needs

// Search for the car in the database based on the car ID
$sql = "SELECT * FROM cars WHERE car_id = '$carId'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "Car Id: " . $row['car_id'] . "<br>";
    echo "Make and Model: " . $row['make_model'] . "<br>";
    echo "Color: " . $row['color'] . "<br>";
    echo "Rental Price: $" . $row['rental_price'] . " per day<br>";
    echo "Is Booked: " . ($row['is_booked'] ? "Yes" : "No") . "<br>";
} else {
    echo "No car found with the provided car ID.";
}

mysqli_close($conn);
?>
