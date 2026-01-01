<?php
include_once("header.php");

// Connect DB
$con = mysqli_connect("localhost", "root", "", "client");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get subcategory ID from URL
$subcat_id = intval($_GET['subcat_id'] ?? 0);

// Fetch subcategory name
$subcat_res = mysqli_query($con, "SELECT name FROM subcategories WHERE id=$subcat_id");
$subcat_row = mysqli_fetch_assoc($subcat_res);
$subcategory_name = $subcat_row['name'] ?? "Unknown";

// Fetch products under this subcategory
$result = mysqli_query($con, "SELECT * FROM products WHERE subcategory_id=$subcat_id");
?>

<!DOCTYPE html>
<html>
<head>
  <title><?= $subcategory_name ?> - KJ General Store</title>
  <style>
    table {
      width: 90%;
      margin: 30px auto;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
    }
    th {
      background: #4CAF50;
      color: white;
    }
    img {
      height: 100px;
      border-radius: 8px;
    }
    button {
      padding: 6px 12px;
      background: #3498db;
      border: none;
      border-radius: 5px;
      color: #fff;
      cursor: pointer;
    }
    button:hover {
      background: #2980b9;
    }
  </style>
</head>
<body>

<h2 style="text-align:center;"><?= $subcategory_name ?> Products</h2>

<table>
  <tr>
    <th>Product</th>
    <th>Name</th>
    <th>Price (₹)</th>
    <th>Quantity</th>
    <th>Order</th>
    <th>Cart</th>
  </tr>

  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <form action="order.php" method="post">
        <td>
          <img src="<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
          <input type="hidden" name="image" value="<?= $row['image'] ?>">
        </td>
        <td>
          <?= $row['name'] ?>
          <input type="hidden" name="product" value="<?= $row['name'] ?>">
        </td>
        <td>
          ₹<?= $row['price'] ?>
          <input type="hidden" name="price" value="<?= $row['price'] ?>">
        </td>
        <td>
          <input type="number" name="quantity" min="1" value="1">
        </td>
        <td>
          <button type="submit">Order</button>
        </td>
        <td>
          <button type="submit" formaction="cart.php">Add to Cart</button>
        </td>
      </form>
    </tr>
  <?php } ?>
</table>

<footer>
  &copy; 2025 KJ General Store. All rights reserved.
  <br>Contact NO:8220459201<br>
  Email : kjgeneral002@gmail.com
  <br>
  KJ General Store  
  Shop No. 12, Shree Krishna Complex  
  Near Kalavad Road, Mavdi Area  
  Rajkot, Gujarat - 360004  
  India  
</footer>

</body>
</html>

<?php mysqli_close($con); ?>
