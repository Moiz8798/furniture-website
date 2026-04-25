<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>BolzoneChairProductDetails</title>
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

            /* Video Background */
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

            /* Media Queries */
            @media (max-width: 1024px) {
                .ArtDetails {
                    width: 70%;
                    margin-left: 15%;
                    padding: 18px;
                }
                h1 {
                    font-size: 1.8em;
                    margin-left: 0;
                }
            }

            @media (max-width: 768px) {
                .ArtDetails {
                    width: 85%;
                    margin-left: 7.5%;
                    padding: 15px;
                }
                h1 {
                    font-size: 1.6em;
                }
            }

            @media (max-width: 480px) {
                .ArtDetails {
                    width: 95%;
                    margin-left: 2.5%;
                    padding: 12px;
                }
                h1 {
                    font-size: 1.4em;
                }
            }
        </style>  
    </head>
    <body>

        <div class="video-container">
            <video autoplay loop muted playsinline>
                <source src="../Images/BalzoneChairVideo.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <h1 style="margin-left: 5%; color: white;">Bolzone Chair Product Details</h1>
        <div class="ArtDetails"> 
            <div class="Info">
            <?php
        include('../PhpFiles/db_connection.php'); 
        include('../PhpFiles/BolzoneProductDetails.php');

        getBolzoneProductDetails($conn);
?>
            </div>
        </div>
    </body>
</html>
