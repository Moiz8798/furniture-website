<?php
session_start();
include_once('connect.php');

$productType = isset($_GET['type']) ? $_GET['type'] : '';
$productId = isset($_GET['product_id']) ? $_GET['product_id'] : '';

$category = $productType;

$product = null;
if ($productId && $productType) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id AND Category = :category");
        $stmt->execute(['id' => $productId, 'category' => $category]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $product = $stmt->fetch();
    } catch (PDOException $e) {
        echo "Error fetching product: " . $e->getMessage();
        exit;
    }
}

if (!$product) {
    echo "<h2>Product not found!</h2>";
    exit;
}

$productName = $product['Name'];
$productImage = $product['Image'];
$productPrice = $product['Price'];
$productMaterial = $product['Material'];

$discountPrice = $productPrice * 0.85;

$recomendedproducts = [];
if ($productType) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE Category = :category AND id != :id LIMIT 4");
        $stmt->execute(['category' => $category, 'id' => $productId]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $recomendedproducts = $stmt->fetchAll();
    } catch (PDOException $e) {
        echo "Error fetching suggested products: " . $e->getMessage();
        exit;
    }
}

$message = '';
$Options = in_array($category, ['sofa', 'beds', 'chairs', 'tables', 'storage', 'outdoor']);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected = isset($_POST['selected']) ? $_POST['selected'] : '';
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    // Adding item to cart, updating cart value
    $cartItem = [
        'name' => $productName,
        'price' => $discountPrice,
        'image' => $productImage,
        'quantity' => 1
    ];
    if ($selected !== '') {
        $cartItem['selected'] = $selected;
    }
    $_SESSION['cart'][] = $cartItem;
    
    if ($Options && $selected !== '') {
        $message = "<p class='success-message'>Added to Cart ($selected)</p>";
    } else {
        $message = "<p class='success-message'>Added to Cart</p>";
    }
}

