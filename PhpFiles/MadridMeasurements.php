<?php
function displayMadridMeasurements($conn) {
    $sql = "SELECT * FROM madridmeasurements LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo '
        <p style="color: white;">Diameter</p> 
        <strong><p>' . $row["diameter"] . '</p></strong>
        <hr style="width: 90%;">

        <p style="color: white;">Height</p> 
        <strong><p>' . $row["height"] . '</p></strong>
        <hr style="width: 90%;">

        <div>
            <p style="color: white;">Height to table top</p> 
            <strong><p>' . $row["height_to_table_top"] . '</p></strong>       
        </div>
        <hr style="width: 90%;">

        <div>
            <p style="color: white;">Tabletop thickness</p> 
            <strong><p>' . $row["tabletop_thickness"] . '</p></strong>   
        </div>
        <hr style="width: 90%;">

        <div>
            <p style="color: white;">Weight</p> 
            <strong><p>' . $row["weight"] . '</p></strong>   
        </div>
        <hr style="width: 90%;">

        <div>
            <p style="color: white;">Maximum weight Load</p> 
            <strong><p>' . $row["max_weight_load"] . '</p></strong>   
        </div>';
    } else {
        echo "<p style='color: white;'>No measurement data found.</p>";
    }
}
?>
