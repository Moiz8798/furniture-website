<?php
function getBolzoneMeasurements($conn) {
    $sql = "SELECT * FROM bolzonemeasurements LIMIT 1"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo '
        <p style="color: white;">Depth</p>
        <strong><p>' . $row["Depth"] . '</p></strong>
        <hr style="width: 90%;">

        <p style="color: white;">Height</p>
        <strong><p>' . $row["Height"] . '</p></strong>
        <hr style="width: 90%;">

        <div><p style="color: white;">Seating Height</p><strong><p>' . $row["SeatingHeight"] . '</p></strong></div>
        <hr style="width: 90%;">

        <div><p style="color: white;">Weight</p><strong><p>' . $row["Weight"] . '</p></strong></div>
        <hr style="width: 90%;">

        <div><p style="color: white;">Maximum Weight load</p><strong><p>' . $row["MaxWeightLoad"] . '</p></strong></div>
        <hr style="width: 90%;">

        <div><p style="color: white;">Width</p><strong><p>' . $row["Width"] . '</p></strong></div>
        ';
    } else {
        echo "<p style='color: red;'>No data found.</p>";
    }

    $conn->close();
}
?>
