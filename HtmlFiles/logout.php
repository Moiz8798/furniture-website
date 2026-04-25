<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logging Out</title>
    <script>
        alert("You have been logged out.");
        window.location.href = "login.php"; 
    </script>
</head>
<body>
</body>
</html>
