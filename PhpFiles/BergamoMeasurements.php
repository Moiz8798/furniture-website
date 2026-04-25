<?php
function displayBergamoMeasurements($conn) {
    $sql = "SELECT * FROM bergamomeasurements LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo "<p style='color: white;'>Depth</p>";
        echo "<strong><p>{$row['Depth']}</p></strong>";
        echo "<hr style='width: 90%;'>";

        echo "<p style='color: white;'>Height</p>";
        echo "<strong><p>{$row['Height']}</p></strong>";
        echo "<hr style='width: 90%;'>";

        echo "<div><p style='color: white;'>Seating Height</p>";
        echo "<strong><p>{$row['SeatingHeight']}</p></strong></div>";
        echo "<hr style='width: 90%;'>";

        echo "<div><p style='color: white;'>Weight</p>";
        echo "<strong><p>{$row['Weight']}</p></strong></div>";
        echo "<hr style='width: 90%;'>";

        echo "<div><p style='color: white;'>Legs Height</p>";
        echo "<strong><p>{$row['LegsHeight']}</p></strong></div>";
        echo "<hr style='width: 90%;'>";

        echo "<div><p style='color: white;'>Armrest Height</p>";
        echo "<strong><p>{$row['ArmrestHeight']}</p></strong></div>";
        echo "<hr style='width: 90%;'>";

        echo "<div><p style='color: white;'>Width</p>";
        echo "<strong><p>{$row['Width']}</p></strong></div>";
    } else {
        echo "<p style='color: white;'>No Bergamo measurements found.</p>";
    }
}
?>
