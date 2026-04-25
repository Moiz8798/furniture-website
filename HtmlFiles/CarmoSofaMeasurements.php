<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CarmoSofaMeasurementsDetails</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="icon" type="image/png" href="../Images/MainIcon.png">

        <style>
            body, html {
                margin: 0;
                padding: 0;
                height: 100%;
                overflow: hidden;
            }

            /* Video background container */
            .video-container {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
                z-index: -1;
            }

            video {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                min-width: 100%;
                min-height: 100%;
            }

            /* Dark overlay */
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: -1;
            }

            body {
                text-align: center;
                font-family: Arial, sans-serif;
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
@media (max-width: 1200px) {
    .ArtDetails {
        width: 60%;
        margin-left: 20%;
        padding: 15px;
    }

    h1 {
        font-size: 2em;
    }

    h2 {
        font-size: 1.5em;
    }
}

@media (max-width: 992px) {
    .ArtDetails {
        width: 70%;
        margin-left: 15%;
        padding: 15px;
    }

    h1 {
        font-size: 1.8em;
    }

    h2 {
        font-size: 1.3em;
    }
}

@media (max-width: 768px) {
    .ArtDetails {
        width: 80%;
        margin-left: 10%;
        padding: 10px;
    }

    h1 {
        font-size: 1.6em;
    }

    h2 {
        font-size: 1.2em;
    }
}

@media (max-width: 576px) {
    .ArtDetails {
        width: 90%;
        margin-left: 5%;
        padding: 10px;
    }

    h1 {
        font-size: 1.4em;
    }

    h2 {
        font-size: 1.1em;
    }
}

        </style>
    </head>
    <body>
        <div class="video-container">
            <video autoplay loop muted>
                <source src="../Images/CarmoSofaVideo.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <div class="overlay"></div>

        <h1 style="margin-left: 5%; color: white;">Carmo Sofa Measurements Details</h1>
        <h2 style="color: white;text-align: center;">Dimensions and weights</h2>
        <div class="ArtDetails"> 
            <div class="Info">
                <?php
                include('../PhpFiles/db_connection.php'); 
                include('../PhpFiles/CarmoMeasurements.php'); 
                
                getCarmoMeasurements($conn);
                ?>
            </div>
        </div>
    </body>
</html>
