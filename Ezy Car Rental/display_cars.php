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

        echo '<div class="card">';
        echo '<div class="card-info">';
        echo '<h3 class="title">'."Car Id: ". $carid . '</h3>';
        echo '<h3 class="title">' . $makeModel . '</h3>';
        echo '<p class="desc">Color: ' . $color . '</p>';
        echo '<p class="desc">Rental Price: $' . $rentalPrice . ' per day</p>';
        echo '<p class="desc">Availability: ' . $isBooked . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No cars found.";
}

mysqli_close($conn);
?>
