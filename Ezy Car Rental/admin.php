<!DOCTYPE html>
<html>
<head>
    <title>Ezy Rentals - Admin Panel</title>
    <h2><a href="index.php">Go Home<a/></h2>

    <style>
        * {
            margin: 0;
            padding: 0;
            transition: .2s;
            font-family: sans-serif;
            text-transform: capitalize;
            text-decoration: none;
        }
        html {
            background: url(AdminBackground.png) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        h1, h2, h3 {
            margin-bottom: 10px;
        }

        form {
            border: 1px solid #999;
            max-width: 500px;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="date"] {
            padding: 7px;
            width: 70%;
            outline: 1px solid #192627;
            margin-bottom: 10px;
        }

        form input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 17px;
            background-color: #192627;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Admin Panel - Ezy Rentals</h1>
    <h2><a href="index.php">Go Home<a/></h2>
    <h2>Add New Car</h2>
    <form action="add_car.php" method="post">
        <label>Car ID</label>
        <input type="number" name="car_id" required><br>

        <label>Make and Model:</label>
        <input type="text" name="make_model" required><br>

        <label>Color:</label>
        <input type="text" name="color" required><br>

        <label>Rental Price per Day:</label>
        <input type="number" name="rental_price" required><br>

        <label>Availability:</label>
        <input type="text" name="is_booked" required><br>

        <input type="submit" name="add_car" value="Add Car">
    </form>

    <h2>Delete Car</h2>
    <form action="delete_car.php" method="post">
        <label>Car ID:</label>
        <input type="number" name="car_id" required><br>

        <input type="submit" name="delete_car" value="Delete Car">
    </form>

    <h2>Booking Details</h2>
    <?php include 'booking_details.php'; ?>



    <h2>Customer Booking Details</h2>
    <form action="" method="POST">
        <label for="customer_name">Customer Name:</label>
        <input type="text" name="customer_name" id="customer_name" required>
        <input type="submit" value="Search">
    </form>

    <hr>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'db_connect.php';

        $customerName = $_POST['customer_name'];

        // Perform validation and sanitization on the input data as per your needs

        // Retrieve the customer's booked car and calculate the total amount
        $sql = "SELECT cars.make_model, cars.rental_price, bookings.start_date, bookings.end_date
                FROM cars
                INNER JOIN bookings ON cars.car_id = bookings.car_id
                WHERE bookings.customer_name = '$customerName' AND cars.is_booked = 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $totalAmount = 0;

            echo "<h3>Currently booked car for $customerName:</h3>";

            while ($row = mysqli_fetch_assoc($result)) {
                $makeModel = $row['make_model'];
                $rentalPrice = $row['rental_price'];
                $startDate = $row['start_date'];
                $endDate = $row['end_date'];

                echo "<p>Make and Model: $makeModel</p>";
                echo "<p>Rental Price: $rentalPrice per day</p>";
                echo "<p>Booking Period: $startDate to $endDate</p><br>";

                // Calculate the total amount by multiplying the rental price by the number of days booked
                $startDateObj = new DateTime($startDate);
                $endDateObj = new DateTime($endDate);
                $numDays = $startDateObj->diff($endDateObj)->days + 1;
                $totalAmount += $rentalPrice * $numDays;
            }

            echo "<h3>Total Amount: $totalAmount</h3>";
        } else {
            echo "<p>No currently booked car found for $customerName.</p>";
        }

        mysqli_close($conn);
    }
    ?>
</body>
</html>
