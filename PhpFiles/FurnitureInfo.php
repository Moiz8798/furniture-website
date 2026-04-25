<?php
function Info($conn) {
    $sql = "SELECT * FROM furnitureinfo";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $boxCount = 1;
        while ($row = $result->fetch_assoc()) {
            $boxClass = "Box" . $boxCount++;
            $name = htmlspecialchars($row['Name']);
            $image = htmlspecialchars($row['image']);
            $href = htmlspecialchars($row['href']); 

            echo "<div class='$boxClass'>";
            echo "<a href='$href'><img src='../Images/$image' alt='$name' title='$name'></a>";
            echo "<p>$name</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No furniture items found.</p>";
    }
}
?>
