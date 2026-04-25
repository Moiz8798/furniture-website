
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
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
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    .auth-box h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .input-group {
        margin-bottom: 20px;
    }

    .input-group label {
        display: block;
        margin-bottom: 5px;
        color: #333;
    }

    .input-group input {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-top: 5px;
    }

    .btn {
        width: 100%;
        padding: 10px;
        background-color: #5bbc0b;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #4a9b08;
    }

    .signup-link {
        text-align: center;
        margin-top: 10px;
    }

    .signup-link a {
        color: #5bbc0b;
        text-decoration: none;
    }

    /* Media Queries */
    @media (max-width: 768px) {
        .auth-box {
            padding: 30px;
            width: 90%;
        }

        .auth-box h2 {
            font-size: 1.5em;
        }

        .input-group input {
            font-size: 16px;
        }

        .btn {
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .auth-box {
            padding: 20px;
            width: 90%;
        }

        .auth-box h2 {
            font-size: 1.3em;
        }

        .input-group input {
            font-size: 14px;
        }

        .btn {
            font-size: 12px;
        }
    }
</style>

</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h2>Login</h2>
            <form method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required placeholder="Enter your username">
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Enter your password">
                </div>
                <button type="submit" class="btn">Login</button>
                <p class="signup-link">Don't have an account? <a href="register.php">Register here</a></p>
            </form>
        </div>
    </div>

    <?php
session_start(); // Start the session

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    // If session is set, redirect to payment.php
    header("Location: payment.php");
    exit();
}

// If the form is submitted (POST request)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'ajmalfurniturehouse');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, first_name, last_name, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $first_name, $last_name, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Store user data in session
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;

            // Redirect to payment.php after successful login
            header("Location: payment.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Username not found.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>


</body>
</html>
