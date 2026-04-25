<?php
session_start(); 

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];  // Initialize cart if not set
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];

    // Add product to session cart (increase quantity if already present)
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]++;
    } else {
        $_SESSION['cart'][$productId] = 1;
    }

    // Redirect back to avoid form resubmission on page refresh
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Calculate cart count
$cartCount = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $qty) {
        $cartCount += $qty;
    }
}


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HomePage</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="icon" type="image/png" href="../Images/MainIcon.png">
    <link rel="stylesheet" href="../CSSFiles/Wstyle.css">

    
    <style>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    padding-top: 70px; /* Space for fixed navbar */
    height: 200vh; /* Add scrolling space */
}

.video-container {
    display: flex;
    justify-content: center;
    margin-top: 20px; 
    padding: 10px;
}

iframe {
    min-width: 1400px; 
    max-width: 2000px;
    height: 500px;
    border-radius: 20px;
    margin-top: -80;
}

h2 {
    margin-top: 3%;
    text-indent: 3%;
}

.AllBoxes {
    display: flex;
    flex-direction: row;    
    flex-wrap: wrap;
    justify-content: space-evenly;
    align-items: center; 
    gap: 20px; 
}

.AllBoxes div {
    text-align: center; 
    width: 200px; 
}

.AllBoxes img {
    width: 100%; 
    height: auto; 
    border-radius: 3%;
}

.AllBoxes p {
    margin-top: 5px; 
    font-weight: bold;
}

.Decor {
    background-image: url(../Images/RoomDecor.jpg);
    width: 100%;
    height: 50%;
    background-size: cover;
    background-repeat: no-repeat;
    margin-top: 3%;
    border-radius: 3%;
    justify-content: center;
    align-items: center;
    color: rgba(248, 248, 248, 0.815);
    font-size: 28px;
    font-weight: bold;
    text-shadow: 2px 2px 5px rgba(39, 34, 34, 0.7); 
}

.Decor h1 {
    text-align: center;
    padding-top: 15%;
}

.HelenaPicks {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-evenly;
    align-items: center; 
    gap: 20px; 
}

.MoizStyle {
    display: flex;
    gap: 5px;
}

.Inspired {
    background-image: url(../Images/Inspired.jpg);
    width: 100%;
    height: 50%;
    background-size: cover;
    background-repeat: no-repeat;
    margin-top: 3%;
    border-radius: 3%;
    justify-content: center;
    align-items: center;
    color: rgba(248, 248, 248, 0.815);
    font-size: 28px;
    font-weight: bold;
    text-shadow: 2px 2px 5px rgba(194, 154, 154, 0.7); 
}

.End {
    display: flex;
    gap: 8px;
}

.OtherInfo {
    display: flex;
    gap: 8px;
}

/* Media Queries */

/* For tablets (max width 1024px) */
@media (max-width: 1024px) {
    iframe {
        min-width: 90%;
        height: 400px;
    }

    .AllBoxes div {
        width: 150px;
    }

    .Decor h1,
    .Inspired h1 {
        font-size: 24px;
        padding-top: 10%;
    }
}

/* For mobile devices (max width 768px) */
@media (max-width: 768px) {
    iframe {
        min-width: 100%;
        height: 300px;
    }

    .AllBoxes {
        flex-direction: column;
        align-items: center;
    }

    .AllBoxes div {
        width: 80%;
    }

    .HelenaPicks {
        flex-direction: column;
        align-items: center;
    }

    .MoizStyle {
        flex-direction: column;
        gap: 10px;
    }

    .End {
        flex-direction: column;
        gap: 10px;
    }

    .OtherInfo {
        flex-direction: column;
        gap: 10px;
    }

    .Decor h1,
    .Inspired h1 {
        font-size: 20px;
        padding-top: 8%;
    }
}
</style>

</style>
</head>
<body>
<div class="navbar">
    <div class="nav-left">
      <button class="menu-btn" onclick="toggleMenu()"><i class="fa fa-bars"></i></button>
      <div class="nav-links">
        <a href="Windex2.html">Furniture</a>
        <a href="Windex3.html">Rooms</a>
        <a href="Windex4.html">Professionals</a>
      </div>
    </div>
    <div class="logo"><a href="HomePage.php" style="color: black;text-decoration:none;">Ajmal Furniture</a></div>
    <div class="nav-right">
      <div class="search-wrapper">
        <input class="search-transparent" type="text" placeholder="What can we help you find?"/>
        <i class="fa fa-search search-icon"></i>
      </div>
      <div class="shopping-bag" style="position: relative;">
    <a href="viewcart.php" style="position: relative;">
        <i class="fa-solid fa-bag-shopping" style="font-size: 24px;"></i>
        <?php if ($cartCount > 0): ?>
            <span style="
                position: absolute;
                top: -8px;
                right: -10px;
                background: red;
                color: white;
                border-radius: 50%; 
                padding: 2px 6px;
                font-size: 12px;
                font-weight: bold;
            ">
                <?php echo $cartCount; ?>
            </span>
        <?php endif; ?>
    </a>
