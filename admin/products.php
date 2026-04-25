<?php
session_start();
require_once 'includes/db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch products
$result = $conn->query("SELECT * FROM products");

// Add product
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $material = $_POST['material'];
    $image = $_POST['image'];

    $stmt = $conn->prepare("INSERT INTO products (Name, Price, Material, Category, Image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsss", $name, $price, $material, $category, $image);
    $stmt->execute();
    $stmt->close();
    header("Location: products.php");
    exit();
}

// Edit product
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $material = $_POST['material'];
    $image = $_POST['image'];

    $stmt = $conn->prepare("UPDATE products SET Name = ?, Price = ?, Material = ?, Category = ?, Image = ? WHERE id = ?");
    $stmt->bind_param("sdsssi", $name, $price, $material, $category, $image, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: products.php");
    exit();
}

// Delete product
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: products.php");
    exit();
}

// Fetch product for editing
$edit_product = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $edit_product = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Ajmal Furniture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'includes/sidebar.php'; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h2 class="mt-4">Products</h2>
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Material</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['Name']; ?></td>
                                <td>$<?php echo number_format($row['Price'], 2); ?></td>
                                <td><?php echo $row['Category']; ?></td>
                                <td><?php echo $row['Material']; ?></td>
                                <td><img src="<?php echo $row['Image']; ?>" alt="<?php echo $row['Name']; ?>" width="50"></td>
                                <td>
                                    <a href="products.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="products.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete()">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <!-- Add Product Modal -->
                <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="products.php">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category</label>
                                        <select class="form-control" id="category" name="category" required>
                                            <option value="Sofa">Sofa</option>
                                            <option value="Chair">Chair</option>
                                            <option value="Table">Table</option>
                                            <option value="Bed">Bed</option>
                                            <option value="Storage">Storage</option>
                                            <option value="Outdoor">Outdoor</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="material" class="form-label">Material</label>
                                        <input type="text" class="form-control" id="material" name="material">
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image Path</label>
                                        <input type="text" class="form-control" id="image" name="image">
                                    </div>
                                    <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Product Modal -->
                <?php if ($edit_product) { ?>
                    <div class="modal fade show" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true" style="display: block;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                                    <button type="button" class="btn-close" onclick="window.location.href='products.php'" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="products.php">
                                        <input type="hidden" name="id" value="<?php echo $edit_product['id']; ?>">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $edit_product['Name']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $edit_product['Price']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="category" class="form-label">Category</label>
                                            <select class="form-control" id="category" name="category" required>
                                                <option value="Sofa" <?php if ($edit_product['Category'] == 'Sofa') echo 'selected'; ?>>Sofa</option>
                                                <option value="Chair" <?php if ($edit_product['Category'] == 'Chair') echo 'selected'; ?>>Chair</option>
                                                <option value="Table" <?php if ($edit_product['Category'] == 'Table') echo 'selected'; ?>>Table</option>
                                                <option value="Bed" <?php if ($edit_product['Category'] == 'Bed') echo 'selected'; ?>>Bed</option>
                                                <option value="Storage" <?php if ($edit_product['Category'] == 'Storage') echo 'selected'; ?>>Storage</option>
                                                <option value="Outdoor" <?php if ($edit_product['Category'] == 'Outdoor') echo 'selected'; ?>>Outdoor</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="material" class="form-label">Material</label>
                                            <input type="text" class="form-control" id="material" name="material" value="<?php echo $edit_product['Material']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image Path</label>
                                            <input type="text" class="form-control" id="image" name="image" value="<?php echo $edit_product['Image']; ?>">
                                        </div>
                                        <button type="submit" name="edit_product" class="btn btn-primary">Update Product</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </main>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>