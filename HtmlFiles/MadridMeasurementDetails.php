<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>MadridCoffeeTableMeasurementsDetails</title>
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

            <style>
    /* Media Queries */
    @media (max-width: 1200px) {
        .ArtDetails {
            width: 70%;
            margin-left: 15%;
        }
        h1 {
            font-size: 24px;
            margin-left: 10%;
        }
        h2 {
            font-size: 18px;
        }
    }

    @media (max-width: 768px) {
        .ArtDetails {
            width: 90%;
            margin-left: 5%;
        }
        h1 {
            font-size: 20px;
            margin-left: 0;
        }
        h2 {
            font-size: 16px;
        }
    }

    @media (max-width: 480px) {
        body {
            background-size: auto;
        }
        .ArtDetails {
            width: 95%;
            margin-left: 2.5%;
        }
        h1 {
            font-size: 18px;
        }
        h2 {
            font-size: 14px;
        }
    }
</style>

        </style>
    </head>
    <body>
        <h1 style="margin-left: 5%; color: white;">Madrid Coffee Table Measurements Details</h1>
        <h2 style="color: white;text-align: center;">Dimensions and weights</h2>
        <div class="ArtDetails"> 
            <div class="Info">
            <?php
                include('../PhpFiles/db_connection.php'); 
                include('../PhpFiles/MadridMeasurements.php'); 
                
                displayMadridMeasurements($conn);
                ?>

                
            </div>
        </div>
    </body>
</html>
