<?php
include 'db_connect.php';

$sql = "SELECT * FROM cars LEFT JOIN bookings ON bookings.car_id WHERE cars.is_booked = 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $makeModel = $row['make_model'];
        $color = $row['color'];
        $rentalPrice = $row['rental_price'];
        $customerName = $row['customer_name'];
        $startDate = $row['start_date'];
        $endDate = $row['end_date'];

        echo "Car Id: " . $row['car_id'] . "<br>";
        echo "Make and Model: " . $row['make_model'] . "<br>";
        echo "Color: " . $row['color'] . "<br>";
        echo "Rental Price: $" . $row['rental_price'] . " per day<br>";
        echo "Customer Name: " . $customerName . "<br>";
        echo "Booking Period: " . $startDate . " to " . $endDate . "<br><br>";
    }
} else {
    echo "No booking details found.";
}

mysqli_close($conn);
?>