</div>
    
    </div>
  </div>

  <!-- Side Menu -->
  <div class="side-menu" id="sideMenu">
    <div class="menu-header">
      <strong>The Art of Living Danishly</strong>
      <button onclick="toggleMenu()"><i class="fa fa-times"></i></button>
    </div>
    <ul class="menu-list">
      <li class="menu-item" onclick="openSubMenu('furniture')">Furniture <i class="fa fa-chevron-right"></i></li>
      <li class="menu-item" onclick="openSubMenu('collections')">Collections <i class="fa fa-chevron-right"></i></li>
      <li class="menu-item">Outlet <i class="fa fa-chevron-right"></i></li>
      <li class="menu-item" onclick="openSubMenu('rooms')">Rooms <i class="fa fa-chevron-right"></i></li>
    </ul>
  </div>

  <!-- Submenu -->
  <div class="submenu" id="submenu">
    <div class="submenu-header">
      <button onclick="closeSubMenu()"><i class="fa fa-chevron-left"></i> Back</button>
    </div>
    <h3 id="submenu-title"></h3>
    <p id="submenu-description"></p>
    <ul class="submenu-items" id="submenu-items"></ul>
  </div>

  <script src="../JSFiles/Wmain.js"></script>
<div class="video-container">
    <iframe src="../Images/HomePageVideo.mp4" 
        title="HomePageVideo" frameborder="0" allowfullscreen>
    </iframe>
</div>

<h2 style="margin-bottom: 2%;">What are you looking for?</h2>

<div class="AllBoxes"> 

<?php

include('../PhpFiles/FurnitureInfo.php');
include('../PhpFiles/db_connection.php');
Info($conn);
$conn->close();
?>

</div>

<div class="Decor">
   <h1>Ajmal Furniture Collections</h1>
   <p style="margin-left: 5%;">"Our new Global Artistic Director, Helena Christensen, has hand-selected the AjmalFurniture designs
    she enjoys in her own Moiz summerhouse and New York apartment, to share with like-minded people."</p>
   
</div>

<h1 style="text-indent: 5%; margin-top: 3%; margin-bottom: 3%">Helena's Picks</h1>

<div class="HelenaPicks">


<?php

include('../PhpFiles/picks.php');
include('../PhpFiles/db_connection.php');

displayProduct("Sweet Art Chair with swivel base", "ArtChair.php", $conn);
displayProduct("Sweet Art ottoman", "ArtOttoman.php", $conn);
displayProduct("Bergamo sofa with round lounging unit,right", "BergamoSofa.php", $conn);
displayProduct("Bolzano chair with swivel base", "BalzoneChair.php", $conn);
displayProduct("Bellagio pouf", "BellagioPouf.php", $conn);
displayProduct("Madrid coffee table", "MadridCoffeeTable.php", $conn);
displayProduct("Seoul dining chair", "DiningChair.php", $conn);
displayProduct("Carmo corner sofa", "CarmoSofa.php", $conn);

$conn->close();
?>
</div>



<p style="font-size: larger; text-align: center; margin-top: 5%; font-weight: bold;">What makes the Moiz esthetic unique?</p>
<h1 style="text-align: center;">Live in Moiz style. Live Ekstraordinær.</h1>


<div class="MoizStyle">

        <div class="Style1">
        <img src="../Images/Style1.jpg" alt="MoizStyle1" title="MoizStyle1" style="width: 90%;margin-left: 4%; margin-top: 3%;">
        <h3 style="text-indent: 4%;">Our signature minimalist style</h3>
        <p style="font-family: DM Serif Text;width:600px; text-align: justify; margin-left: 4%; line-height: 1.5;">As Helena says of the Moiz propensity for style: 
                "Moiz have this innate sensitivity towards creating beautiful homes.” 
                This is embodied in her personal selection of statement pieces, 
                including the Imola chair.</p>
        </div>

        <div class="Style2">
            <img src="../Images/Style2.jpg" alt="MoizStyle2" title="MoizStyle2" style="width: 90%; height: 81%; margin-left: 4%; margin-top: 3%;">
            <h3 style="text-indent: 4%;">Focus on functionality and craftsmanship</h3>
            <p style="font-family: DM Serif Text;width:600px; text-align: justify; margin-left: 4%; line-height: 1.5;" >Our dining pieces embody our Moiz design philosophy, where meticulous craftsmanship and 
                thoughtful design come together to enhance everyday living,
                 in those small details that matter a lot.</p>
            </div>           
