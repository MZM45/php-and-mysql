<!DOCTYPE html>
<html>
<head>
    <title>Ezy Rentals - Admin Registration</title>
    <a href="index.php">Go Home</a>
    <style>
        * {
            margin: 0;
            padding: 0;
            transition: .2s;
            font-family: sans-serif;
        }

        body {
            background-color: #f2f2f2;
            text-align: center;
        }

        h1 {
            margin-top: 30px;
            margin-bottom: 20px;
            font-size: 28px;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 16px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #192627;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0f1418;
        }
    </style>
</head>
<body>
    <h1>Admin Registration</h1>
    <form action="register_admin.php" method="post">
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
