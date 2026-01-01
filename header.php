<?php
// Start session if needed (for cart, login, etc.)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Example cart count (replace with real value if needed)
$cart_count = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Delight</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; display: flex; flex-direction: column; font-family: 'Poppins', sans-serif; background-color: #fcfbf8; }

        header {
            display: flex; align-items: center; justify-content: space-between;
            background: linear-gradient(135deg, #0d1b2a, #1b263b, #0d1b2a);
            background-size: 300% 300%;
            animation: gradientMove 15s ease infinite;
            position: sticky; top: 0; width: 100%; padding: 16px 40px;
            border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3), 0 6px 6px rgba(0,0,0,0.25);
            z-index: 1000; opacity: 0; transform: translateY(-30px); animation: fadeDown 1s ease forwards;
        }

        header img { width: 120px; border-radius: 50%; transition: transform 0.5s ease, box-shadow 0.5s ease; }
        header img:hover { transform: scale(1.08) rotate(5deg); box-shadow: 0 12px 25px rgba(0,0,0,0.3); }

        header h1 { font-family: 'Playfair Display', serif; font-size: 38px; font-weight: 600; color: #ffffff; flex-grow: 1; text-align: center; letter-spacing: 2px; text-shadow: 1px 1px 3px rgba(0,0,0,0.5); transition: color 0.4s ease; }
        header h1:hover { color: #27ae60; }

        .nav { display: flex; gap: 25px; align-items: center; }
        .nav a { color: #ffffff; text-decoration: none; font-weight: 500; font-size: 16px; padding: 10px 20px; border-radius: 18px; transition: all 0.3s ease; }
        .nav a:hover { background: rgba(255,90,31,0.15); color: #ff5a1f; transform: translateY(-2px); box-shadow: 0 6px 12px rgba(0,0,0,0.3), 0 3px 6px rgba(0,0,0,0.2); }
        .nav a:active { transform: translateY(1px); box-shadow: inset 0 3px 5px rgba(0,0,0,0.2), inset 0 1px 2px rgba(0,0,0,0.1); }

        .cart { position: relative; font-size: 28px; transition: transform 0.4s ease, color 0.4s ease; color: #ffffff; text-shadow: 0px 1px 2px rgba(0,0,0,0.3); }
        .cart:hover { transform: scale(1.15); color: #ff5a1f; }
        .cart-count { background: #e74c3c; color: white; font-size: 13px; font-weight: bold; padding: 3px 8px; border-radius: 50%; position: absolute; top: -12px; right: -14px; box-shadow: 0 3px 6px rgba(0,0,0,0.25); animation: pulse 1.5s infinite; }

        @keyframes gradientMove { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        @keyframes fadeDown { to { opacity: 1; transform: translateY(0); } }
        @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.1); } 100% { transform: scale(1); } }

        footer { background:black; color: #f1f1f1; padding: 30px 20px; text-align: center; font-family: 'Poppins', sans-serif; box-shadow: 0 -3px 10px rgba(0,0,0,0.3); }
        footer h3 { margin-bottom: 10px; font-size: 22px; color: #ffcc00; letter-spacing: 1px; }
        footer p { margin: 6px 0; font-size: 14px; line-height: 1.6; }
        footer a { color: #ffcc00; text-decoration: none; font-weight: bold; transition: color 0.3s ease; }
        footer a:hover { color: #fff176; }
    </style>
</head>
<body>
    <header>
        <img src="ddlogo.png" alt="Logo">
        <h1>Daily Delight</h1>
        <div class="nav">
            <a href="client.php">Login</a>
            <a href="client.php">Home</a>
            <a href="about.php">About</a>
            <a href="review.php">Review</a>
            <a href="location.php">Locations</a>
            <a href="cart.php" class="cart">🛒 <span class="cart-count"><?php echo $cart_count; ?></span></a>
        </div>
    </header>
