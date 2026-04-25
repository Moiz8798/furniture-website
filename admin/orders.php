<?php
session_start();
require_once 'includes/db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Add status column to orders table if not exists
$conn->query("ALTER TABLE orders ADD COLUMN status VARCHAR(20) DEFAULT 'Pending'");

// Fetch orders
$result = $conn->query("SELECT o.*, u.username FROM orders o JOIN users u ON o.user_id = u.id");

// Update order status
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $order_id);
    $stmt->execute();
    $stmt->close();
    header("Location: orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Ajmal Furniture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'includes/sidebar.php'; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h2 class="mt-4">Orders</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Total Price</th>
                            <th>Payment Method</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td>$<?php echo number_format($row['total_price'], 2); ?></td>
                                <td><?php echo $row['payment_method']; ?></td>
                                <td><?php echo $row['order_date']; ?></td>
                                <td>
                                    <form method="POST" action="orders.php">
                                        <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                        <select name="status" class="form-select">
                                            <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                            <option value="Shipped" <?php if ($row['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                                            <option value="Delivered" <?php if ($row['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                                            <option value="Cancelled" <?php if ($row['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                                        </select>
                                        <button type="submit" name="update_status" class="btn btn-primary btn-sm mt-2">Update</button>
                                    </form>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderDetailsModal<?php echo $row['id']; ?>">View Details</button>
                                </td>
                            </tr>

                            <!-- Order Details Modal -->
                            <div class="modal fade" id="orderDetailsModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="orderDetailsModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="orderDetailsModalLabel<?php echo $row['id']; ?>">Order #<?php echo $row['id']; ?> Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>User:</strong> <?php echo $row['username']; ?></p>
                                            <p><strong>Shipping Address:</strong> <?php echo $row['shipping_address']; ?></p>
                                            <p><strong>Delivery Date:</strong> <?php echo $row['delivery_date']; ?></p>
                                            <p><strong>Cart Items:</strong></p>
                                            <ul>
                                                <?php
                                                $cart_items = json_decode($row['cart_items'], true);
                                                if (is_array($cart_items)) {
                                                    foreach ($cart_items as $item) {
                                                        $item_name = isset($item['name']) ? $item['name'] : (isset($item[key($item)]['name']) ? $item[key($item)]['name'] : 'Unknown');
                                                        $item_price = isset($item['price']) ? $item['price'] : (isset($item[key($item)]['price']) ? $item[key($item)]['price'] : '0');
                                                        $item_quantity = isset($item['quantity']) ? $item['quantity'] : (isset($item[key($item)]['quantity']) ? $item[key($item)]['quantity'] : '1');
                                                        echo "<li>$item_name - $item_quantity x $".number_format($item_price, 2)."</li>";
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>