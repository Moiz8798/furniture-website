<?php
session_start();
include_once('../project/project/connect.php');

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login to proceed to checkout!'); window.location.href='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];
$cartItems = [];
$total_price = 0;
$cart_count = 0;
$user_info = null;
$msg = '';
$show_form = true;
$order_done = false;
$receipt_text = "";

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $msg = "Cart is empty! Add items first.";
    $show_form = false;
} else {
    $productIds = array_keys($_SESSION['cart']);
    if (!empty($productIds)) {
        try {
            $placeholders = implode(',', array_fill(0, count($productIds), '?'));
            $sql = "SELECT id, Name, Price, Image, Material FROM products WHERE id IN ($placeholders)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($productIds);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($products as $product) {
                $product['quantity'] = $_SESSION['cart'][$product['id']];
                $product['subtotal'] = $product['Price'] * $product['quantity'];
                $cartItems[$product['id']] = [
                    'name' => $product['Name'],
                    'price' => $product['Price'],
                    'quantity' => $product['quantity'],
                    'image' => $product['Image'],
                    'material' => $product['Material']
                ];
                $total_price += $product['subtotal'];
                $cart_count += $product['quantity'];
            }
        } catch (PDOException $e) {
            $msg = "Error fetching products: " . $e->getMessage();
            $show_form = false;
            error_log("Product fetch error: " . $e->getMessage());
        }
    }
}

