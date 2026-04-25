
<?php
function getDiningChairMeasurements($conn) {
    $sql = "SELECT * FROM diningchairmeasurements LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        echo '<p style="color: white;">Depth</p>
        <strong><p>' . $row['depth'] . '</p></strong>
        <hr style="width: 90%;">

        <p style="color: white;">Height</p>
        <strong><p>' . $row['height'] . '</p></strong>
        <hr style="width: 90%;">

        <p style="color: white;">Armrest Height</p>
        <strong><p>' . $row['armrest_height'] . '</p></strong>
        <hr style="width: 90%;">

        <p style="color: white;">Seating Height</p>
        <strong><p>' . $row['seating_height'] . '</p></strong>
        <hr style="width: 90%;">

        <p style="color: white;">Weight</p>
        <strong><p>' . $row['weight'] . '</p></strong>
        <hr style="width: 90%;">

        <p style="color: white;">Maximum Weight Load</p>
        <strong><p>' . $row['max_weight_load'] . '</p></strong>
        <hr style="width: 90%;">

        <p style="color: white;">Width</p>
        <strong><p>' . $row['width'] . '</p></strong>
        <hr style="width: 90%;">';
    } else {
        echo "<p style='color: white;'>No data found.</p>";
    }
}

?>