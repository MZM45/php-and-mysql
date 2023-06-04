<?php
include 'db_connect.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Perform validation and sanitization on the input data as per your needs

// Check if the email and password combination exists in the database
$sql = "SELECT * FROM customers WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Login successful
    echo "Login successful. Redirect to the customer dashboard.";
    header("Location: customermenu.php");
  exit;
} else {
    // Login failed
    echo "Invalid email or password.";
}

mysqli_close($conn);
?>
