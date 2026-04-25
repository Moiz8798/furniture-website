<?php
function getCarmoProductDetails($conn) {
    $sql = "SELECT * FROM carmoproductdetails LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        echo '
        <p style="color: white;">Upholstery</p>
        <strong><p>' . $row['upholstery'] . '</p></strong>

        <p style="color: white;">Designed By</p>
        <strong><p>' . $row['designed_by'] . '</p></strong>
        <hr style="width: 90%;">

        <p style="color: white;">Leg Style</p>
        <strong><p>' . $row['leg_style'] . '</p></strong>
        <hr style="width: 90%;">

        <h3 style="font-size: 24px;">Materials</h3>

        <div>
            <p style="color: white;">Armrest</p>
            <strong><p>' . $row['armrest_materials'] . '</p></strong>
        </div>

        <div>
            <p style="color: white;">Back</p>
            <strong><p>' . $row['back_materials'] . '</p></strong>   
        </div>

        <div>
            <p style="color: white;">Frame</p>
            <strong><p>' . $row['frame_materials'] . '</p></strong>   
        </div>

        <div>
            <p style="color: white;">Seat</p>
            <strong><p>' . $row['seat_materials'] . '</p></strong>   
        </div>

        <div>
            <p style="color: white;">Upholstery Composition</p>
            <strong><p>' . $row['upholstery_composition'] . '</p></strong>   
        </div>

        <hr style="width: 90%;">

        <div>
            <h3 style="font-size: 24px;">Manufacturer</h3>
            <p style="color: white;">' . $row['manufacturer'] . '</p>
        </div>';
    } else {
        echo "<p style='color: white;'>No product details found.</p>";
    }
}
?>
