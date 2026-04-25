<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];  
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]++;
    } else {
        $_SESSION['cart'][$productId] = 1;
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

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
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>BergamoSofa</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="icon" type="image/png" href="../Images/../Images/MainIcon.png">
        <link rel="stylesheet" href="../CSSFiles/Wstyle.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">



     
        <style>
            
.HelenaPicks{
    display: flex;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-evenly;
    align-items: center; 
    gap: 20px; 
}
@media (max-width: 600px) {
    .ArtOttoman {
        flex-direction: column;
        align-items: center;
    }

    .Images {
        width: 90% !important;
        margin-left: 0 !important;
    }

    .Info {
        width: 90% !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
    }

    .AllContainer {
        flex-direction: column;
        gap: 10%;
    }

    .Container1, .Container2 {
        width: 90% !important;
        margin-left: 0 !important;
        text-align: center;
    }

    .Details {
        flex-direction: column;
        gap: 10%;
    }

    .Box1, .Box2 {
        width: 90% !important;
        margin-left: auto;
        margin-right: auto;
    }

    .HelenaPicks {
        flex-direction: column;
        gap: 15px;
    }
}

@media (min-width: 601px) and (max-width: 900px) {
    .ArtOttoman {
        flex-direction: column;
        align-items: center;
    }

    .Images, .Info {
        width: 80% !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
    }

    .AllContainer {
        flex-direction: column;
        align-items: center;
        gap: 10%;
    }

    .Container1, .Container2 {
        width: 80% !important;
        margin-left: 0 !important;
        text-align: center;
    }

    .Details {
        flex-direction: column;
        align-items: center;
        gap: 10%;
    }

    .Box1, .Box2 {
        width: 80% !important;
    }

    .HelenaPicks {
        flex-wrap: wrap;
        gap: 20px;
    }
}



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
        

<div class="Container" style="border: 2px solid transparent;background-color:rgb(244, 244,244); padding-bottom: 10%; box-shadow:0px 0px 10px gray;">
    <div class="ArtOttoman" style="display: flex; margin-top: 5%; gap: 2%;">
           
    <?php
$connection = mysqli_connect("localhost", "root", "", "ajmalfurniturehouse");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$productName = 'Bergamo sofa with round lounging unit, right';
$sql = "SELECT * FROM products WHERE Name = '$productName'";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    ?>
    <div class="Images" style="border: 2px solid black; border-radius: 5px; display: flex; width: 53%; margin-left: 3%; border-radius: 3%;">
        <img src="<?php echo $row['Image']; ?>" alt="<?php echo $row['Name']; ?>" title="<?php echo $row['Name']; ?>" style="width: 100%; height: auto; object-fit: fill; border-radius:3%">
    </div>

    <div class="Info" style="margin-left: 5%; border: 2px solid black; width: 50%; margin-right: 3%; border-radius: 3%;">
        <p style="margin-left:5%; border: 1px solid black; width: 25%; background-color: red; color: white; border-radius: 4px; text-align: center;">Limited Time Only</p>
        <h1 style="color: black; text-align: center;"><?php echo $row['Name']; ?></h1>
        <h5 style="color: gray; margin-top: 10%; margin-left: 10%;">Rec.retail price</h5>
        <strong><p style="margin-left: 10%;">$<?php echo $row['Price']; ?></p></strong>
        <p style="margin-left: 10%; color:grey;">$<?php echo $row['StartingPrice']; ?></p>
        
        <form method="post" action="">
    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
    <button type="submit" name="add_to_cart" style="margin-left: 30%; width: 50%; padding-top: 3%; padding-bottom: 3%; font-size: 20px; background-color: black; color: white;">
        Add to cart
    </button>
</form>
        
        <p style="margin-top: 5%; margin-left: 10%;">Material: <strong><?php echo $row['Material']; ?></strong></p>
    </div>
    <?php
} else {
    echo "Product not found.";
}

mysqli_close($connection);
?>


</div>
</div>





<div class="AllContainer" style="display: flex; margin-top: 2%; gap: 20%;">

    <div class="Container1" style="width: 30%; margin-left: 5%; font-size: 24px">
        <strong><p>Bergamo by Morten Georgsen is organic luxury made comfortable. Bergamo combines extraordinary, individual comfort with an elegant esthetic. The result is a contemporary sofa with all-day comfort.</p></strong>

    </div>

    <div class="Container2">
        <button style="font-size: 20px; width: 150%; padding: 15px;background-color: black; color: white;" onclick="window.location.href='BergamoProductDetails.php'">Product Details</button>
        <button style="font-size: 20px; width: 150%; padding: 15px; margin-top: 10%;background-color: black; color: white;" onclick="window.location.href='BergamoMeasurementsDetails.php'">Measurements</button>

    </div>

</div>


<div clas="ArtImage" style="margin-top: 3%;">
    
        <img src="../Images/BergamoSofa6.jpg" alt="ArtOttoman6" title="ArtOttoman6" style="width: 97%; height: 10%; margin-left: 2%;margin-right: 2%; border: 2px solid transparent; border-radius: 10px; box-shadow:0px 0px 10px gray;">
</div>

