<?php
session_start();
include_once("header.php");

// ✅ Connect to DB
$con = mysqli_connect("localhost", "root", "", "client");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// ✅ Fetch logged-in user info (from `login` table)
$user_name = "";
$user_phone = "";

if (isset($_SESSION['user_id'])) {
    $uid = intval($_SESSION['user_id']);
    $user_q = mysqli_query($con, "SELECT name, phone FROM login WHERE id = '$uid'");
    if ($user_q && mysqli_num_rows($user_q) > 0) {
        $user = mysqli_fetch_assoc($user_q);
        $user_name = $user['name'];
        $user_phone = $user['phone'];
    }
}

// ✅ Product info (from POST)
$image    = $_POST['image'] ?? 'uploads/noimage.png';
$product  = $_POST['product'] ?? 'Unknown Product';
$price    = $_POST['price'] ?? 0;
$quantity = $_POST['quantity'] ?? 1;
$total    = $price * $quantity;

// ✅ Handle Order Submit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['payment'])) {
    $name     = mysqli_real_escape_string($con, $_POST['name']);
    $phone    = mysqli_real_escape_string($con, $_POST['phone']);
    $address  = mysqli_real_escape_string($con, $_POST['address']);
    $payment  = $_POST['payment'];
    $delivery = $_POST['delivery'];

    $ins = "INSERT INTO orders(name, phone, address, image, product, price, quantity, total, payment_type, delivery_type)
            VALUES('$name', '$phone', '$address', '$image', '$product', '$price', '$quantity', '$total', '$payment', '$delivery')";

    if (mysqli_query($con, $ins)) {
        echo "<script>window.location='thankyou.php';</script>";
        exit;
    } else {
        echo "<script>alert('❌ Error: " . mysqli_error($con) . "');</script>";
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
<title>Order Summary</title>
<style>
body { font-family: Arial; background: #f4f4f4; margin:0; }
h4 { text-align: center; margin-bottom: 20px; }
table {
  background: #fff;
  border: 10px solid #4CAF50;
  margin: 30px auto 150px;
  width: 70%;
  border-radius: 5px;
}
th, td {
  padding: 15px;
  border: 1px solid #ccc;
  text-align: center;
  font-size: 18px;
}
img { max-height: 200px; display: block; margin: 0 auto; }
input[type="text"], input[type="tel"], textarea {
  width: 95%; padding: 8px; font-size: 14px; margin-top: 5px;
}
.radio-group { display: flex; justify-content: center; gap: 20px; font-size: 16px; }
input[type="radio"] { margin-right: 8px; }
.sub-btn {
  display: block; margin: 25px auto; padding: 10px 30px;
  background-color: #4CAF50; color: white; border: none;
  border-radius: 5px; font-size: 16px; cursor: pointer;
}
#qrBox { display: none; text-align: center; margin: 15px 0; }
#qrBox img { width: 250px; }
footer { text-align:center; background:#222; color:#fff; padding:20px; }
footer a { color:#4CAF50; text-decoration:none; }
</style>
</head>
<body>

<form method="POST" action="">
  <!-- Hidden product info -->
  <input type="hidden" name="image" value="<?php echo $image; ?>">
  <input type="hidden" name="product" value="<?php echo $product; ?>">
  <input type="hidden" name="price" value="<?php echo $price; ?>">
  <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
  <input type="hidden" name="total" value="<?php echo $total; ?>">

  <table>
    <tr>
      <td rowspan="7">
        <h2 style="color:#4CAF50;">Order Now</h2>
        <img src="<?php echo $image; ?>" alt="Product Image" onerror="this.src='uploads/noimage.png'">
        <h4>
          Product: <?php echo $product; ?><br>
          Price: ₹<?php echo $price; ?><br>
          Quantity: <?php echo $quantity; ?><br>
          Total: ₹<?php echo $total; ?>
        </h4>
      </td>
    </tr>
    <tr>
      <td>Name:</td>
      <td><input type="text" name="name" value="<?php echo htmlspecialchars($user_name); ?>" required></td>
    </tr>
    <tr>
      <td>Phone No:</td>
      <td><input type="tel" maxlength="10" pattern="[6-9]\d{9}" name="phone" value="<?php echo htmlspecialchars($user_phone); ?>" required></td>
    </tr>
    <tr>
      <td>Address:</td>
      <td><textarea name="address" rows="3" required></textarea></td>
    </tr>
    <tr>
      <td>Payment Type:</td>
      <td class="radio-group">
        <label><input type="radio" name="payment" value="Online" onclick="showQR()" required> Online</label>
        <label><input type="radio" name="payment" value="COD" onclick="hideQR()"> Cash on Delivery</label>
      </td>
    </tr>
    <tr>
      <td>Delivery Type:</td>
      <td class="radio-group">
        <label>
          <input type="radio" name="delivery" value="Home Delivery" <?php if($total < 200) echo "disabled"; ?>>
          Home Delivery <?php if($total < 200) echo "(Not available below ₹200)"; ?>
        </label>
        <label><input type="radio" name="delivery" value="Shop Pickup" required> Shop Pickup</label>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <div id="qrBox">
          <h3>Scan the QR Code to Pay</h3>
          <img src="qr.jpeg" alt="QR Code">
          <p>After payment, click on "Confirm Order".</p>
        </div>
        <button type="submit" class="sub-btn">Confirm Order</button>
      </td>
    </tr>
  </table>
</form>

<footer>
  <h3>Daily Delight</h3>
  <p>&copy; 2025 Daily Delight. All rights reserved.</p>
  <p>Contact: <a href="tel:8220459201">8220459201</a> | 
     Email: <a href="mailto:dailydelight002@gmail.com">dailydelight002@gmail.com</a></p>
  <p>Shop No. 12, Shree Krishna Complex, Near Kalavad Road, Mavdi Area,<br>
     Rajkot, Gujarat - 360004, India</p>
</footer>

<script>
function showQR(){ document.getElementById("qrBox").style.display="block"; }
function hideQR(){ document.getElementById("qrBox").style.display="none"; }
</script>

</body>
</html>
