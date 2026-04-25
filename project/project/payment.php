
<?php
session_start();
include_once('connect.php');

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login to proceed to checkout!'); window.location.href='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];
$data = null;
$sql = "SELECT * FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    echo "<p class='error'>User not found! Please login again.</p>";
    exit();
}

$items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
$count = 0;
$msg = '';
$show = true;
$done = false;
$receipt = "";

if (empty($items)) {
    $msg = "Cart is empty! Add items first.";
    $show = false;
} else {
    foreach ($items as $product_id => $item) {
        $price = $item['price'] * $item['quantity'];
        $total += $price;
        $count += $item['quantity'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $show) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $pay = $_POST['payment'];

    if ($data) {
        $sql = "UPDATE users SET username = :username, email = :email, address = :address, phone = :phone WHERE id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $name, 'email' => $email, 'address' => $address, 'phone' => $phone, 'user_id' => $user_id]);
    }

    $order_date = date("Y-m-d H:i:s");
    $delivery = date("Y-m-d H:i:s", strtotime($order_date . " +7 days"));
    $cart_data = json_encode($items);

    $sql = "INSERT INTO orders (user_id, cart_items, shipping_address, delivery_date, total_price, payment_method, order_date) 
            VALUES (:user_id, :cart_items, :shipping_address, :delivery_date, :total_price, :payment_method, :order_date)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id, 'cart_items' => $cart_data, 'shipping_address' => $address, 'delivery_date' => $delivery, 'total_price' => $total, 'payment_method' => $pay, 'order_date' => $order_date]);

    $order_num = $pdo->lastInsertId();
    $receipt = "<h2>Order Receipt</h2>";
    if ($order_num == 0) {
        $msg = "Order placed, but couldn't get ID. Please contact support with your order details.";
        $receipt .= "<p>Order ID: Not available (contact support)</p>";
    } else {
        $receipt .= "<p>Order ID: $order_num</p>";
    }
    $receipt .= "<p>User ID: $user_id</p>";
    $receipt .= "<p>Username: $name</p>";
    $receipt .= "<p>Email: $email</p>";
    $receipt .= "<p>Shipping Address: $address</p>";
    $receipt .= "<p>Phone: $phone</p>";
    $receipt .= "<p>Order Date: $order_date</p>";
    $receipt .= "<p>Delivery Date: $delivery</p>";
    $receipt .= "<p>Payment Method: $pay</p>";
    $receipt .= "<h3>Items:</h3>";
    foreach ($items as $product_id => $item) {
        $item_total = $item['price'] * $item['quantity'];
        $receipt .= "<p>Product: " . htmlspecialchars($item['name']) . " | Quantity: " . $item['quantity'] . " | Price: Rs " . number_format($item_total);
        if (isset($item['finish'])) {
            $receipt .= " | Finish: " . htmlspecialchars($item['finish']);
        }
        $receipt .= "</p>";
    }
    $receipt .= "<p><strong>Total Price: Rs " . number_format($total) . "</strong></p>";
    $receipt .= "<div style='text-align: center; margin-top: 20px;'>";
    $receipt .= "<a href='../HtmlFiles/HomePage.php' style='text-decoration: none; color: #fff; background-color: #4CAF50; padding: 10px 20px; border-radius: 5px; margin-right: 10px;'>Continue Shopping</a>";
    $receipt .= "<a href='logout.php' style='text-decoration: none; color: #fff; background-color: #f44336; padding: 10px 20px; border-radius: 5px;'>Logout</a>";
    $receipt .= "</div>";

    $_SESSION['cart'] = [];
    $items = [];
    $count = 0;
    $done = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment Page</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/> 
    <link rel="stylesheet" href="payment.css"> 
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
        <div class="logo"><a href="../HtmlFiles/HomePage.php" style="color: inherit;text-decoration:none;">Ajmal Furniture</a></div>
        <div class="nav-right">
            <div class="search-wrapper">
                <input class="search-transparent" type="text" placeholder="What can we help you find?"/>
                <i class="fa fa-search search-icon"></i>
            </div>
            <div class="shopping-bag">
                <a href="viewcart.php">
                    <i class="fa-solid fa-bag-shopping" style="font-size: 24px;"></i>
                    <?php if ($count > 0): ?>
                        <span class="cart-count"><?php echo $count; ?></span>
                    <?php endif; ?>
                </a>
            </div>
            <div class="logout-link" style="margin-left: 20px;">
                <a href="logout.php" style="text-decoration: none; color: #f44336; font-weight: bold;">Logout</a>
            </div>
        </div>
    </div>

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

    <div class="submenu" id="submenu">
        <div class="submenu-header">
            <button onclick="closeSubMenu()"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
        <h3 id="submenu-title"></h3>
        <p id="submenu-description"></p>
        <ul class="submenu-items" id="submenu-items"></ul>
    </div>

    <div class="container">
        <h1>Payment</h1>

        <?php if ($msg != ''): ?>
            <p class="error"><?php echo $msg; ?></p>
        <?php elseif ($done): ?>
            <div class="receipt-box">
                <?php echo $receipt; ?>
            </div>
        <?php elseif ($show): ?>
            <div class="payment-container">
                <div class="payment-form">
                    <h2>Shipping & Payment Details</h2>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($data['username'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($data['email'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Shipping Address</label>
                            <textarea id="address" name="address" required><?php echo htmlspecialchars($data['address'] ?? ''); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($data['phone'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="payment">Payment Method</label>
                            <select id="payment" name="payment" required>
                                <option value="">Select Payment Method</option>
                                <option value="Cash on Delivery">Cash on Delivery</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="PayPal">PayPal</option>
                            </select>
                        </div>
                        <button type="submit" class="place-order-btn">Pay Now</button>
                    </form>
                </div>

                <div class="order-summary">
                    <h2>Order Summary</h2>
                    <?php foreach ($items as $product_id => $item): ?>
                        <div class="cart-item">
                            <img src="<?php echo htmlspecialchars($item['image'] ?? 'placeholder.jpg'); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="item-image">
                            <div class="item-details">
                                <div class="item-name"><?php echo htmlspecialchars($item['name']); ?></div>
                                <div class="item-finish">
                                    <?php echo isset($item['finish']) ? 'Finish: ' . htmlspecialchars($item['finish']) : ''; ?>
                                </div>
                                <div class="item-price">Rs <?php echo number_format($item['price'] * $item['quantity']); ?> (Qty: <?php echo $item['quantity']; ?>)</div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
    <script src="script.js"></script>
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
    </script>
</body>
</html>
