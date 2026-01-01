<?php 
include_once("header.php");

// ✅ DB connection
$con = mysqli_connect("localhost", "root", "", "client");
if (!$con) { die("Connection failed: " . mysqli_connect_error()); }

// ✅ Get subcategory ID from URL
$subcat_id = intval($_GET['subcat_id'] ?? 0);

// ✅ Fetch subcategory name
$subcat_res = mysqli_query($con, "SELECT name FROM subcategories WHERE id=$subcat_id");
$subcat_row = mysqli_fetch_assoc($subcat_res);
$subcategory_name = $subcat_row['name'] ?? "Products";

// ✅ Fetch main products for this subcategory
$sql = "SELECT * FROM products WHERE subcategory_id=$subcat_id";
$result = mysqli_query($con, $sql);

if (!$result) {
    die("SQL Error: " . mysqli_error($con));
}

//$result = mysqli_query($con, "SELECT * FROM main_products WHERE subcategory_id=$subcat_id");
?>

<!DOCTYPE html>
<html>
<head>
  <title><?= $subcategory_name ?> - KJ General Store</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
    h2 { text-align: center; margin: 30px 0; }
    .product-table { width: 90%; margin: 0 auto 50px auto; border-collapse: separate; border-spacing: 20px; }
    .product-cell { width: 30%; text-align: center; background: #fff; border: 2px solid #4CAF50; border-radius: 15px; padding: 15px; transition: transform 0.3s, box-shadow 0.3s; }
    .product-cell:hover { transform: scale(1.05); box-shadow: 0 6px 12px rgba(0,0,0,0.2); }
    .product-cell img { width: 150px; height: 150px; object-fit: cover; margin-bottom: 10px; }
    .product-name { font-size: 18px; font-weight: bold; margin: 10px 0; }
    a { text-decoration: none; color: inherit; }
  </style>
</head>
<body>

<h2>🛍 <?= $subcategory_name ?></h2>

<table class="product-table">
  <tr>
  <?php
  if (mysqli_num_rows($result) > 0) {
      $count = 0;
      while ($row = mysqli_fetch_assoc($result)) {
          if ($count % 3 == 0 && $count != 0) echo "</tr><tr>";
          echo "<td class='product-cell'>";
          echo "<a href='product.php?pid={$row['id']}'>";
          echo "<img src='{$row['image']}' alt='{$row['name']}'>";
          echo "<div class='product-name'>{$row['name']}</div>";
          echo "</a>";
          echo "</td>";
          $count++;
      }
  } else {
      echo "<td colspan='3' style='text-align:center; font-size:18px; color:red;'>❌ No main products found in this subcategory.</td>";
  }
  ?>
  </tr>
</table>
<footer>
    <div class="footer-container">
        <h3>Daily Delight</h3>
        <p>&copy; 2025 Daily Delight. All rights reserved.</p>
        
        <p>
            Contact No: <a href="tel:8220459201">8220459201</a> | 
            Email: <a href="mailto:dailydelight002@gmail.com">dailydelight002@gmail.com</a>
        </p>
        
        <p>
            Shop No. 12, Shree Krishna Complex, Near Kalavad Road, Mavdi Area, <br>
            Rajkot, Gujarat - 360004, India
        </p>
    </div>
</footer>

</body>
</html>
