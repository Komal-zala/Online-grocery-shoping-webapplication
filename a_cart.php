<?php
session_start();


// ✅ Database connection
$con = mysqli_connect("localhost", "root", "", "client");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error()); 
}

// ✅ Fetch all cart items (for all users)
$result = mysqli_query($con, "SELECT * FROM cart ORDER BY added_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - All Carts</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 0; }
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
    .sidebar h2 { text-align: center; margin-bottom: 30px; }
    .sidebar a {
      display: block;
      color: #fff;
      padding: 12px 20px;
      text-decoration: none;
      margin: 5px 0;
    }
    .sidebar a:hover { background: #1abc9c; border-radius: 5px; }
    .main { margin-left: 220px; padding: 20px; }
    .main h2 { text-align: center; color: #2c3e50; margin-bottom: 20px; }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    th, td { padding: 12px; border: 1px solid #ddd; text-align: center; }
    th { background: #2c3e50; color: #fff; }
    tr:nth-child(even) { background: #f9f9f9; }
    img { width: 60px; height: 70px; object-fit: cover; border-radius: 5px; }
  </style>
</head>
<body>

<div class="sidebar">
  <h2>🛒 Admin</h2>
  <a href="a_order.php">📦 Orders</a>
  <a href="a_user.php">👤 Customers</a>
  <a href="a_reviews.php">⭐ Reviews</a>
  <a href="a_cart.php">🛒 All Carts</a>
  <a href="client.php">🚪 Logout</a>
</div>

<div class="main">
  <h2>🛒 All Users' Carts</h2>

  <?php if (mysqli_num_rows($result) > 0): ?>
    <table>
      <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Product</th>
        <th>Image</th>
        <th>Price (₹)</th>
        <th>Quantity</th>
        <th>Total (₹)</th>
        <th>Added At</th>
      </tr>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['user_id']; ?></td>
          <td><?php echo htmlspecialchars($row['name']); ?></td>
          <td><?php echo htmlspecialchars($row['email']); ?></td>
          <td><?php echo htmlspecialchars($row['phone']); ?></td>
          <td><?php echo htmlspecialchars($row['product']); ?></td>
          <td><img src="<?php echo htmlspecialchars($row['image']); ?>" alt=""></td>
          <td><?php echo number_format($row['price'], 2); ?></td>
          <td><?php echo (int)$row['quantity']; ?></td>
          <td><?php echo number_format($row['total'], 2); ?></td>
          <td><?php echo $row['added_at']; ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
  <?php else: ?>
    <p style="text-align:center;">No cart items found.</p>
  <?php endif; ?>
</div>

</body>
</html>
<?php mysqli_close($con); ?>
