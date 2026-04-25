<?php

session_start();
include_once('connect.php');


function getProducts() {
    global $pdo;
    
    try {

        $stmt = $pdo->query("SELECT * FROM products WHERE Category = 'sofa'");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        return false;
    }
}


$products = getProducts();


$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sofas</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="style.css">    
    <link rel="stylesheet" href="index1.css">
    <link rel="stylesheet" href="cart.css"> 
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
        <div class="logo"><a href="../HtmlFiles/HomePage.php" style="text-decoration: none;color: inherit;">Ajmal Furniture</a></div>
        <div class="nav-right">
            <div class="search-wrapper">
                <input class="search-transparent" type="text" placeholder="What can we help you find?"/>
                <i class="fa fa-search search-icon"></i>
            </div>
            <div class="shopping-bag" style="position: relative;">
                <a href="viewcart.php"><i class="fa-solid fa-bag-shopping"></i></a>
                <?php if ($cartCount > 0): ?>
                    <span class="cart-count"><?php echo $cartCount; ?></span>
                <?php endif; ?>
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
            <button onclick="closeSubMenu()"><iidy class="fa fa-chevron-left"></i> Back</button>
        </div>
        <h3 id="submenu-title"></h3>
        <p id="submenu-description"></p>
        <ul class="submenu-items" id="submenu-items"></ul>
    </div>

    <main>
        <h1>Sofas</h1>
        <p class="subtitle">Discover sofa design collections</p>
        
        <div class="categories">
            <div class="category">
                <img src="./2seater.jpg" alt="2 Seater sofa">
                <p>2 Seater sofas</p>
            </div>
            <div class="category">
                <img src="./Moden2.5Seater.jpg" alt="2.5 Seater sofa">
                <p>2.5 seater sofas</p>
            </div>
            <div class="category">
                <img src="./3seater.jpg" alt="3-seater sofa">
                <p>3-seater sofas</p>
            </div>
            <div class="category">
                <img src="./NoblesofaSet.jpg" alt="Large sofa">
                <p>Large and 4 seater</p>
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
                    <a href="addtocart.php?type=sofa&product_id=<?php echo htmlspecialchars($product['id']); ?>" class="product-image-link">
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
        <br><br>
        <h2 style="display: flex; justify-content: center;">Explore Modern Sofas in Pakistan: Comfort Meets Elegance</h2>
    </main>
    <footer>
        <div class="footer-content">
            <div class="intro">
                <h2>Designer Sofas</h2>
                <p>Discover our range of modern designer sofas, crafted to bring comfort and style to your living space.</p>
            </div>
            
            <div class="footer-sections">
                <div class="section">
                    <h3>Designer Sofas</h3>
                    <p>Our sofas are designed for ultimate comfort and style, perfect for any modern living room.</p>
                </div>
                <div class="section">
                    <h3>Corner Sofas</h3>
                    <p>Maximize your space with our elegant corner sofas, designed for both aesthetics and functionality.</p>
                </div>
                <div class="section">
                    <h3>Modular Sofas</h3>
                    <p>Flexible and stylish, our modular sofas let you customize your seating arrangement to fit your needs.</p>
                </div>
                <div class="section">
                    <h3>Sofa Beds</h3>
                    <p>Combine practicality with elegance using our sofa beds, perfect for guests or small spaces.</p>
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
        </div>
    </footer>
    <script>
        document.querySelectorAll('.section h3').forEach(header => {
            header.addEventListener('click', () => {
                const section = header.parentElement;
                section.classList.toggle('active');
            });
        });
    </script>
    <script src="script.js"></script>
</body>
</html>