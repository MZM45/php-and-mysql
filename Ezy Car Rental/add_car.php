<?php
include 'db_connect.php';
$carid = $_POST['car_id'];
$makeModel = $_POST['make_model'];
$color = $_POST['color'];
$rentalPrice = $_POST['rental_price'];
$isbooked = $_POST['is_booked'];
// Perform validation and sanitization on the input data as per your needs

// Insert the new car into the database
$sql = "INSERT INTO cars (car_id,make_model, color, rental_price,is_booked) VALUES ('$carid','$makeModel', '$color', '$rentalPrice','$isbooked')";
if (mysqli_query($conn, $sql)) {
    echo "Car added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
