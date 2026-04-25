<?php
function displayChairMeasurements($conn) {
    $sql = "SELECT * FROM SweetArtChairMeasurements LIMIT 1"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo "<p>Depth</p>";
        echo "<strong><p style='margin-bottom: 2%;'>{$row['Depth']}</p></strong>";

        echo "<p>Height</p>";
        echo "<strong><p style='margin-bottom: 2%;'>{$row['Height']}</p></strong>";

        echo "<p>Seating Height</p>";
        echo "<strong><p style='margin-bottom: 2%;'>{$row['SeatingHeight']}</p></strong>";

        echo "<p>Weight</p>";
        echo "<strong><p style='margin-bottom: 2%;'>{$row['Weight']}</p></strong>";

        echo "<p>Maximum Weight Load</p>";
        echo "<strong><p style='margin-bottom: 2%;'>{$row['MaximumWeightLoad']}</p></strong>";

        echo "<p>Width</p>";
        echo "<strong><p>{$row['Width']}</p></strong>";
    } else {
        echo "<p>No measurements found.</p>";
    }
}
?>
