<?php

// ✅ Database connection
$con = mysqli_connect("localhost", "root", "", "client");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// ✅ Get product type ID
$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    die("<p style='color:red; text-align:center;'>Invalid product ID!</p>");
}

// ✅ Fetch product
$sql = "SELECT * FROM product_types WHERE id=$id LIMIT 1";
$result = mysqli_query($con, $sql);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    die("<p style='color:red; text-align:center;'>Product not found!</p>");
}

// ✅ Update product
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $image = mysqli_real_escape_string($con, $_POST['image']);
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $update = "UPDATE product_types 
               SET name='$name', description='$description', image='$image', price='$price', stock='$stock' 
               WHERE id=$id";

    if (mysqli_query($con, $update)) {
    $product_id = $product['product_id']; // parent product ID
    header("Location: a_product_types.php?product_id=$product_id&msg=updated");
    exit;
}
 else {
        echo "<p style='color:red; text-align:center;'>Update failed: " . mysqli_error($con) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Product Type</title>
  <style>
    body {
      font-family: "Segoe UI", Arial, sans-serif;
      background: #f0f2f5;
      margin: 0; padding: 0;
    }
    .container {
      width: 500px;
      margin: 50px auto;
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-top: 12px;
      font-weight: bold;
      color: #333;
    }
    input, textarea, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      transition: 0.3s;
    }
    input:focus, textarea:focus, select:focus {
      border-color: #27ae60;
      outline: none;
      box-shadow: 0 0 5px rgba(39, 174, 96, 0.3);
    }
    textarea { resize: vertical; height: 80px; }

    .actions {
      margin-top: 20px;
      display: flex;
      justify-content: space-between;
    }
    .btn {
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 15px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
      text-align: center;
    }
    .save {
      background: #27ae60;
      color: #fff;
      border: none;
    }
    .save:hover { background: #219150; }

    .back {
      background: #3498db;
      color: #fff;
      text-decoration: none;
    }
    .back:hover { background: #2980b9; }
  </style>
</head>
<body>

<div class="container">
  <h2>✏ Edit Product Type</h2>
  <form method="post">
    <label>ID (Read Only)</label>
    <input type="text" value="<?= $product['id'] ?>" readonly>

    <label>Name</label>
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>">

    <label>Description</label>
    <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea>

    <label>Image URL</label>
    <input type="text" name="image" value="<?= htmlspecialchars($product['image']) ?>">

    <label>Price (₹)</label>
    <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>">

    <label>Stock</label>
    <select name="stock">
      <option value="Yes" <?= ($product['stock'] == "Yes") ? "selected" : "" ?>>Yes</option>
      <option value="No" <?= ($product['stock'] == "No") ? "selected" : "" ?>>No</option>
    </select>

    <div class="actions">
      <button type="submit" class="btn save">💾 Save Changes</button>
      <a href="a_product_types.php?product_id=<?= $product['product_id'] ?>" class="btn back">⬅ Back</a>

    </div>
  </form>
</div>

</body>
</html>

<?php mysqli_close($con); ?>
