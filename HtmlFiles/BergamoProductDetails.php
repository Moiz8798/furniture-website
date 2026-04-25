<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>BergamoProductDetails</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="icon" type="image/png" href="../Images/MainIcon.png">

        <style>
body {
    text-align: center;
    background-color: #f4f4f4;
    font-family: Arial, sans-serif;
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
    url('../Images/ArtChairProductDetailsBackgroundImage.jpg') no-repeat center center fixed;
    background-size: cover;
}

.ArtDetails {
    border: 4px solid transparent;
    width: 50%;
    margin-left: 28%;
    padding: 20px;
    border-radius: 10px;
    animation: glowing-border 3s infinite alternate;
    background-color: transparent;
}

@keyframes glowing-border {
    0% {
        border-color: #ada504;
        box-shadow: 0 0 5px #ada504;
    }
    50% {
        border-color: #5bbc0b;
        box-shadow: 0 0 10px #5bbc0b;
    }
    100% {
        border-color: darkslategrey;
        box-shadow: 0 0 15px darkslategrey;
    }
}

/* Media Queries for responsiveness */
@media screen and (max-width: 768px) {
    .ArtDetails {
        width: 80%;
        margin-left: 10%;
    }

    h1 {
        font-size: 24px;
    }
}

@media screen and (max-width: 480px) {
    .ArtDetails {
        width: 90%;
        margin-left: 5%;
        padding: 15px;
    }

    h1 {
        font-size: 20px;
    }
}

        </style>
    </head>
    <body>
        <h1 style="margin-left: 5%; color: white;">Bergamo Sofa Product Details</h1>
        <div class="ArtDetails"> 
            <div class="Info">
            <?php
        include('../PhpFiles/db_connection.php'); 
        include('../PhpFiles/BergamoProductDetails.php');

        getBergamoProductDetails($conn);
?>

            </div>
        </div>
    </body>
</html>
