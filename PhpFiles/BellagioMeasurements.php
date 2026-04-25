<?php
function getBellagioMeasurements($conn) {
    $sql = "SELECT * FROM bellagiomeasurements LIMIT 1"; // Get one record
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

        <div>
            <p style="color: white;">Weight</p> 
            <strong><p>' . $row["Weight"] . '</p></strong>   
        </div>
        <hr style="width: 90%;">

        <div>
            <p style="color: white;">Maximum Weight load</p> 
            <strong><p>' . $row["MaximumWeightLoad"] . '</p></strong>   
        </div>
        <hr style="width: 90%;">

        <div>
            <p style="color: white;">Width</p> 
            <strong><p>' . $row["Width"] . '</p></strong>   
        </div>';
    } else {
        echo "<p style='color: red;'>No data found in bellagiomeasurements.</p>";
    }

    $conn->close();
}
?>