</div>



<div class="Inspired">
<h1 style="text-align: center; padding-top: 20%;">Be inspired in-Store</h1>
</div>



<div class="End">
    <div>
    <h1 style="margin-top: 3%; margin-left: 1%; width:450px;">Danish Design Furniture and Interior Design</h1>
    <p style="text-align: justify; width: 600px; margin-left:1%;">Looking for Danish Design Furniture? Our dedicated customer services team is ready to answer any enquiries you may have. Whether it's about our services, products, or something else – we are here to help.</p>
    <a href="Map.html"> <img src="../Images/Help.jpg" alt="NeedHelp" title="NeedHelp" style="height: 60%; width: 70%; margin-top: 2%"> </a>
    <p style="margin-left: 18%; font-weight: bold;">Our Location</p>
 </div>

    <div>
        <h2 style="margin-left:25px; width: 450px; margin-top: 5%;">Chat with our Interior designers</h2>
        <p style="text-align: justify; width: 500px; margin-left:8%;">Speak directly with one of our interior designers to bring your vision to life. Our experts are ready to offer personalized advice, creative solutions, and guidance tailored to your unique style and space.</p>
        <hr style="margin-left: 8%; margin-top: 2%; width: 550px;">

        <h2 style="margin-left:5.5%; width: 450px; margin-top: 3%;">Customer Services</h2>
        <p style="text-align: justify; width: 500px; margin-left:8%;">Explore our Customer Services page for detailed information about assembly, delivery, sampling, warranties and a variety of other helpful services.</p>
        <hr style="margin-left: 8%; margin-top: 2%; width: 550px;">

        <h2 style="margin-left:5.5%; width: 450px; margin-top: 3%;">Looking for a career with us?</h2>
        <p style="text-align: justify; width: 500px; margin-left:8%;">BoConcept is continuously opening new stores around the world, which means that we are always looking for dynamic and competent staff. Above all, we look for staff that are service-minded and open-minded, responsible, independent and enthusiastic in the way they work. Individuals, that identify with both our concept and corporate image.</p>

        <div>
            <img src="../Images/FebricSamples.jpg" alt="FabricSamples" title="FabricSamples" style="width: 350px; margin-top:5%; height: 150px; margin-left: 20%;">
            <p style="margin-left: 35%; font-weight: bold;">Get free fabric samples</p>
        </div>
    </div>
</div>

<div style="margin-top: 0%;">
    <hr style="width: 90%; margin-left: 4.5%; color: gray;">
</div>


<div class="OtherInfo">
    <div style="margin-left: 5%; margin-top: 2%;">
        <ul>
            <li>Contact Info</li>
            <li>Learn more about Ajmal Furniture</li>
            <li>Our Achievements</li>
        </ul>

        <div style="margin-top: 7%;">
         <a href="logout.php" style="padding: 5px;text-decoration: none; border: 2px solid gray; background-color: black; color: white; font-weight: bold;">Logout</a>
        </div>
    </div>

    <div>
        <h2 style="width: 300px; margin-left: 199%;">Get our newsletter.</h2>
        <p style="width: 300px; margin-left: 200%; margin-top: 2%;">Get a front row seat to our collektion launches and trends – directly to your inbox.</p>
    </div>
</div>



<div style="margin-top: 3%;">
    <hr style="width: 100%; margin-left: 0%; color: lightgray;">
</div>


<div>
    <footer style="display: flex;">
    <div>
            <p style="margin-top: 2%;">All prices are recommended retail prices in US Dollars ($) and exclude sales tax.</p>   
        </div>   

        <div style="margin-top:1%; display: flex;" >
        <a href="https://www.google.com" style="text-decoration: none; color: black;"><p style="margin-left: 95px; width: 70%;">Cookie information</p></a>
        
        <div style="display: flex;">
         <a href="https://www.google.com" style="text-decoration: none; color: black;"><p style="margin-left: 75px; width: 70%;">Terms & Conditions</p></a>
            
         <div>
            <a href="https://www.google.com" style="text-decoration: none; color: black;"><p style="width: 70%; margin-left:75px;">Privacy Policy</p></a>
         </div>     
        </div>
</div>
    </footer>



<div style="display: flex; gap: 20px;">
    <img src="../Images/VisaCard.png" alt="VisaCard" title="VisaCard" height="40px" style="margin-left: 5%; margin-top: 0%;">

    <div>
        <img src="../Images/DebitCreditCard.png" alt="DebitCreditCard" title="DebitCreditCard" height="40px">
  </div>
</div>

</div>

</body>
</html>
