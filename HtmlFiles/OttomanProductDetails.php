<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ArtOttomanProductDetails</title>
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

            hr {
                width: 90%;
                border: 1px solid white;
            }

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
    }

    @media (max-width: 480px) {
        body {
            background-color: #000;  /* A fallback background color for mobile devices */
            background-size: auto;
        }
        .ArtDetails {
            width: 95%;
            margin-left: 2.5%;
        }
        h1 {
            font-size: 18px;
        }
        .video-container {
            display: none; /* Hide the video background on very small screens */
        }
    }

        </style>
    </head>
    <body>

        <!-- Video Background -->
        <div class="video-container">
            <video autoplay loop muted playsinline>
                <source src="../Images/SweetArtChairVideo.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <h1 style="margin-left: 5%;">Sweet Art Ottoman Product Details</h1>
        <div class="ArtDetails"> 
            <div class="Info">
                <?php
                include('../PhpFiles/db_connection.php'); 
                include('../PhpFiles/OttomanProductDetails.php'); 
                
                displayOttomanProductDetails($conn);
                ?>
                
            </div>
        </div>
    </body>
</html>
