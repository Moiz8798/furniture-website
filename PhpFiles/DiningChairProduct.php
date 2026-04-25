<?php
function getDiningChairProductDetails($conn) {
    $sql = "SELECT * FROM diningchairproductdetails LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        echo '
        <p style="color: white;">Leg</p>
        <strong><p>' . htmlspecialchars($row['leg']) . '</p></strong>

        <p style="color: white;">Designed By</p>
        <strong><p>' . htmlspecialchars($row['designed_by']) . '</p></strong>

        <p style="color: white;">Upholstery</p>
        <strong><p>' . htmlspecialchars($row['upholstery']) . '</p></strong>

        <hr style="width: 90%;">
        <h3 style="font-size: 24px;">Materials</h3>

        <p style="color: white;">Frame</p>
        <strong><p>' . htmlspecialchars($row['frame_material']) . '</p></strong>

        <p style="color: white;">Seat</p>
        <strong><p>' . htmlspecialchars($row['seat_material']) . '</p></strong>

        <p style="color: white;">Upholstery composition</p>
        <strong><p>' . htmlspecialchars($row['upholstery_composition']) . '</p></strong>

        <hr style="width: 90%;">
        <h3 style="font-size: 24px;">Surface finish</h3>
        <p style="color: white;">' . htmlspecialchars($row['surface_finish']) . '</p>
        <hr style="width: 90%;">

        <h3 style="font-size: 24px;">Manufacturer</h3>
        <p style="color: white;">' . htmlspecialchars($row['manufacturer']) . '</p>';
    } else {
        echo "<p style='color: white;'>No product details found.</p>";
    }
}
?>
