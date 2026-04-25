<?php

session_start();
include_once('connect.php');


function getProducts() {
    global $pdo;
    
    try {
       
        $stmt = $pdo->query("SELECT * FROM products WHERE Category = 'chair'");  
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
    <title>Chairs</title>
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
        <a href="../HtmlFiles/HomePage.php" style="text-decoration: none;color: inherit;">
  <div class="logo">Ajmal Furniture</div>
            </a>
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
            <button onclick="closeSubMenu()"><i class="fa fa-chevron-left"></i> Back</button>
        </div>
        <h3 id="submenu-title"></h3>
        <p id="submenu-description"></p>
        <ul class="submenu-items" id="submenu-items"></ul>
    </div>
    <main>
        <h1>Chairs</h1>
        <p class="subtitle">Discover chair design collections</p>
        
        <div class="categories">
            <div class="category" style="display: inline-block;">
                <img src="./ChicSofaChair.jpg" alt="ChicSofaChair">
                <p>Chic Sofa Chair</p>
            </div>
            <div class="category">
                <img src="./ExecutiveChair.jpg" alt="ExecutiveChair">
                <p>Executive Chair</p>
            </div>
            <div class="category">
                <img src="./luxChair.jpg" alt="luxChair">
                <p>Lux Chair</p>
            </div>
            <div class="category">
                <img src="./OvoChair.jpg" alt="Ovo Chair">
                <p>Ovo Chair</p> 
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
                    <a href="addtocart.php?type=chair&product_id=<?php echo htmlspecialchars($product['id']); ?>" class="product-image-link">
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
        </div><br><br>
        <h2 style="display: flex; justify-content: center;">Buy the Best Executive Chairs in Pakistan: A Perfect Blend of Ergonomics & Style </h2>
    </main>
    <footer>
        <div class="footer-content">
            <div class="intro">
                <h2>Designer Chairs</h2>
                <p>The right chair can be a piece of beauty; as such,  <br> it's important to exert effort when looking for the right one..</p>
            </div>
            
            <div class="footer-sections">
                <div class="section">
                    <h3>Designer chairs</h3>
                    <p>Whether it’s for dining in comfort or reclining with a book you love, there’s nothing like finding a great designer chair for your living space. More than just a place to sit, our range of designer chairs makes a style statement all on their own. ..</p>
                </div>
                <div class="section">
                    <h3>Designer armchairs</h3>
                    <p>Often referred to as accent chairs, occasional chairs, and recliner chairs, modern armchairs bring a touch of elegance to any room. Whether you're choosing an armchair for your living room, dining room, home office, bedroom..</p>
                </div>
                <div class="section">
                    <h3>Designer office chairs</h3>
                    <p>A swivel or static ergonomic office chair from our home office collection ensures your work day is as productive as possible. shop our range of office chairs and boost your work-from-home business productivity.</p>
                </div>
                <div class="section">
                    <h3>Designer outdoor chairs</h3>
                    <p>Depending on the size of your terrace or patio, transforming your outdoor space into a cosy lounge area or dining room (or both) brings new meaning to flexible living..</p>
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