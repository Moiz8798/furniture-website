<?php
function displayChairDetails($conn) {
    $sql = "SELECT * FROM sweetartchairproductdetails LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo "<p>Upholstery</p><strong><p>{$row['Upholstery']}</p></strong>";
        echo "<p>Designed By</p><strong><p>{$row['DesignedBy']}</p></strong>";

        echo "<hr style='width: 90%;'><h3 style='font-size: 24px;'>Materials</h3>";

        echo "<div><p>Back</p><strong><p>{$row['Back']}</p></strong></div>";
        echo "<div><p>Frame</p><strong><p>{$row['Frame']}</p></strong></div>";
        echo "<div><p>Seat</p><strong><p>{$row['Seat']}</p></strong></div>";
        echo "<div><p>Fabric lining</p><strong><p>{$row['FabricLining']}</p></strong></div>";
        echo "<div><p>Upholstery composition</p><strong><p>{$row['UpholsteryComposition']}</p></strong></div>";

        echo "<hr style='width: 90%;'><div><h3 style='font-size: 24px;'>Manufacturer</h3>";
        echo "<p>{$row['Manufacturer']}</p></div>";
    } else {
        echo "<p>No details found.</p>";
    }
}
?>