<div class="Details" style="display: flex; gap:20%">
    <div class="Box1" style="border: 2px solid transparent; padding: 3px; text-align: center; width: 40%; background-color: rgb(250, 248,238); color: rgb(95, 76, 39); margin-left: 2%;">
        <h2 style="font-weight: bold; ">Customizable in over 120 ways</h2>
        <p>Bergamo can be customized in a variety of different fabrics and materials to suit your existing decor.</p>
    </div>

    <div class="Box2"  style="border: 2px solid transparent; padding: 3px; text-align: center; width: 40%; background-color: rgb(250, 248,238); color: rgb(95, 76, 39); margin-right: 1%;"> 
        <h2 style="font-weight: bold; ">Loose cushions</h2>
        <p>Change the depth of the seat by using the loose back cushions differently. Why not place the cushions against the armrests? In addition to providing extra armrest support, it will also allow you to sit comfortably on the sofa with your legs raised.</p>

    </div>
</div>

<h1 style="margin-top: 2%; margin-left: 2%;">We also recommend</h1>

 


<div class="HelenaPicks">

    <div class="SweetChair">
        <a href="ArtChair.php"><img src="../Images/SweetChair.jpg" alt="SweetChair" title="SweetChair"></a>  
        <p>Sweet Art Chair with swivel base</p>
        <p>Fabric</p>
        <p style="color: gray; font-size: 70%;" > Rec.Retail Price</p>
        <p style="font-weight: bold;">$1,499.00</p>
    </div>

    <div class="SweetOttoman">
        <a href="ArtOttoman.php"><img src="../Images/Ottoman.jpg" alt="Sweet Art ottoman" title="Sweet Art ottoman"></a>  
        <p>Sweet Art ottoman</p>
        <p>Fabric</p>
        <p style="color: gray; font-size: 70%;" > Rec.Retail Price</p>
        <p style="font-weight: bold;">$599.00</p>
    </div>

 

    
    <div class="Bolzano">
        <a href="BolzoneChair.php"><img src="../Images/Bolzano.jpg" alt="Bolzano" title="Bolzano"></a>  
        <p>Bolzano chair with swivel base</p>
        <p>Fabric</p>
        <p style="color: gray; font-size: 70%;" > Rec.Retail Price</p>
        <p style="font-weight: bold;">$3,899.00</p>
        <p style="color: darkgray; font-size: 70%;">From $2,849.00</p>
    </div>

    <div class="Bellagio">
        <a href="BellagioPouf.php"><img src="../Images/Bellagio.jpg" alt="Bellagio" title="Bellagio"></a>  
        <p>Bellagio pouf</p>
        <p>Fabric.Lacquered</p>
        <p style="color: gray; font-size: 70%;" > Rec.Retail Price</p>
        <p style="font-weight: bold;">$2,299.00</p>
        <p style="color: darkgray; font-size: 70%;">From $1,249.00</p>
    </div>


    <div class="CoffeeTable">
        <a href="MadridCoffeeTable.php"><img src="../Images/CoffeeTable.jpg" alt="CoffeeTable" title="CoffeeTable"></a>  
        <p>Madrid coffee table</p>
        <p>Ceremic</p>
        <p style="color: gray; font-size: 70%;" > Rec.Retail Price</p>
        <p style="font-weight: bold;">$1,749.00</p>
        <p style="color: darkgray; font-size: 70%;">From $1,249.00</p>
    </div>
    

    <div class="DiningChair">
        <a href="DiningChair.php"><img src="../Images/DiningChair.jpg" alt="DiningChair" title="DiningChair"></a>  
        <p>Seoul dining chair</p>
        <p>Leather.Wood</p>
        <p style="color: gray; font-size: 70%;" > Rec.Retail Price</p>
        <p style="font-weight: bold;">$1,399.00</p>
        <p style="color: darkgray; font-size: 70%;">From $999.00</p>
    </div>


    <div class="CornerSofa">
        <a href="CarmoSofa.php"><img src="../Images/CornerSofa.jpg" alt="CornerSofa" title="CornerSofa"></a>  
        <p>Carmo corner sofa</p>
        <p>Fabric.Lacquered</p>
        <p style="color: gray; font-size: 70%;" > Rec.Retail Price</p>
        <p style="font-weight: bold;">$7,899.00</p>
        <p style="color: darkgray; font-size: 70%;">From $5,639.00</p>
    </div>
</div>




<hr style="width:95%; margin-top: 2%;">
<div>
    <footer style="display: flex;">
        <div>
            <p style="margin-top: 2%; margin-left: 7%;">All prices are recommended retail prices in US Dollars ($) and exclude sales tax.</p>   
        </div>   
<div>
<div style="margin-top:0%; display: flex;" >
        <a href="https://www.google.com" style="text-decoration: none; color: black;"><p style="margin-left: 95px; width: 70%;">Cookie information</p></a>
        
        <div style="display: flex;">
         <a href="https://www.google.com" style="text-decoration: none; color: black;"><p style="margin-left: 75px; width: 70%;">Terms & Conditions</p></a>
            
         <div>
            <a href="https://www.google.com" style="text-decoration: none; color: black;"><p style="width: 70%; margin-left:75px;">Privacy Policy</p></a>
         </div>     
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