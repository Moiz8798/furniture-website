<?php
function getCarmoMeasurements($conn) {
    $sql = "SELECT * FROM carmomeasurements LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        echo '
        <p style="color: white;">Depth</p>
        <strong><p>' . $row['depth'] . '</p></strong>
        <hr style="width: 90%;">

        <p style="color: white;">Height</p>
        <strong><p>' . $row['height'] . '</p></strong>
        <hr style="width: 90%;">

        <div>
            <p style="color: white;">Seating Height</p>
            <strong><p>' . $row['seating_height'] . '</p></strong>        
        </div>
        <hr style="width: 90%;">

        <div>
            <p style="color: white;">Weight</p>
            <strong><p>' . $row['weight'] . '</p></strong>   
        </div>
        <hr style="width: 90%;">

        <div>
            <p style="color: white;">Legs Height</p>
            <strong><p>' . $row['legs_height'] . '</p></strong>   
        </div>
        <hr style="width: 90%;">

        <div>
            <p style="color: white;">Width</p>
            <strong><p>' . $row['width'] . '</p></strong>   
        </div>';
    } else {
        echo "<p style='color: white;'>No Carmo measurements found.</p>";
    }
}
?>
