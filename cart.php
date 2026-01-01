<?php
session_start();
include_once("header.php");

// ✅ Database connection
$con = mysqli_connect("localhost", "root", "", "client");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error()); 
}

// ✅ Get logged-in user id
$user_id = $_SESSION['user_id'] ?? 0;

// If user is not logged in
if ($user_id == 0) {
    echo "<p style='text-align:center; color:red;'>Please login to view your cart.</p>";
    exit();
}

// ✅ Remove item from database
if (isset($_GET['remove'])) {
    $removeId = intval($_GET['remove']);
    mysqli_query($con, "DELETE FROM cart WHERE id='$removeId' AND user_id='$user_id'");
}

// ✅ Add item to cart (insert in DB with user details)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $image = $_POST['image'];
    $product = $_POST['product'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $total = $price * $quantity;

    // 🔹 Get user details from login table
    $userRes = mysqli_query($con, "SELECT name, email, phone FROM login WHERE id='$user_id'");
    $userRow = mysqli_fetch_assoc($userRes);

    $name  = $userRow['name']  ?? '';
    $email = $userRow['email'] ?? '';
    $phone = $userRow['phone'] ?? '';

    // 🔹 Insert into cart table
    $stmt = $con->prepare("INSERT INTO cart (user_id, name, email, phone, image, product, price, quantity, total) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssidi", $user_id, $name, $email, $phone, $image, $product, $price, $quantity, $total);
    $stmt->execute();
    $stmt->close();
}

// ✅ Fetch user details for display
$userQuery = mysqli_query($con, "SELECT name, email, phone FROM login WHERE id='$user_id'");
$userData = mysqli_fetch_assoc($userQuery);

$displayName  = $userData['name']  ?? 'N/A';
$displayEmail = $userData['email'] ?? 'N/A';
$displayPhone = $userData['phone'] ?? 'N/A';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f5f5f5; padding: 20px; }
        .cart-container { max-width: 950px; margin: 50px auto; background: #fff; padding: 25px; 
                          border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .cart-container h2 { color: #4CAF50; text-align: center; margin-bottom: 20px; }
        .user-info { margin-bottom: 25px; padding: 15px; background: #f9f9f9; border-left: 5px solid #4CAF50; }
        .user-info p { margin: 5px 0; font-size: 15px; }
        table.cart-table { width: 100%; border-collapse: collapse; }
        .cart-table th, .cart-table td { border: 1px solid #ddd; padding: 12px; text-align: center; }
        .cart-table th { background-color: #e6f2ff; }
        .cart-table img { width: 80px; height: 90px; object-fit: cover; border-radius: 5px; }
        .total-row { font-weight: bold; background-color: #f0f0f0; }
        .continue-btn { display: inline-block; margin-top: 20px; padding: 10px 20px;
                        background-color: #4CAF50; color: white; text-decoration: none;
                        border-radius: 5px; }
        .continue-btn:hover { background-color: #388e3c; }
        .remove-btn { display: inline-block; padding: 6px 12px; background-color: #e74c3c;
                      color: white; text-decoration: none; border-radius: 5px; font-size: 14px; }
        .remove-btn:hover { background-color: #c0392b; }
    </style>
</head>
<body>

<div class="cart-container">
    <h2>🛒 Your Shopping Cart</h2>

    <!-- ✅ Show user details -->
    <div class="user-info">
        <p><strong>👤 Name:</strong> <?php echo htmlspecialchars($displayName); ?></p>
        <p><strong>📧 Email:</strong> <?php echo htmlspecialchars($displayEmail); ?></p>
        <p><strong>📞 Phone:</strong> <?php echo htmlspecialchars($displayPhone); ?></p>
    </div>

    <?php
    // ✅ Fetch cart items from DB
    $result = mysqli_query($con, "SELECT * FROM cart WHERE user_id='$user_id'");
    if (mysqli_num_rows($result) > 0): ?>
        <table class="cart-table">
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Price (₹)</th>
                <th>Quantity</th>
                <th>Total (₹)</th>
                <th>Action</th>
            </tr>
            <?php
            $grandTotal = 0;
            while ($item = mysqli_fetch_assoc($result)):
                $grandTotal += $item['total'];
            ?>
            <tr>
                <td><img src="<?php echo htmlspecialchars($item['image']); ?>" alt=""></td>
                <td><?php echo htmlspecialchars($item['product']); ?></td>
                <td><?php echo number_format($item['price'], 2); ?></td>
                <td><?php echo (int)$item['quantity']; ?></td>
                <td><?php echo number_format($item['total'], 2); ?></td>
                <td><a href="cart.php?remove=<?php echo $item['id']; ?>" class="remove-btn">Remove</a></td>
            </tr>
            <?php endwhile; ?>
            <tr class="total-row">
                <td colspan="4">Grand Total</td>
                <td colspan="2">₹<?php echo number_format($grandTotal, 2); ?></td>
            </tr>
        </table>
    <?php else: ?>
        <p style="text-align: center;">Your cart is empty.</p>
    <?php endif; ?>

    <div style="text-align: center;">
        <a href="main.php" class="continue-btn">Continue Shopping</a>
    </div>
</div>

</body>
</html>
<?php mysqli_close($con); ?>
