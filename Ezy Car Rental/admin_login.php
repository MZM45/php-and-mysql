<!DOCTYPE html>
<html>
<head>
    <title>Ezy Rentals - Admin Login</title>
    <h2><a href="index.php">Go Home<a/></h2>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            border: none;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            border-radius: 4px;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>
        <form action="admin_login.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Login">
            </div>

            <?php
            include 'db_connect.php';

            $email = $_POST['email'];
            $password = $_POST['password'];

            // Perform validation and sanitization on the input data as per your needs

            // Check if the email and password combination exists in the database
            $sql = "SELECT * FROM admins WHERE email = '$email' AND password = '$password'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Login successful
                echo "Login successful. Redirect to the admin page.";
                header("Location: admin.php");
              exit;
            } else {
                // Login failed
                echo "Invalid email or password.";
            }

            mysqli_close($conn);
            ?>
        </form>
    </div>
</body>
</html>
