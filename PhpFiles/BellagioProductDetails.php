<?php
function displayBellagioProductDetails($conn) {
    $sql = "SELECT * FROM bellagioproductdetails LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        echo '<p style="color: white;">Upholstery</p>';
        echo '<strong><p>' . $row["Upholstery"] . '</p></strong>';

        echo '<p style="color: white;">Designed By</p>';
        echo '<strong><p>' . $row["DesignedBy"] . '</p></strong>';

        echo '<p style="color: white;">Leg Style</p>';
        echo '<strong><p>' . $row["LegStyle"] . '</p></strong>';

        echo '<hr style="width: 90%;">';

        echo '<h3 style="font-size: 24px;">Materials</h3>';
        echo '<div>';
        echo '<p style="color: white;">Surface finish</p>';
        echo '<strong><p>' . $row["SurfaceFinish"] . '</p></strong>';
        echo '</div>';

        echo '<div>';
        echo '<p style="color: white;">Upholstery composition</p>';
        echo '<strong><p>' . $row["UpholsteryComposition"] . '</p></strong>';
        echo '</div>';

        echo '<hr style="width: 90%;">';

        echo '<div>';
        echo '<h3 style="font-size: 24px;">Manufacturer</h3>';
        echo '<p style="color: white;">' . $row["Manufacturer"] . '</p>';
        echo '</div>';
    } else {
        echo '<p style="color: white;">No data found.</p>';
    }
}
?>
