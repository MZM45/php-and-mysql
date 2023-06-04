<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform validation and sanitization on the input data as per your needs

    // Connect to the database
    include 'db_connect.php';

    // Check if the admin email already exists
    $checkEmailQuery = "SELECT * FROM admins WHERE email = '$email'";
    $checkEmailResult = mysqli_query($conn, $checkEmailQuery);
    if (mysqli_num_rows($checkEmailResult) > 0) {
        echo "Email already exists. Please use a different email.";
    } else {
        // Insert the admin data into the database
        $insertQuery = "INSERT INTO admins (full_name, email, password) VALUES ('$fullName', '$email', '$password')";
        if (mysqli_query($conn, $insertQuery)) {
            echo "Registration successful.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
