<?php

include_once('connect.php');

function getProducts() {
    global $pdo;
    
    try {
       
        $stmt = $pdo->query("SELECT * FROM products WHERE Category = 'Bed'");  
        $stmt->setFetchMode(PDO::FETCH_ASSOC);  
        return $stmt->fetchAll();  
    } catch (PDOException $e) {
        return false;  
    }
}


$products = getProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Beds</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="index1.css">
</head>
<body>
    <div class="navbar">
        <div class="nav-left">
            <button class="menu-btn" onclick="toggleMenu()"><i class="fa fa-bars"></i></button>
            <div class="nav-links">
                <a href="index2.html">Furniture</a>
                <a href="index3.html">Rooms</a>
                <a href="index4.html">Professionals</a>
            </div>
        </div>
        <a href="../HtmlFiles/HomePage.php" style="text-decoration: none;color: inherit;">
  <div class="logo">Ajmal Furniture</div>
            </a>
        <div class="nav-right">
            <div class="search-wrapper">
                <input class="search-transparent" type="text" placeholder="What can we help you find?"/>
                <i class="fa fa-search search-icon"></i>
            </div>
            <div class="shopping-bag">
                <a href="viewcart.php"><i class="fa-solid fa-bag-shopping"></i></a>
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

    <main>
        <h1>Beds</h1>
        <p class="subtitle">Discover bed design collections</p>
        
        <div class="categories">
            <div class="category" style="display: inline-block;">
                <img src="./storagebed.jpg" alt="Storage bed">
                <p>Storage bed</p>
            </div>
            <div class="category">
                <img src="./Sofabed.jpg" alt="Sofa bed">
                <p>Sofa bed</p>
            </div>
            <div class="category">
                <img src="./Daybed.jpg" alt="Daybed">
                <p>Day bed</p>
            </div>
        </div>
        <div class="filters">
            <button class="filter-btn">Filters</button>
            <button>Colour</button>
            <button>Material</button>
            <button>Collection</button>
            <button>Price</button>
            <button>Mattress size</button>
            <span class="items">12 items</span>
            <select>
                <option>Relevance</option>
            </select>
        </div>
        <div class="products">
            <?php if ($products): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product">
                        <a href="addtocart.php?type=bed&product_id=<?php echo htmlspecialchars($product['id']); ?>" class="product-image-link">
                            <img src="<?php echo htmlspecialchars($product['Image']); ?>" alt="<?php echo htmlspecialchars($product['Name']); ?>">
                        </a>
                        <div class="product-info">
                            <h3><?php echo htmlspecialchars($product['Name']); ?></h3>
                            <p class="product-material"><?php echo htmlspecialchars($product['Material']); ?></p>
                            <div class="price-info">
                                <p class="price-label">Rec. retail price</p>
                                <p class="main-price">Rs <?php echo number_format($product['Price']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
        <div style="text-align: center; margin-top: 30px;">
            <button class="load-more">Load More</button>
        </div>
    </main>
    <footer>
        <div class="footer-content">
            <div class="intro">
                <h2>Modern Designer Beds</h2>
                <p>Shop designer beds, whether it’s a luxurious full-size bed that reminds you of your favourite hotel or a convenient sofa bed ready for unexpected guests, you can always trust our beds to give you sweet dreams. Our collection of modern and contemporary beds and bed frames has been designed by renowned ajmal designers. Every bed is crafted using the best materials that emphasise the Haji design — choose from standard bed frames in oak, walnut, timber, white, fabric or leather, and add beautiful functionality to your bedroom.</p>
            </div>
            <div class="footer-sections">
                <div class="section">
                    <h3>Designer beds</h3>
                    <p>A Ajmal bed is a bed designed for comfort, style and functionality. It’s the best of ajmal design, crafted for your life. </p>
                </div>
                <div class="section">
                    <h3>Designer beds and bed frames</h3>
                    <p>Our collection of modern and contemporary beds and bed frames has been designed by renowned Haji designers. Every bed is crafted using the best materials that emphasise the Haji design.</p>
                </div>
                <div class="section">
                    <h3>How to choose the right bed</h3>
                    <p>Wondering how to select the perfect new bed for your bedroom? First, pick a suitable bed frame from our bedroom furniture collection and then customise your designer bed by selecting different headboard sections and colours as well as fabrics and leathers.</p>
                </div>
            </div>
        </div>

        <div class="footer">
        <div class="footer-content">
            <div class="footer-left">
                <ul class="footer-links">
                    <li><a href="#">Customer Service</a></li>
                    <li><a href="#">Find a store</a></li>
                    <li><a href="#">About BoConcept</a></li>
                    <li><a href="#">Press lounge</a></li>
                </ul>
            </div>
            <div class="footer-right">
                <div class="newsletter">
                    <h2>Get our newsletter.</h2>
                    <p>Get a front row seat to our collection launches and trends – directly to your inbox.</p>
                    <button class="newsletter-btn">Sign up here. <span>→</span></button>
                </div>
                <div class="social-links">
                    <h3>Follow us</h3>
                    <div class="social-icons">
                        <div class="social-icon">FB</div>
                        <div class="social-icon">IG</div>
                        <div class="social-icon">X</div>
                        <div class="social-icon">YT</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div>
                <p>All prices are recommended retail prices in US Dollars ($) and exclude sales tax.</p>
            </div>
            <div class="footer-legal">
                <a href="#">Cookie information</a>
                <a href="#">Terms & Conditions</a>
                <a href="#">Privacy Policy</a>
            </div>
            <div class="payment-options">
                <div class="payment-icon">ApplePay</div>
                <div class="payment-icon">Mastercard</div>
                <div class="payment-icon">Visa</div>
            </div>
            <div class="country-selector">
                <div class="flag">🇺🇸</div>
                <span>United States</span>
                <span>▼</span>
            </div>
        </div>

    </footer>
    <script src="main.js"></script>
    <script>
        document.querySelectorAll('.section h3').forEach(header => {
            header.addEventListener('click', () => {
                const section = header.parentElement;
                section.classList.toggle('active');
            });
        });
    </script>
</body>
</html>