// Calculate cart item count
$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo htmlspecialchars($productName); ?> - Ajmal Furniture House</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="style.css">    
    <link rel="stylesheet" href="index1.css">
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <div class="navbar">
        <div class="nav-left">
            <button class="menu-btn" onclick="toggleMenu()"><i class="fa fa-bars"></i></button>
            <div class="nav-links">
                <a href="index2.html">Furniture</a>
                <a href="index3.html">Rooms</a>
                <a href="index4.html">Professionals</a>
            </div>
        </div>
        <a href="../HtmlFiles/HomePage.php" style="text-decoration: none;color: inherit;">
  <div class="logo">Ajmal Furniture</div>
            </a>
        <div class="nav-right">
            <div class="search-wrapper">
                <input class="search-transparent" type="text" placeholder="What can we help you find?"/>
                <i class="fa fa-search search-icon"></i>
            </div>
            <div class="shopping-bag" style="position: relative;">
                <a href="viewcart.php"><i class="fa-solid fa-bag-shopping"></i></a>
                <?php if ($cartCount > 0): ?>
                    <span class="cart-count"><?php echo $cartCount; ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Side Menu -->
    <div class="side-menu" id="sideMenu">
        <div class="menu-header">
            <strong>The Art of Living Danishly</strong>
            <button onclick="toggleMenu()"><i class="fa fa-times"></i></button>
        </div>
        <ul class="menu-list">
            <li class="menu-item" onclick="openSubMenu('furniture')">Furniture <i class="fa fa-chevron-right"></i></li>
            <li class="menu-item" onclick="openSubMenu('collections')">Collections <i class="fa fa-chevron-right"></i></li>
            <li class="menu-item">Outlet <i class="fa fa-chevron-right"></i></li>
            <li class="menu-item" onclick="openSubMenu('rooms')">Rooms <i class="fa fa-chevron-right"></i></li>
        </ul>
    </div>

    <!-- Submenu -->
    <div class="submenu" id="submenu">
        <div class="submenu-header">
            <button onclick="closeSubMenu()"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
        <h3 id="submenu-title"></h3>
        <p id="submenu-description"></p>
        <ul class="submenu-items" id="submenu-items"></ul>
    </div>

    <div class="container">
        <h1><?php echo htmlspecialchars($productName); ?></h1>
        <?php if ($message): ?>
            <?php echo $message; ?>
        <?php endif; ?>

        <div class="product-grid">
            <div class="product-picture">
                <img src="<?php echo htmlspecialchars($productImage); ?>" alt="<?php echo htmlspecialchars($productName); ?>">
            </div>

            <div class="product-info">
                <div class="details">
                    <?php if (!empty($productMaterial)): ?>
                        <p><strong>Material:</strong> <?php echo htmlspecialchars($productMaterial); ?></p>
                    <?php endif; ?>
                    <p><strong>Rec. retail price</strong></p>
                    <p><span class="price">Rs <?php echo number_format($discountPrice); ?></span></p>
                    <p><span class="original-price">Rs <?php echo number_format($productPrice); ?></span></p>
                    <p><strong>Estimated Delivery:</strong> 6-8 weeks</p>
                </div>

                <form method="post" action="">
                    <?php if ($Options): ?>
                        <div class="finish-options">
                            <h3>Choose your finish:</h3>
                            <label><input type="radio" name="colors" value="Brown Lazio" checked> Brown Lazio</label>
                            <label><input type="radio" name="colors" value="Beige Linen"> Beige Linen</label>
                            <label><input type="radio" name="colors" value="Grey Velvet"> Grey Velvet</label>
                            <label><input type="radio" name="colors" value="Navy Blue"> Navy Blue</label>
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>

    <?php if (!empty($recomendedproducts)): ?>
        <div class="recommended-section">
            <h2>We also recommend</h2>
            <div class="recommended-grid">
                <?php foreach ($recomendedproducts as $index => $suggested): ?>
                    <div class="recommended-product">
                        <span class="label"><?php echo ($index % 2 == 0) ? 'Popular' : "Ajmal's choice"; ?></span>
                        <a href="addtocart.php?type=<?php echo strtolower($category); ?>&product_id=<?php echo htmlspecialchars($suggested['id']); ?>">
                            <img src="<?php echo htmlspecialchars($suggested['Image']); ?>" alt="<?php echo htmlspecialchars($suggested['Name']); ?>">
                            <h3><?php echo htmlspecialchars($suggested['Name']); ?></h3>
                            <p><?php echo htmlspecialchars($suggested['Material']); ?></p>
                            <div>
                                <span class="price">Rs <?php echo number_format($suggested['Price'] * 0.85); ?></span>
                                <span class="original-price">Rs <?php echo number_format($suggested['Price']); ?></span>
                            </div>
                            <div class="color-swatches">
                                <div class="color-swatch" style="background-color: #8B4513;"></div>
                                <div class="color-swatch" style="background-color: #D2B48C;"></div>
                                <div class="color-swatch" style="background-color: #808080;"></div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left">
                <ul class="footer-links">
                    <li><a href="#">Customer Service</a></li>
                    <li><a href="#">Find a store</a></li>
                    <li><a href="#">About BoConcept</a></li>
                    <li><a href="#">Press lounge</a></li>
                </ul>
            </div>
            <div class="footer-right">
                <div class="newsletter">
                    <h2>Get our newsletter.</h2>
                    <p>Get a front row seat to our collection launches and trends – directly to your inbox.</p>
                    <button class="newsletter-btn">Sign up here. <span>→</span></button>
                </div>
                <div class="social-links">
                    <h3>Follow us</h3>
                    <div class="social-icons">
                        <div class="social-icon">FB</div>
                        <div class="social-icon">IG</div>
                        <div class="social-icon">X</div>
                        <div class="social-icon">YT</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div>
                <p>All prices are recommended retail prices in US Dollars ($) and exclude sales tax.</p>
            </div>
            <div class="footer-legal">
                <a href="#">Cookie information</a>
                <a href="#">Terms & Conditions</a>
                <a href="#">Privacy Policy</a>
            </div>
            <div class="payment-options">
                <div class="payment-icon">ApplePay</div>
                <div class="payment-icon">Mastercard</div>
                <div class="payment-icon">Visa</div>
            </div>
            <div class="country-selector">
                <div class="flag">🇺🇸</div>
                <span>United States</span>
                <span>▼</span>
            </div>
        </div>
    </footer>
    <script src="script.js"></script> 
    <script src="main.js"></script>
    <script>
        document.querySelector('.hamburger').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
        });
    </script>
</body>
</html>