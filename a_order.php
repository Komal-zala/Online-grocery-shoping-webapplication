<?php
session_start();
include_once("a_header.php");

// Database connection
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "client";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize session array for done orders
if (!isset($_SESSION['done_orders'])) {
    $_SESSION['done_orders'] = [];
}

// Handle Done click (store in session)
if (isset($_GET['done_id'])) {
    $done_id = intval($_GET['done_id']);
    if (!in_array($done_id, $_SESSION['done_orders'])) {
        $_SESSION['done_orders'][] = $done_id;
    }
    header("Location: " . $_SERVER['PHP_SELF']); // Refresh page
    exit;
}

// Fetch all orders
$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Orders</title>
<style>
body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
.container { margin: 20px; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
h2 { text-align: center; margin-bottom: 20px; color: #2c3e50; }
table { width: 100%; border-collapse: collapse; }
table th, table td { border: 1px solid #ddd; padding: 10px; text-align: center; }
table th { background: #2c3e50; color: #fff; }
table tr:nth-child(even) { background: #f9f9f9; }
img { width: 60px; height: auto; }
.done-btn {
    background: green;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
}
.done-btn:hover { background: darkgreen; }
.btn {
    display: block;
    width: 200px;
    margin: 20px auto;
    padding: 10px;
    background: #3498db;
    color: #fff;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.3s;
}
.btn:hover { background: #2980b9; }
</style>
</head>
<body>

<div class="container">
<h2>📦 All Orders</h2>
<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Product</th>
    <th>Image</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
    <th>Payment</th>
    <th>Delivery</th>
    <th>Date</th>
    <th>Action</th>
</tr>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Skip orders marked as done in session
        if (in_array($row['id'], $_SESSION['done_orders'])) continue;

        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['address']}</td>
            <td>{$row['product']}</td>
            <td><img src='{$row['image']}' alt='{$row['product']}'></td>
            <td>{$row['price']}</td>
            <td>{$row['quantity']}</td>
            <td>{$row['total']}</td>
            <td>{$row['payment_type']}</td>
            <td>{$row['delivery_type']}</td>
            <td>{$row['order_date']}</td>
            <td>
                <a href='?done_id={$row['id']}' class='done-btn' onclick='return confirm(\"Mark this order as done?\")'>Done</a>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='13'>No orders found</td></tr>";
}
?>

</table>

<a href="admin.php" class="btn">Go to Admin Page</a>
</div>

</body>
</html>

<?php $conn->close(); ?>
