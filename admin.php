<?php
//include_once("header.php");

// Connect to database
$con = mysqli_connect("localhost", "root", "", "client");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch records from login table
$sql = "SELECT id, name, email, phone FROM new_user";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f4f4f4;
    }
    .sidebar {
      height: 100vh;
      width: 220px;
      background: #2c3e50;
      color: #fff;
      position: fixed;
      left: 0;
      top: 0;
      padding-top: 20px;
    }
    .sidebar h2 {
      text-align: center;
      margin-bottom: 30px;
    }
    .sidebar a {
      display: block;
      color: #fff;
      padding: 12px 20px;
      text-decoration: none;
      margin: 5px 0;
    }
    .sidebar a:hover {
      background: #1abc9c;
      border-radius: 5px;
    }
    .main {
      margin-left: 220px;
      padding: 20px;
    }
    .welcome {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      text-align: center;
      font-size: 22px;
      font-weight: bold;
      color: #2c3e50;
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: center;
    }
    th {
      background: #2c3e50;
      color: #fff;
    }
    tr:nth-child(even) {
      background: #f9f9f9;
    }
  </style>
</head>
<body>

<div class="sidebar">
  <h2>🛒 Admin</h2>
  <a href="a_order.php">📦 Orders</a>
  <a href="a_categories.php">➕ Add Product</a>
  <a href="a_viewpro.php">➕ View Product</a>  
  <a href="a_user.php">👤 Customers</a>
  <a href="a_reviews.php">⭐ Customer Reviews</a>
  <a href="a_cart.php">🛒 Customer Cart</a>
  <a href="client.php">🚪 Logout</a>
</div>

<div class="main">
  <div class="welcome">Welcome Admin 🎉</div>
  <p>This is your admin panel. From here you can manage orders, customers, and products.</p>
  
  

</body>
</html>

<?php mysqli_close($con); ?>
