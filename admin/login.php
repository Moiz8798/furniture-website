```php
<?php
session_start();
require_once 'includes/db_connect.php';

if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Debug: Log input
    error_log("Login attempt: username=$username");

    $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username = ?");
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        $error = "Database error. Please try again.";
    } else {
        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error);
            $error = "Database error. Please try again.";
        } else {
            $result = $stmt->get_result();
            error_log("Query result rows: " . $result->num_rows);

            if ($result->num_rows == 1) {
                $admin = $result->fetch_assoc();
                error_log("Stored password: " . $admin['password']);
                if ($password === $admin['password']) {
                    $_SESSION['admin_id'] = $admin['id'];
                    error_log("Login successful for admin_id: " . $admin['id']);
                    header("Location: dashboard.php");
                    exit();
                } else {
                    error_log("Password mismatch");
                    $error = "Invalid username or password.";
                }
            } else {
                error_log("No user found with username: $username");
                $error = "Invalid username or password.";
            }
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Ajmal Furniture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <h2 class="text-center">Admin Login</h2>
                <?php if ($error) { ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php } ?>
                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="admin" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```