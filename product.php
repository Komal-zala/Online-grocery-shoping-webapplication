<?php
include_once("header.php");

// ✅ Database connection
$con = mysqli_connect("localhost", "root", "", "client");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// ✅ Get main product ID from URL
$pid = intval($_GET['pid'] ?? 0);

// ✅ Fetch product types safely
$stmt = $con->prepare("SELECT id, name, description, price, stock, image 
                       FROM product_types 
                       WHERE product_id = ? 
                       ORDER BY id DESC");
$stmt->bind_param("i", $pid);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Order Products - Daily Delight</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: "Segoe UI", Arial, sans-serif;
      background: #f4f4f4;
    }

   
  
    nav a {
      color: white;
      text-decoration: none;
      margin: 0 15px;
      font-size: 16px;
      transition: color 0.2s;
    }

    nav a:hover {
      color: #28a745;
    }

    /* ✅ Table styling */
    h2 {
      text-align: center;
      margin-top: 30px;
      font-size: 26px;
      color: #222;
    }

    table {
      width: 90%;
      margin: 30px auto;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 15px;
      border: 1px solid #ddd;
      text-align: center;
      font-size: 15px;
    }

    th {
      background: #28a745;
      color: #fff;
      font-size: 16px;
    }

    tr:nth-child(even) {
      background: #f9f9f9;
    }

    img {
      width: 120px;
      height: 120px;
      object-fit: contain;
      border-radius: 8px;
      background: #f1f1f1;
      padding: 5px;
    }

    button {
      padding: 8px 14px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      background: #28a745;
      color: #fff;
      font-weight: 600;
      transition: background 0.2s;
    }

    button:hover {
      background: #218838;
    }

    input[type="number"] {
      width: 60px;
      padding: 5px;
      text-align: center;
      border: 1px solid #aaa;
      border-radius: 4px;
    }

    .no-products {
      text-align: center;
      color: red;
      font-weight: bold;
      padding: 20px;
      font-size: 18px;
    }

    /* ✅ Footer styling */
    footer {
      background: #000;
      color: white;
      text-align: center;
      padding: 30px 20px;
      margin-top: 60px;
    }

    footer a {
      color: #28a745;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
    }

  </style>
</head>
<body>

  <h2>🛒 Order Products</h2>

  <table>
    <tr>
      <th>Product</th>
      <th>Name</th>
      <th>Description</th>
      <th>Price (₹)</th>
      <th>Stock</th>
      <th>Quantity</th>
      <th>Order</th>
      <th>Cart</th>
    </tr>

    <?php if ($result->num_rows > 0) { ?>
      <?php while ($row = $result->fetch_assoc()) { ?>
      <tr>
        <form method="post">
          <td>
            <?php $imagePath = !empty($row['image']) ? $row['image'] : "uploads/noimage.png"; ?>
            <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
            <input type="hidden" name="image" value="<?= htmlspecialchars($imagePath) ?>">
            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
          </td>
          <td>
            <?= htmlspecialchars($row['name']) ?>
            <input type="hidden" name="product" value="<?= htmlspecialchars($row['name']) ?>">
          </td>
          <td><?= htmlspecialchars($row['description']) ?></td>
          <td>
            ₹<?= number_format($row['price'], 2) ?>
            <input type="hidden" name="price" value="<?= $row['price'] ?>">
          </td>
          <td><?= htmlspecialchars($row['stock']) ?></td>
          <td><input type="number" name="quantity" min="1" value="1" required></td>
          <td><button type="submit" formaction="order.php">Order</button></td>
          <td><button type="submit" formaction="cart.php" onclick="return showPopup()">Add to Cart</button></td>
        </form>
      </tr>
      <?php } ?>
    <?php } else { ?>
      <tr><td colspan="8" class="no-products">No products available for this item.</td></tr>
    <?php } ?>
  </table>

  <footer>
    <h3>Daily Delight</h3>
    <p>&copy; 2025 Daily Delight. All rights reserved.</p>
    <p>
      Contact No: <a href="tel:8220459201">8220459201</a> | 
      Email: <a href="mailto:dailydelight002@gmail.com">dailydelight002@gmail.com</a>
    </p>
    <p>Shop No. 12, Shree Krishna Complex, Near Kalavad Road, Mavdi Area,<br> Rajkot, Gujarat - 360004, India</p>
  </footer>

  <script>
  function showPopup() {
    alert("🛒 Added to cart!");
    return true;
  }
  </script>

</body>
</html>

<?php
$stmt->close();
mysqli_close($con);
?>
