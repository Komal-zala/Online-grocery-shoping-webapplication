<?php 
include_once("header.php");

// ✅ DB connection
$con = mysqli_connect("localhost", "root", "", "client");
if (!$con) { die("Connection failed: " . mysqli_connect_error()); }

// ✅ Get main product ID from URL
$pid = intval($_GET['pid'] ?? 0);

// ✅ Fetch main product details
$main_res = mysqli_query($con, "SELECT * FROM main_products WHERE id=$pid");
$main_row = mysqli_fetch_assoc($main_res);
$main_product_name = $main_row['name'] ?? "Product";
$main_product_img = $main_row['image'] ?? "";

// ✅ Fetch product types for this main product
$result = mysqli_query($con, "SELECT * FROM product_types WHERE main_product_id=$pid");
?>

<!DOCTYPE html>
<html>
<head>
  <title><?= $main_product_name ?> - Product Types</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
    h2 { text-align: center; margin: 30px 0; }
    .product-header { text-align: center; margin-bottom: 20px; }
    .product-header img { width: 120px; height: 120px; object-fit: cover; border-radius: 10px; }
    .types-table { width: 90%; margin: 0 auto 50px auto; border-collapse: separate; border-spacing: 20px; }
    .type-cell { width: 30%; text-align: center; background: #fff; border: 2px solid #2196F3; border-radius: 15px; padding: 15px; transition: transform 0.3s, box-shadow 0.3s; }
    .type-cell:hover { transform: scale(1.05); box-shadow: 0 6px 12px rgba(0,0,0,0.2); }
    .type-cell img { width: 120px; height: 120px; object-fit: cover; margin-bottom: 10px; }
    .type-name { font-size: 16px; font-weight: bold; margin: 10px 0; }
    .price { font-size: 15px; color: green; margin: 5px 0; }
    a { text-decoration: none; color: inherit; }
  </style>
</head>
<body>

<h2>📦 <?= $main_product_name ?> - Types</h2>

<div class="product-header">
  <?php if ($main_product_img) { ?>
    <img src="<?= $main_product_img ?>" alt="<?= $main_product_name ?>">
  <?php } ?>
  <h3><?= $main_product_name ?></h3>
</div>

<table class="types-table">
  <tr>
  <?php
  if (mysqli_num_rows($result) > 0) {
      $count = 0;
      while ($row = mysqli_fetch_assoc($result)) {
          if ($count % 3 == 0 && $count != 0) echo "</tr><tr>";
          echo "<td class='type-cell'>";
          echo "<img src='{$row['image']}' alt='{$row['type_name']}'>";
          echo "<div class='type-name'>{$row['type_name']}</div>";
          echo "<div class='price'>₹ {$row['price']}</div>";
          echo "</td>";
          $count++;
      }
  } else {
      echo "<td colspan='3' style='text-align:center; font-size:18px; color:red;'>❌ No product types found.</td>";
  }
  ?>
  </tr>
</table>

</body>
</html>
