<?php
ob_start(); // Prevent header errors

include_once("a_header.php");

// ✅ Database connection
$con = mysqli_connect("localhost", "root", "", "client");
if (!$con) {
    die("<h3 style='color:red;text-align:center;'>❌ Database Connection Failed: " . mysqli_connect_error() . "</h3>");
}

// ✅ Get Product ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo "<h2 style='color:red;text-align:center;margin-top:40px;'>Invalid Product ID</h2>";
    echo "<div style='text-align:center;'>
            <a href='a_products.php' 
               style='display:inline-block;margin-top:20px;
                      background:#3498db;color:#fff;
                      padding:10px 18px;border-radius:6px;
                      text-decoration:none;'>← Back to Products</a>
          </div>";
    exit;
}

// ✅ Fetch product data
$product_query = "SELECT * FROM products WHERE id = $id";
$product_res = mysqli_query($con, $product_query);
$product = mysqli_fetch_assoc($product_res);

if (!$product) {
    echo "<h2 style='color:red;text-align:center;margin-top:40px;'>Product Not Found</h2>";
    echo "<div style='text-align:center;'>
            <a href='a_products.php' 
               style='display:inline-block;margin-top:20px;
                      background:#3498db;color:#fff;
                      padding:10px 18px;border-radius:6px;
                      text-decoration:none;'>← Back</a>
          </div>";
    exit;
}

// ✅ Handle Update Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $image = trim($_POST['image']);

    // Basic validation
    if ($name === '') {
        echo "<h3 style='color:red;text-align:center;'>❌ Product name cannot be empty.</h3>";
    } else {
        // Prepared statement for security
        $stmt = mysqli_prepare($con, "UPDATE products SET name = ?, image = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "ssi", $name, $image, $id);
        $updated = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($updated) {
            // ✅ Redirect with product ID to products page
            header("Location: a_products.php?updated_id=" . urlencode($id));
            exit;
        } else {
            echo "<h3 style='color:red;text-align:center;'>❌ Update failed. Please try again.</h3>";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit Product</title>
  <style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background: #f5f6fa;
        margin: 0;
        padding: 20px;
        color: #333;
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: 600;
        letter-spacing: 0.5px;
        color: #2c3e50;
    }
    form {
        background: #fff;
        padding: 25px;
        margin: 30px auto;
        max-width: 600px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    label {
        display: block;
        margin-top: 15px;
        margin-bottom: 5px;
        font-weight: 500;
        font-size: 15px;
        color: #34495e;
    }
    input {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        transition: border-color 0.3s;
    }
    input:focus {
        border-color: #27ae60;
        outline: none;
    }
    button {
        width: 100%;
        padding: 12px;
        margin-top: 20px;
        font-size: 16px;
        font-weight: 600;
        color: #fff;
        background: linear-gradient(to right, #27ae60, #2ecc71);
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.3s, transform 0.2s;
    }
    button:hover {
        background: linear-gradient(to right, #2ecc71, #27ae60);
        transform: translateY(-2px);
    }
    .back-link {
        display: block;
        text-align: center;
        margin-top: 15px;
        text-decoration: none;
        background: #3498db;
        color: #fff;
        padding: 10px 0;
        border-radius: 6px;
        transition: background 0.3s;
    }
    .back-link:hover {
        background: #2980b9;
    }
  </style>
</head>
<body>

<h2>Edit Product – <?= htmlspecialchars($product['name']) ?></h2>

<form method="post">
    <label>Product Name:</label>
    <input name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

    <label>Image URL:</label>
    <input name="image" value="<?= htmlspecialchars($product['image']) ?>">

    <button type="submit">Update Product</button>
    <a href="a_products.php" class="back-link">← Back to Products</a>
</form>

</body>
</html>

<?php 
mysqli_close($con);
ob_end_flush();
?>
