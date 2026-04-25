<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ArtChairProductDetails</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../Images/MainIcon.png">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            text-align: center;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: white;
            position: relative;
            overflow: hidden;
        }

        /* Video background */
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
            margin: 20px 0;
            font-size: 32px;
        }

        .ArtDetails {
            border: 4px solid transparent;
            width: 50%;
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.6);
            animation: glowing-border 3s infinite alternate;
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


        @media (max-width: 1024px) {
            .ArtDetails {
                width: 70%;
                padding: 15px;
            }

            h1 {
                font-size: 28px;
            }
        }

        @media (max-width: 768px) {
            .ArtDetails {
                width: 90%;
                padding: 10px;
            }

            h1 {
                font-size: 24px;
            }

            .video-container video {
                object-fit: cover;
            }
        }

        @media (max-width: 480px) {
            .ArtDetails {
                width: 95%;
                padding: 8px;
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
            <source src="../Images/SweetArtChairVideo.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <h1>Sweet Art Chair Product Details</h1>
    <div class="ArtDetails"> 
        <div class="Info">
            <?php
            include('../PhpFiles/db_connection.php');
            include('../PhpFiles/SweetArtChairProductDetails.php');
            
            displayChairDetails($conn);
            ?>
        </div>
    </div>
</body>
</html>
