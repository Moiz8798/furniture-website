<?php
function displayProduct($name, $href, $conn) {
    $sql = "SELECT * FROM picks WHERE Name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $image = "../Images/{$row['Image']}";
        $productName = htmlspecialchars($row['Name']);
        $material = htmlspecialchars($row['Material']);
        $price = number_format($row['Price'], 2);
        $startingPrice = number_format($row['StartingPrice'], 2);

        echo <<<HTML
        <div class='product'>
            <a href='$href'>
                <img src='$image' alt='$productName' title='$productName'>
            </a>
            <p>$productName</p>
            <p>$material</p>
            <p style='color: gray; font-size: 70%;'>Rec. Retail Price</p>
            <p style='font-weight: bold;'>\$$price</p>
            <p style='color: darkgray; font-size: 70%;'>From \$$startingPrice</p>
        </div>
        HTML;
    } else {
        echo "<p>Product not found: " . htmlspecialchars($name) . "</p>";
    }

    $stmt->close();
}
?>
