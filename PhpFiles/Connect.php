<?php
// Database credentials
$host = 'localhost';   // Assuming the database is hosted locally
$dbname = 'ajmalfurniturehouse';  // Your database name
$username = 'root';     // Your database username
$password = '';         // Your database password (leave blank for local default)

// Set the DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    // Create a PDO instance
    $pdo = new PDO($dsn, $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // If connection fails, display an error message
    echo "Connection failed: " . $e->getMessage();
    exit;  // Stop further execution if connection fails
}
?>