try {
    $sql = "SELECT * FROM users WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user_info) {
        $msg = "User not found! Please login again.";
        $show_form = false;
    }
} catch (PDOException $e) {
    $msg = "Error fetching user: " . $e->getMessage();
    $show_form = false;
    error_log("User fetch error: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $show_form) {
    if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['address']) || empty($_POST['payment'])) {
        $msg = "Please fill all required fields.";
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'] ?? '';
        $payment_method = $_POST['payment'];

        try {
            if ($user_info) {
                $sql = "UPDATE users SET username = :username, email = :email, address = :address, phone = :phone WHERE id = :user_id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'username' => $username,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                    'user_id' => $user_id
                ]);
            } else {
                $sql = "INSERT INTO users (id, username, email, address, phone) VALUES (:user_id, :username, :email, :address, :phone)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'user_id' => $user_id,
                    'username' => $username,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone
                ]);
            }

            $order_date = date("Y-m-d");
            $delivery_date = date("Y-m-d", strtotime($order_date . " +7 days"));
            $cart_json = json_encode($cartItems);

            $sql = "INSERT INTO orders (user_id, cart_items, shipping_address, delivery_date, total_price, payment_method, order_date) 
                    VALUES (:user_id, :cart_items, :shipping_address, :delivery_date, :total_price, :payment_method, :order_date)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'user_id' => $user_id,
                'cart_items' => $cart_json,
                'shipping_address' => $address,
                'delivery_date' => $delivery_date,
                'total_price' => $total_price,
                'payment_method' => $payment_method,
                'order_date' => $order_date
            ]);

            $order_id = $pdo->lastInsertId();
            $receipt_text = "<h2>Order Receipt</h2>";
            if ($order_id == 0) {
                $msg = "Order placed, but couldn't get ID. Please contact support with your order details.";
                $receipt_text .= "<p>Order ID: Not available (contact support)</p>";
            } else {
                $receipt_text .= "<p>Order ID: $order_id</p>";
            }
            $receipt_text .= "<p>User ID: $user_id</p>";
            $receipt_text .= "<p>Username: " . htmlspecialchars($username) . "</p>";
            $receipt_text .= "<p>Email: " . htmlspecialchars($email) . "</p>";
            $receipt_text .= "<p>Shipping Address: " . htmlspecialchars($address) . "</p>";
            $receipt_text .= "<p>Phone: " . htmlspecialchars($phone) . "</p>";
            $receipt_text .= "<p>Order Date: $order_date</p>";
            $receipt_text .= "<p>Delivery Date: $delivery_date</p>";
            $receipt_text .= "<p>Payment Method: " . htmlspecialchars($payment_method) . "</p>";
            $receipt_text .= "<h3>Items:</h3>";
            foreach ($cartItems as $item) {
                $item_total = $item['price'] * $item['quantity'];
                $receipt_text .= "<p>Product: " . htmlspecialchars($item['name']) . " | Quantity: " . $item['quantity'] . 
                                 " | Price: Rs " . number_format($item_total) . 
                                 " | Material: " . htmlspecialchars($item['material']) . "</p>";
            }
            $receipt_text .= "<p><strong>Total Price: Rs " . number_format($total_price) . "</strong></p>";
            $receipt_text .= "<div style='text-align: center; margin-top: 20px;'>";
            $receipt_text .= "<a href='HomePage.php' style='text-decoration: none; color: #fff; background-color: #4CAF50; padding: 10px 20px; border-radius: 5px; margin-right: 10px;'>Continue Shopping</a>";
            $receipt_text .= "<a href='logout.php' style='text-decoration: none; color: #fff; background-color: #f44336; padding: 10px 20px; border-radius: 5px;'>Logout</a>";
            $receipt_text .= "</div>";

            $_SESSION['cart'] = [];
            $cart_count = 0;
            $order_done = true;
            $show_form = false;
        } catch (PDOException $e) {
            $msg = "Failed to place order: " . $e->getMessage();
            $show_form = false;
            error_log("Order processing error: " . $e->getMessage());
            try {
                $schema = $pdo->query("DESCRIBE orders")->fetchAll(PDO::FETCH_COLUMN);
                error_log("Orders table columns: " . implode(", ", $schema));
            } catch (PDOException $schemaError) {
                error_log("Failed to fetch Orders table schema: " . $schemaError->getMessage());
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment Page</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/> 
    <link rel="stylesheet" href="../project/project/payment.css"> 
    <style>
        .logout {
            display: flex;
            align-items: center;
            margin-left: 15px;
        }
        .logout-link {
            color: #000;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .logout-link:hover {
            color: #007bff;
        }
        .nav-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .shopping-bag {
            position: relative;
            display: flex;
            align-items: center;
        }
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff0000;
            color: #fff;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }
    </style>
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
        <div class="logo"><a href="HomePage.php">Ajmal Furniture</a></div>
        <div class="nav-right">
            <div class="search-wrapper">
                <input class="search-transparent" type="text" placeholder="What can we help you find?"/>
                <i class="fa fa-search search-icon"></i>
            </div>
            <div class="shopping-bag">
                <a href="viewcart.php">
                    <i class="fa-solid fa-bag-shopping" style="font-size: 24px;"></i>
                    <?php if ($cart_count > 0): ?>
                        <span class="cart-count"><?php echo $cart_count; ?></span>
                    <?php endif; ?>
                </a>
            </div>
            <div class="logout">
                <a href="logout.php" class="logout-link" title="Logout">
                    <i class="fa-solid fa-sign-out-alt" style="font-size: 24px;"></i>
                </a>
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
        <?php elseif ($order_done): ?>
            <div class="receipt-box">
                <?php echo $receipt_text; ?>
            </div>
        <?php elseif ($show_form): ?>
            <div class="payment-container">
                <div class="payment-form">
                    <h2>Shipping & Payment Details</h2>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user_info['username'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_info['email'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Shipping Address</label>
                            <textarea id="address" name="address" required><?php echo htmlspecialchars($user_info['address'] ?? ''); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user_info['phone'] ?? ''); ?>">
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
                    <?php foreach ($cartItems as $item): ?>
                        <div class="cart-item">
                            <img src="<?php echo htmlspecialchars($item['image'] ?? 'placeholder.jpg'); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="item-image">
                            <div class="item-details">
                                <div class="item-name"><?php echo htmlspecialchars($item['name']); ?></div>
                                <div class="item-finish">
                                    Material: <?php echo htmlspecialchars($item['material']); ?>
                                </div>
                                <div class="item-price">Rs <?php echo number_format($item['price'] * $item['quantity']); ?> (Qty: <?php echo $item['quantity']; ?>)</div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>Rs <?php echo number_format($total_price); ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Tax (5%)</span>
                        <span>Rs <?php echo number_format($total_price * 0.05); ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    <div class="summary-row summary-total">
                        <span>Total</span>
                        <span>Rs <?php echo number_format($total_price * 1.05); ?></span>
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