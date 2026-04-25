<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>BellagioPoufProductDetails</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../Images/MainIcon.png">

        <style>
            body {
                text-align: center;
                font-family: Arial, sans-serif;
                color: white;
                margin: 0;
                padding: 0;
                position: relative;
                overflow: hidden;
            }

            .video-container {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1;
                overflow: hidden;
            }

            .video-container video {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                min-width: 100%;
                min-height: 100%;
                width: auto;
                height: auto;
                object-fit: cover;
            }

            h1 {
                margin-left: 5%;
                color: white;
            }

            .ArtDetails {
                border: 4px solid transparent;
                width: 50%;
                margin-left: 28%;
                padding: 20px;
                border-radius: 10px;
                animation: glowing-border 3s infinite alternate;
                background-color: rgba(0, 0, 0, 0.6);
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
                }

                h1 {
                    font-size: 20px;
                }
            }
        </style>
    </head>
    <body>

        <div class="video-container">
            <video autoplay loop muted playsinline>
                <source src="../Images/BellagioPoufVideo.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <h1>Bellagio Pouf Product Details</h1>

        <div class="ArtDetails"> 
            <div class="Info">
                <?php
                    include('../PhpFiles/db_connection.php'); 
                    include('../PhpFiles/BellagioProductDetails.php');
                    displayBellagioProductDetails($conn);
                ?>
            </div>
        </div>
    </body>
</html>
