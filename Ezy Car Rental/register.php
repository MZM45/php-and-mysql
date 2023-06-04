<?php
include 'db_connect.php';

$fullName = $_POST['full_name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Perform validation and sanitization on the input data as per your needs

// Save the customer information in the database
$sql = "INSERT INTO customers (full_name, email, password) VALUES ('$fullName', '$email', '$password')";
if (mysqli_query($conn, $sql)) {
    echo "Registration successful.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
