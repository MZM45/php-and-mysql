<!DOCTYPE html>
<html>
<head>
    <title>Ezy Rentals - Customer Menu</title>
    <h2><a href="index.php">Go Home<a/></h2>
    <style>
        * {
            margin: 0;
            padding: 0;
            transition: .2s;
            font-family: sans-serif;
        }
        html {
            background: url(customer1.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
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

        h2 {
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 24px;
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
        input[type="date"] {
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

        hr {
            margin: 30px auto;
            width: 80%;
            border: none;
            border-top: 1px solid #ccc;
        }

        p {
            margin-bottom: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>Welcome, Customer!</h1>
    <h2>Menu</h2>
    <h2>Car List</h2>
    <?php
    include 'db_connect.php';

    $sql = "SELECT * FROM cars";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $carid = $row['car_id'];
            $makeModel = $row['make_model'];
            $color = $row['color'];
            $rentalPrice = $row['rental_price'];
            $isBooked = $row['is_booked'];

            echo "<p>Car Id: " . $carid . "</p>";
            echo "<p>Make and Model: " . $makeModel . "</p>";
            echo "<p>Color: " . $color . "</p>";
            echo "<p>Rental Price: $" . $rentalPrice . " per day</p>";
            echo "<hr>";
        }
    } else {
        echo "<p>No cars found.</p>";
    }

    mysqli_close($conn);
    ?>
    <h2>Add Booking</h2>
    <form action="add_booking_details.php" method="post">
        <label for="car_id">Car ID:</label>
        <input type="text" id="car_id" name="car_id" required><br>

        <label for="customer_name">Customer Name:</label>
        <input type="text" id="customer_name" name="customer_name" required><br>

        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required><br>

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required><br>

        <input type="submit" value="Add Booking">
    </form>
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
    <!DOCTYPE html>
    <html>
    <head>
        <title>Car Search</title>
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

            .car-details {
                padding: 10px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .car-details p {
                margin-bottom: 10px;
            }

            .error-message {
                text-align: center;
                color: red;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Car Search</h1>
            <form action="search_car.php" method="post">
                <label for="car_id">Car ID:</label>
                <input type="text" id="car_id" name="car_id" required>
                <input type="submit" value="Search">
            </form>

            <?php
            include 'db_connect.php';

            if (isset($_POST['car_id'])) {
                $carId = $_POST['car_id'];

                // Perform validation and sanitization on the input data as per your needs

                // Search for the car in the database based on the car ID
                $sql = "SELECT * FROM cars WHERE car_id = '$carId'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $makeModel = $row['make_model'];
                    $color = $row['color'];
                    $rentalPrice = $row['rental_price'];
                } else {
                    $makeModel = "N/A";
                    $color = "N/A";
                    $rentalPrice = "N/A";
                }

                mysqli_close($conn);
            }
            ?>

            <?php if (isset($_POST['car_id']) && mysqli_num_rows($result) > 0) : ?>
                <div class="car-details">
                    <p><strong>Car ID:</strong> <?php echo $carId; ?></p>
                    <p><strong>Make and Model:</strong> <?php echo $makeModel; ?></p>
                    <p><strong>Color:</strong> <?php echo $color; ?></p>
                    <p><strong>Rental Price:</strong> $<?php echo $rentalPrice; ?> per day</p>
                </div>
            <?php elseif (isset($_POST['car_id'])) : ?>
                <p class="error-message">No car found with the provided car ID.</p>
            <?php endif; ?>
        </div>
    </body>
    </html>

</body>
</html>
