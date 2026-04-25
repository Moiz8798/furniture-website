<?php

include_once('connect.php');


function getProducts() {
    global $pdo;
    
    try {

        $stmt = $pdo->query("SELECT * FROM products where Category = 'storage'");  
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
    <title>Storage</title>
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
        <h1>Storage</h1>
        <p class="subtitle">Discover storage design collections</p>
        
        <div class="categories">
            <div class="category">
                <img src="./Officestorage.jpg" alt="OfficeStorage">
                <p>Office Storage</p>
            </div>
            <div class="category">
                <img src="./bookcasesandshelves.jpg" alt="BookcasesandShelves">
                <p>Bookcases and Shelves</p>
            </div>
            <div class="category">
                <img src="./Tvunits.jpg" alt="Tvunits">
                <p>Tv units</p>
             </div>
    </div>
    <div class="filters">
        <button class="filter-btn">Filters</button>
        <button>Colour</button>
        <button>Material</button>
        <button>Collection</button>
        <button>Price</button>
        <span class="items">12 items</span>
        <select>
            <option>Relevance</option>
        </select>
    </div>
    <div class="products">
    <?php if ($products): ?>
        <?php foreach ($products as $product): ?>
            <div class="product">
                <a href="addtocart.php?type=storage&product_id=<?php echo htmlspecialchars($product['id']); ?>" class="product-image-link">
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
    </main>
    <footer>
        <div class="footer-content">
            <div class="intro">
                <h2>Storage in Haji Design</h2>
                <p>What do you need your storage to do for you? We can help you find the ideal wall system, bookcase, TV unit or home office solution. Our storage systems are crafted in our factory in Peshawar using the finest materials. Browse Ajmal's range of modern designer Storage for the contemporary home..</p>
            </div>
            <div class="footer-sections">
                <div class="section">
                    <h3>Storage</h3>
                    <p>Storage can be individual, expressive and inventive. Whether you’re looking for a Scandinavian sideboard to stow your crockery, a chest of drawers for your bedroom or floating shelves for your living room, your personal items deserve storage with personality </p>
                </div>
                <div class="section">
                    <h3>Storage furniture for living room </h3>
                    <p>Living room storage should never compromise style. When it comes to media units, our designer sideboards and TV units pack away all your entertainment and media consoles while delivering a stylish look for your home décor. .</p>
                </div>
                <div class="section">
                    <h3>Storage furniture for bedroom</h3>
                    <p>Sleep in style and keep your bedroom clutter-free with our timeless bedroom storage solutions. From a trendy nightstand to an elegant grey sideboard, we’ve got options for every space and style. .</p>
                 </div>
          </div>
        </div>
        <footer class="footer">
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
    <script src="script.js"></script>
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