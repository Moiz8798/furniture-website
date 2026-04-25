<?php
function displayOttomanMeasurements($conn) {
    $sql = "SELECT * FROM ottomanmeasurements LIMIT 1"; 
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo "<p>Depth</p>";
        echo "<strong><p>{$row['Depth']}</p></strong>";
        echo "<hr>";

        echo "<p>Height</p>";
        echo "<strong><p>{$row['Height']}</p></strong>";
        echo "<hr>";

        echo "<div><p>Weight</p>";
        echo "<strong><p>{$row['Weight']}</p></strong></div>";
        echo "<hr>";

        echo "<div><p>Maximum Weight Load</p>";
        echo "<strong><p>{$row['MaximumWeightLoad']}</p></strong></div>";
        echo "<hr>";

        echo "<div><p>Width</p>";
        echo "<strong><p>{$row['Width']}</p></strong></div>";
    } else {
        echo "<p>No ottoman measurements found.</p>";
    }
}
?>
