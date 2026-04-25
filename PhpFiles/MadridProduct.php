<?php
function getMadridProductDetails($conn) {
    $sql = "SELECT * FROM madridproductdetails LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo '
        <p style="color: white;">Size</p> 
        <strong><p>' . $row["size"] . '</p></strong>

        <p style="color: white;">Leg</p> 
        <strong><p>' . $row["leg"] . '</p></strong>

        <p style="color: white;">Tabletop</p> 
        <strong><p>' . $row["tabletop"] . '</p></strong>

        <p style="color: white;">Designed By</p> 
        <strong><p>' . $row["designed_by"] . '</p></strong>

        <p style="color: white;">Shape</p> 
        <strong><p>' . $row["shape"] . '</p></strong>

        <hr style="width: 90%;">

        <h3 style="font-size: 24px;">Surface Finish</h3>
        <div>
            <p style="color: white;">Tabletop</p> 
            <strong><p>' . $row["tabletop_finish"] . '</p></strong>
        </div>

        <hr style="width: 90%;">

        <div>
            <h3 style="font-size: 24px;">Manufacturer</h3>
            <p style="color: white;">' . $row["manufacturer"] . '</p>
        </div>
        ';
    } else {
        echo "<p style='color: white;'>No product details found.</p>";
    }
}
?>
