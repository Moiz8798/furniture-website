<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet">
    <style>
        <style>
    /* Base Styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .auth-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .auth-box {
        background-color: #fff;
        padding: 40px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        border-radius: 8px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .input-group {
        margin-bottom: 15px;
    }

    .input-group label {
        display: block;
        margin-bottom: 5px;
    }

    .input-group input,
    .input-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .input-group textarea {
        resize: vertical;
    }

    .btn {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #45a049;
    }

    .login-link {
        text-align: center;
        margin-top: 15px;
    }

    .login-link a {
        color: #007bff;
    }

    /* Media Queries */
    @media (max-width: 768px) {
        .auth-box {
            width: 80%;
            padding: 20px;
        }

        h2 {
            font-size: 22px;
        }

        .input-group input,
        .input-group textarea {
            padding: 8px;
        }

        .btn {
            padding: 12px;
            font-size: 16px;
        }
    }

    @media (max-width: 480px) {
        .auth-box {
            width: 90%;
            padding: 15px;
        }

        h2 {
            font-size: 20px;
        }

        .input-group input,
        .input-group textarea {
            padding: 6px;
        }

        .btn {
            padding: 15px;
            font-size: 18px;
        }

        .login-link {
            font-size: 14px;
        }
    }
</style>

        </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h2>Register</h2>
            <form method="POST">
                <div class="input-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first-name" required placeholder="Enter your first name">
                </div>
                <div class="input-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last-name" required placeholder="Enter your last name">
                </div>
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required placeholder="Choose a username">
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="Enter your email">
                </div>
                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" required placeholder="Enter your phone number">
                </div>
                <div class="input-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" required placeholder="Enter your address"></textarea>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Choose a password">
                </div>
                <div class="input-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" required placeholder="Confirm your password">
                </div>
                <button type="submit" class="btn">Register</button>
                <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
            </form>
        </div>
    </div>
    <?php
// Process the form submission if POST method is used
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Password matching check
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'ajmalfurniturehouse');  // Update with your DB credentials

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert query
    $sql = "INSERT INTO users (first_name, last_name, username, email, phone, address, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $first_name, $last_name, $username, $email, $phone, $address, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

</body>
</html>
