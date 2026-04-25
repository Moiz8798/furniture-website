<?php
function getBolzoneProductDetails($conn) {
    $sql = "SELECT * FROM bolzoneproductdetails LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo '
        <p style="color: white;">Upholstery</p>
        <strong><p>' . $row["Upholstery"] . '</p></strong>

        <p style="color: white;">Designed By</p>
        <strong><p>' . $row["DesignedBy"] . '</p></strong>

        <hr style="width: 90%;">

        <h3 style="font-size: 24px;">Materials</h3>

        <div>
            <p style="color: white;">Back</p>
            <strong><p>' . $row["Back"] . '</p></strong>
        </div>

        <div>
            <p style="color: white;">Seat</p>
            <strong><p>' . $row["Seat"] . '</p></strong>
        </div>

        <div>
            <p style="color: white;">Upholstery composition</p>
            <strong><p>' . $row["UpholsteryComposition"] . '</p></strong>
        </div>

        <hr style="width: 90%;">

        <div>
            <h3 style="font-size: 24px;">Manufacturer</h3>
            <p style="color: white;">' . $row["Manufacturer"] . '</p>
        </div>';
    } else {
        echo "<p style='color: red;'>No data found.</p>";
    }

    $conn->close();
}
?>
