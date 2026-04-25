<?php
session_start();

// Database connection
$connection = mysqli_connect("localhost", "root", "", "ajmalfurniturehouse");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cartItems = [];
$total = 0;

// Fetch product details for cart items
if (!empty($_SESSION['cart'])) {
    $productIds = array_keys($_SESSION['cart']);
    if (!empty($productIds)) {
        $idsString = implode(',', array_map('intval', $productIds));
        $sql = "SELECT * FROM products WHERE id IN ($idsString)";
        $result = mysqli_query($connection, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $row['quantity'] = $_SESSION['cart'][$row['id']];
            $row['subtotal'] = $row['Price'] * $row['quantity'];
            $cartItems[] = $row;
            $total += $row['subtotal'];
        }
    }
}

// Calculate cart count
$cartCount = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $qty) {
        $cartCount += $qty;
    }
}

// Handle cart updates (update quantity or remove item)
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_qty'])) {
        $index = $_POST['item_index'];
        $newQty = (int)$_POST['quantity'];

        if ($newQty > 0) {
            $productId = $cartItems[$index]['id'];
            $_SESSION['cart'][$productId] = $newQty;
        } else {
            $productId = $cartItems[$index]['id'];
            unset($_SESSION['cart'][$productId]);
        }
        $message = "Cart updated successfully!";
        header("Location: viewcart.php");
        exit;
    } elseif (isset($_POST['remove_item'])) {
        $index = $_POST['item_index'];
        $productId = $cartItems[$index]['id'];
        unset($_SESSION['cart'][$productId]);
        $message = "Item removed from cart!";
        header("Location: viewcart.php");
        exit;
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart - Ajmal Furniture House</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/> 
    <style>
        /* Navbar and menu styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
            border-bottom: 1px solid #eee;
        }

        .nav-left {
            display: flex;
            align-items: center;
        }

        .menu-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            margin-right: 20px;
        }

        .nav-links a {
            margin: 0 15px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .logo a {
            color: black;
            text-decoration: none;
        }

        .nav-right {
            display: flex;
            align-items: center;
        }

        .search-wrapper {
            position: relative;
            margin-right: 20px;
        }

        .search-transparent {
            padding: 8px 40px 8px 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
            outline: none;
        }

        .search-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        .shopping-bag {
            position: relative;
            font-size: 20px;
        }

        .shopping-bag a {
            color: black;
            text-decoration: none;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -10px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
            font-weight: bold;
        }

        .side-menu {
            position: fixed;
            top: 0;
            left: -300px;
            width: 300px;
            height: 100%;
            background: #fff;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            transition: left 0.3s ease;
        }

        .side-menu.active {
            left: 0;
        }

        .menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .menu-list {
            list-style: none;
            padding: 0;
        }

        .menu-item {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .submenu {
            position: fixed;
            top: 0;
            left: -300px;
            width: 300px;
            height: 100%;
            background: #fff;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            transition: left 0.3s ease;
        }

        .submenu.active {
            left: 0;
        }

        .submenu-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        /* Cart container styles */
        .cart-container {
            display: flex;
            gap: 30px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .cart-items {
            flex: 2;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .order-summary {
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .item-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
        }

        .item-details {
            flex: 1;
            padding: 0 15px;
        }

        .item-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .item-finish {
            color: #666;
            font-size: 0.9em;
        }

        .item-price {
            font-weight: bold;
            color: #2c3e50;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .quantity-btn {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            padding: 5px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }

        .remove-btn {
            background: #ff4444;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }

        .remove-btn:hover {
            background: #cc0000;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .summary-total {
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #eee;
        }

        .checkout-btn {
            background: #4CAF50;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 4px;
            width: 100%;
            margin-top: 20px;
            cursor: pointer;
            font-size: 1.1em;
        }

        .checkout-btn:hover {
            background: #45a049;
        }

        .empty-cart {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .success-message {
            color: #2ecc71;
            background-color: #e6ffe6;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .cart-container {
                flex-direction: column;
            }
            
            .order-summary {
                position: static;
            }

            .navbar {
                flex-direction: column;
            }

            .nav-left, .nav-right {
                display: block;
                width: 100%;
                text-align: center;
                margin-top: 10px;
            }

            .logo {
                font-size: 18px;
                margin-top: 10px;
                text-align: center;
            }

            .menu-btn {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }

            .side-menu {
                width: 80%;
                padding: 10px;
            }

            .submenu {
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            .nav-links a {
                margin: 0 10px;
            }

            .search-transparent {
                width: 100%;
            }
        }

        /* Footer styles */
        .footer {
            background: #f8f9fa;
            padding: 20px;
            margin-top: 20px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-left ul {
            list-style: none;
            padding: 0;
        }

        .footer-left ul li {
            margin-bottom: 10px;
        }

        .footer-left ul li a {
            text-decoration: none;
            color: #333;
        }

        .footer-right {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .newsletter h2 {
            font-size: 1.2em;
        }

        .newsletter-btn {
            background: none;
            border: none;
            color: #333;
            cursor: pointer;
            font-weight: bold;
        }

        .social-links h3 {
            font-size: 1.1em;
        }

        .social-icons {
            display: flex;
            gap: 10px;
        }

        .social-icon {
            width: 30px;
            height: 30px;
            background: #ddd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            margin: 20px auto 0;
            font-size: 0.9em;
        }

        .footer-legal a {
            margin: 0 10px;
            text-decoration: none;
            color: #333;
        }

        .payment-options {
            display: flex;
            gap: 10px;
        }

        .payment-icon {
            width: 30px;
            height: 20px;
            background: #ddd;
            border-radius: 4px;
        }

        .country-selector {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        @media (max-width: 768px) {
            .footer {
                flex-direction: column;
                text-align: center;
            }

            .footer-content {
                flex-direction: column;
                align-items: center;
            }

            .footer-left, .footer-right {
                width: 100%;
                margin-bottom: 20px;
            }

            .footer-bottom {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .footer-legal a {
                margin: 5px 0;
                display: inline-block;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="nav-left">
            <button class="menu-btn" onclick="toggleMenu()"><i class="fa fa-bars"></i></button>
            <div class="nav-links">
                <a href="Windex2.html">Furniture</a>
                <a href="Windex3.html">Rooms</a>
                <a href="Windex4.html">Professionals</a>
            </div>
        </div>
        <div class="logo"><a href="HomePage.php">Ajmal Furniture</a></div>
        <div class="nav-right">
            <div class="search-wrapper">
                <input class="search-transparent" type="text" placeholder="What can we help you find?"/>
                <i class="fa fa-search search-icon"></i>
            </div>
            <div class="shopping-bag">
                <a href="viewcart.php">
                    <i class="fa-solid fa-bag-shopping" style="font-size: 24px;"></i>
                    <?php if ($cartCount > 0): ?>
                        <span class="cart-count"><?php echo $cartCount; ?></span>
                    <?php endif; ?>
                </a>
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
        <h1 style="margin-left: 20px;">Shopping Cart</h1>
        
        <?php if ($message): ?>
            <div class="success-message"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if (empty($cartItems)): ?>
            <div class="empty-cart">
                <h2>Your cart is empty</h2>
                <p>Browse our collection to add items to your cart</p>
                <a href="HomePage.php" class="checkout-btn" style="display: inline-block; width: auto; padding: 10px 20px;">Continue Shopping</a>
            </div>
        <?php else: ?>
            <div class="cart-container">
                <div class="cart-items">
                    <h2>Cart Items</h2>
                    <?php foreach ($cartItems as $index => $item): ?>
                        <div class="cart-item">
                            <img src="<?php echo htmlspecialchars($item['Image'] ?? 'placeholder.jpg'); ?>" alt="<?php echo htmlspecialchars($item['Name']); ?>" class="item-image">
                            <div class="item-details">
                                <div class="item-name"><?php echo htmlspecialchars($item['Name']); ?></div>
                                <div class="item-finish">Material: <?php echo htmlspecialchars($item['Material']); ?></div>
                                <div class="item-price">Rs <?php echo number_format($item['subtotal']); ?></div>
                                <div class="quantity-controls">
                                    <form method="post" action="">
                                        <input type="hidden" name="item_index" value="<?php echo $index; ?>">
                                        <input type="hidden" name="update_qty" value="1">
                                        <button type="button" class="quantity-btn" onclick="updateQuantity(this.form, -1)">-</button>
                                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" class="quantity-input" min="1" max="10">
                                        <button type="button" class="quantity-btn" onclick="updateQuantity(this.form, 1)">+</button>
                                    </form>
                                    <form method="post" action="">
                                        <input type="hidden" name="item_index" value="<?php echo $index; ?>">
                                        <input type="hidden" name="remove_item" value="1">
                                        <button type="submit" class="remove-btn">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="order-summary">
                    <h2>Order Summary</h2>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>Rs <?php echo number_format($total); ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Tax (5%)</span>
                        <span>Rs <?php echo number_format($total * 0.05); ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    <div class="summary-row summary-total">
                        <span>Total</span>
                        <span>Rs <?php echo number_format($total * 1.05); ?></span>
                    </div>
                    <button class="checkout-btn" onclick="window.location.href='login.php'">
                        Proceed to Checkout
                    </button>
                    <a href="HomePage.php" style="display: block; text-align: center; margin-top: 15px; color: #666; text-decoration: none;">
                        Continue Shopping
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left">
                <ul class="footer-links">
                    <li><a href="#">Customer Service</a></li>
                    <li><a href="#">Find a store</a></li>
                    <li><a href="#">About Ajmal</a></li>
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

    <script>
        function toggleMenu() {
            document.getElementById('sideMenu').classList.toggle('active');
        }

        function openSubMenu(menu) {
            document.getElementById('submenu').classList.add('active');
        }

        function closeSubMenu() {
            document.getElementById('submenu').classList.remove('active');
        }

        function updateQuantity(form, change) {
            const input = form.querySelector('input[name="quantity"]');
            let newValue = parseInt(input.value) + change;
            if (newValue >= 1 && newValue <= 10) {
                input.value = newValue;
                form.submit();
            }
        }
    </script>
</body>
</html>